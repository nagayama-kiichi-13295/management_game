<?php

namespace App\Services;

use App\Models\User;

class ShopService
{
    public function createShop(User $user, string $shopName)
    {
        return $user->shops()->create([
            'shop_name' => $shopName,
        ]);
    }
}