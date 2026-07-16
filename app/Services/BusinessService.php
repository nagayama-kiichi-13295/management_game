<?php

namespace App\Services;

use App\Models\BusinessLog;
use App\Models\Shop;
use App\Models\ShopSkill;
use App\Services\SkillService;

class BusinessService
{
    public function __construct(
        private EventService $eventService,
        private SkillService $skillService
    ) {}

    public function run(Shop $shop)
    {
        // イベント取得
        $event = $this->eventService->randomEvent();

        // 来客数
        $customers = random_int(35, 45);
        $customers = (int)($customers * $event['customer_rate']);

        // 客単価
        $unitPrice = 800;

        // 売り上げ
        $sales = $customers * $unitPrice;

        // 仕入れ
        $expense = (int)($sales * 0.35) * $event['expense_rate'];

        // 利益
        $profit = $sales - $expense;

        // 店舗更新
        $shop->money += $profit;
        $shop->day += 1;
        $shop->reputation += $event['reputation'];
        $shop->save();

        BusinessLog::create([
            'shop_id' => $shop->id,
            'day' => $shop->day,
            'customers' => $customers,
            'sales' => $sales,
            'expense' => $expense,
            'profit' => $profit,
            'weather' => '晴れ',
            'event' => $event['name'],
        ]);

        // スキル経験値
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

        // 返却
        return [
            'customers' => $customers,
            'sales' => $sales,
            'expense' => $expense,
            'profit' => $profit,
            'weather'=> '晴れ',
            'event' => $event['name'],
            'reputation' => $event['reputation'],
            'comment' => $this->createComment($event['name'], $profit),
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
