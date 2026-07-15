<?php

namespace App\Services;

use App\Models\User;
use App\Models\Skill;
use App\Models\ShopSkill;

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
        return $shop;
    }
}