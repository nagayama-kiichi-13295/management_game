<?php

namespace App\Services;

use App\Models\BusinessLog;
use App\Models\Shop;

class BusinessService
{
    public function __construct(
        private EventService $eventService,
        private SkillService $skillService
    ) {}

    public function run(Shop $shop, string $action)
    {
        // -----------------------------
        // イベント
        // -----------------------------
        $event = $this->eventService->randomEvent();

        // -----------------------------
        // 基本値
        // -----------------------------
        $customers = random_int(35, 45);
        $customers = (int)($customers * $event['customer_rate']);

        $unitPrice = 800;

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
            'weather'   => '晴れ',
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
        // 返却
        // -----------------------------
        return [
            'customers'  => $customers,
            'sales'      => $sales,
            'expense'    => $expense,
            'profit'     => $profit,
            'weather'    => '晴れ',
            'event'      => $event['name'],
            'reputation' => $event['reputation'],
            'comment'    => $this->createComment($event['name'], $profit),
            'action'     => $actionMessage,
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