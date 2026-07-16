<?php

namespace App\Services;

use App\Models\BusinessLog;
use App\Models\Shop;
use App\Services\RankService;
use App\Services\TimeService;

class BusinessService
{
    public function __construct(
        private EventService $eventService,
        private WeatherService $weatherService,
        private SkillService $skillService,
        private RankService $rankService,
        private TimeService $timeService,
    ) {}

    public function run(Shop $shop, string $action)
    {
        $beforeRank = $this->rankService->getRank($shop);

        // -----------------------------
        // イベント
        // -----------------------------
        $event = $this->eventService->randomEvent();

        // 天気
        $weather = $this->weatherService->randomWeather();

        $season = $this->timeService->getSeason($shop->day);

        // -----------------------------
        // 開発済みメニュー取得
        // -----------------------------
        $developedMenus = $shop->menus()
            ->where('developed', true)
            ->get();

        // -----------------------------
        // メニュー効果
        // -----------------------------
        $customerBonus = 0;
        $priceBonus = 0;
        $reputationBonus = 0;
        foreach ($developedMenus as $menu) {

            switch ($menu->name) {

                case 'ラーメン':
                    $customerBonus += 5;
                    break;

                case 'チャーハン':
                    $priceBonus += 50;
                    break;

                case '餃子':
                    $reputationBonus += 1;
                    break;

                case '唐揚げ':
                    $customerBonus += 3;
                    break;

                case 'オリジナルメニュー':
                    $customerBonus += 3;
                    $priceBonus += 30;
                    $reputationBonus += 1;
                    break;
            }
        }

        // -----------------------------
        // 基本値
        // -----------------------------
        $customers = random_int(35, 45);
        $customers = (int)(
            $customers
            * $event['customer_rate']
            * $weather['customer_rate']
        );

        // -----------------------------
        // 開発済みメニュー効果
        // -----------------------------        
        $customers += $customerBonus;

        switch ($season) {

            case '春':
                $customers += 3;
                break;

            case '夏':
                $customers += 6;
                break;

            case '秋':
                $customers += 4;
                break;

            case '冬':
                $customers -= 3;
                break;
        }

        // テーブルの増設効果
        if ($shop->table_upgrade) {
            $customers += 5;
        }

        $unitPrice = 800;
        $unitPrice += $developedMenus->sum('popularity') * 5;
        $unitPrice += $priceBonus;

        // 厨房改装効果
        if ($shop->kitchen_upgrade) {
            $unitPrice = (int)($unitPrice * 1.05);
        }

        $extraExpense = 0;

        $actionMessage = '';

        // -----------------------------
        // 今日の行動
        // -----------------------------
        switch ($action) {

            case 'advertise':

                $customers = (int)($customers * 1.2);

                $extraExpense = 5000;

                $actionMessage = '広告を出して集客しました。';

                break;

            case 'clean':

                $shop->reputation += 3;

                $actionMessage = '店内を掃除して評判が上がりました。';

                break;

            case 'study':

                $cooking = $shop->shopSkills()
                    ->whereHas('skill', function ($q) {
                        $q->where('key', 'cooking');
                    })
                    ->first();

                if ($cooking) {
                    $this->skillService->addExp($cooking, 10);
                }

                $actionMessage = '料理の研究をしました。';

                break;

            default:

                $actionMessage = '通常営業を行いました。';

                break;
        }

        // -----------------------------
        // 売上計算
        // -----------------------------
        $sales = $customers * $unitPrice;

        $expense = (int)($sales * 0.35);

        $expense = (int)($expense * $event['expense_rate']);

        $expense += $extraExpense;

        $profit = $sales - $expense;

        // -----------------------------
        // 店舗更新
        // -----------------------------
        $shop->money += $profit;
        $shop->day += 1;
        $shop->reputation += $event['reputation'];
        $shop->reputation += $reputationBonus;

        // 内装効果
        if ($shop->interior_upgrade) {
            $shop->reputation += 1;
        }

        $shop->save();

        // -----------------------------
        // 営業履歴
        // -----------------------------
        BusinessLog::create([
            'shop_id'   => $shop->id,
            'day'       => $shop->day,
            'customers' => $customers,
            'sales'     => $sales,
            'expense'   => $expense,
            'profit'    => $profit,
            'weather'   => $weather['name'],
            'event'     => $event['name'],
        ]);

        // -----------------------------
        // スキル経験値
        // -----------------------------
        foreach ($shop->shopSkills as $shopSkill) {

            switch ($shopSkill->skill->key) {

                case 'cooking':
                    $this->skillService->addExp($shopSkill, 2);
                    break;

                case 'service':
                    $this->skillService->addExp($shopSkill, 1);
                    break;

                case 'management':
                    $this->skillService->addExp($shopSkill, 1);
                    break;
            }
        }

        // -----------------------------
        // メニュー人気上昇
        // -----------------------------
        foreach ($developedMenus as $menu) {
            if ($menu->popularity < 100) {

                $menu->popularity += 1;

                $menu->save();
            }
        }

        // 最新状態を取得
        $shop->refresh();
        $shop->load('shopSkills.skill');
        // ランク判定
        $afterRank = $this->rankService->getRank($shop);
        $rankUp = $beforeRank !== $afterRank;

        // -----------------------------
        // 返却
        // -----------------------------
        return [
            'customers'  => $customers,
            'sales'      => $sales,
            'expense'    => $expense,
            'profit'     => $profit,
            'weather'    => $weather['name'],
            'event'      => $event['name'],
            'reputation' => $event['reputation'] + $reputationBonus + ($shop->interior_upgrade ? 1 : 0),
            'menus'      => $developedMenus,
            'comment'    => $this->createComment($event['name'], $profit),
            'action'     => $actionMessage,
            'rank_up'    => $rankUp,
            'season'     => $season,
        ];
    }

    private function createComment(string $event, int $profit): string
    {
        if ($event === 'SNSで話題') {
            return '今日はSNSで話題になり、お客様がたくさん来店しました！';
        }

        if ($event === '常連客来店') {
            return '常連のお客様が多く、店内は終始にぎわっていました。';
        }

        if ($profit >= 30000) {
            return '今日はかなり好調な営業でした！';
        }

        if ($profit >= 20000) {
            return '安定した一日でした。';
        }

        return '今日は少し静かな営業でした。';
    }
}
