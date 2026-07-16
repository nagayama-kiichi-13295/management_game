<?php

namespace App\Services;

use App\Models\Shop;

class RankService
{
    public function getRank(Shop $shop): string
    {
        if ($shop->money >= 3000000 && $shop->reputation >= 80) {
            return '全国チェーン';
        }

        if ($shop->money >= 2000000 && $shop->reputation >= 60) {
            return '名店';
        }

        if ($shop->money >= 1200000 && $shop->reputation >= 40) {
            return '有名店';
        }

        if ($shop->money >= 700000 && $shop->reputation >= 20) {
            return '人気店';
        }

        return '個人店';
    }
}