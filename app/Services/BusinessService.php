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
            'event' => $event['name'],
        ];
    }
}
