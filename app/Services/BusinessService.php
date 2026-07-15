<?php

namespace App\Services;

use App\Models\BusinessLog;
use App\Models\Shop;
use App\Models\ShopSkill;
use App\Services\SkillService;

class BusinessService
{
    public function run(Shop $shop)
    {
        $customers = random_int(35, 45);

        $unitPrice = 800;

        $sales = $customers * $unitPrice;

        $expense = (int)($sales * 0.35);

        $profit = $sales - $expense;

        $shop->money += $profit;
        $shop->day += 1;
        $shop->save();

        BusinessLog::create([
            'shop_id' => $shop->id,
            'day' => $shop->day,
            'customers' => $customers,
            'sales' => $sales,
            'expense' => $expense,
            'profit' => $profit,
            'weather' => '晴れ',
            'event' => 'なし',
        ]);

        return [
            'customers' => $customers,
            'sales' => $sales,
            'expense' => $expense,
            'profit' => $profit,
        ];

        $skillService = app(SkillService::class);
        $shopSkills = $shop->shopSkills;
        foreach ($shopSkills as $shopSkill) {
            switch($shopSkill->skill->key){
                case 'cooking':
                    $skillService->addExp($shopSkill, 2);
                    break;
                
                case 'service':
                    $skillService->addExp($shopSkill, 1);
                    break;
                
                case 'management':
                    $skillService->addExp($shopSkill, 1);
                    break;
            }
        }
    }
}