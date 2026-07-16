<?php

namespace App\Services;

use App\Models\User;
use App\Models\Skill;
use App\Models\ShopSkill;
use App\Models\Menu;

class ShopService
{
    public function createShop(User $user, string $shopName)
    {
        $shop = $user->shops()->create([
            'shop_name' => $shopName,
        ]);

        $skills = Skill::all();

        foreach ($skills as $skill) {
            ShopSkill::create([
                'shop_id'  => $shop->id,
                'skill_id' => $skill->id,
                'level'    => 1,
                'exp'      => 0,
            ]);
        }

        // 初期メニュー作成
        Menu::create([
            'shop_id' => $shop->id,
            'name' => 'ラーメン',
            'price' => 900,
        ]);
        Menu::create([
            'shop_id' => $shop->id,
            'name' => 'チャーハン',
            'price' => 850,            
        ]);
        Menu::create([
            'shop_id' => $shop->id,
            'name' => '餃子',
            'price' => 500,            
        ]);
        Menu::create([
            'shop_id' => $shop->id,
            'name' => '唐揚げ',
            'price' => 650,            
        ]);
        Menu::create([
            'shop_id' => $shop->id,
            'name' => 'オリジナルメニュー',
            'price' => 1200,            
        ]);

        return $shop;
    }
}