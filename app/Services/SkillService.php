<?php

namespace App\Services;

use App\Models\ShopSkill;

class SkillService
{
    public function addExp(ShopSkill $shopSkill, int $exp): void
    {
        $shopSkill->exp += $exp;

        while ($shopSkill->exp >= $this->requiredExp($shopSkill->level)){
            $shopSkill->exp -= $this->requiredExp($shopSkill->level);
            $shopSkill->level++;
        } 
        $shopSkill->save();
    }

    public function requiredExp(int $level): int
    {
        return 100 + (($level - 1) * 50);
    }
}