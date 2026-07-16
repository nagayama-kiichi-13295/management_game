<?php

namespace App\Services;

class TimeService
{
    public function getSeason(int $day): string
    {
        $dayOfYear = (($day - 1) % 360) + 1;

        if ($dayOfYear <= 90) {
            return '春';
        }

        if ($dayOfYear <= 180) {
            return '夏';
        }

        if ($dayOfYear <= 270) {
            return '秋';
        }

        return '冬';
    }

    public function getWeek(int $day): string
    {
        $weeks = [
            '月',
            '火',
            '水',
            '木',
            '金',
            '土',
            '日'
        ];
        return $weeks[($day -1) % 7];
    }
}