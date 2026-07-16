<?php

namespace App\Services;

class WeatherService
{
    public function randomWeather(): array
    {
        $weathers = [
            [
                'name' => '晴れ',
                'customer_rate' => 1.1,
            ],
            [
                'name' => '雲',
                'customer_rate' => 1.0,
            ],
            [
                'name' => '雨',
                'customer_rate' => 0.8,
            ],
            [
                'name' => '台風',
                'customer_rate' => 0.5,
            ],
        ];

        return $weathers[array_rand($weathers)];
    }
}