<?php

namespace App\Services;

class RankService
{
    public function getRank(int $reputation): string
    {
        if ($reputation >= 1000) return 'SS';
        if ($reputation >= 600) return 'S';
        if ($reputation >= 350) return 'A';
        if ($reputation >= 180) return 'B';
        if ($reputation >= 80) return 'C';
        if ($reputation >= 30) return 'D';

        return 'E';
    }
}