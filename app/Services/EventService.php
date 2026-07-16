<?php 

namespace App\Services;

class EventService
{
    public function randomEvent(): array
    {
        $events = [
            [
                'name'         => 'なし',
                'customer_rate'=> 1.0,
                'expense_rate' => 1.0,
                'reputation'   => 0,
            ],
            [
                'name'         => 'SNSで話題',
                'customer_rate'=> 1.0,
                'expense_rate' => 1.2,
                'reputation'   => 0,
            ],
            [
                'name'         => '常連客来店',
                'customer_rate'=> 1.1,
                'expense_rate' => 1.0,
                'reputation'   => 1,
            ],
        ];

        return $events[array_rand($events)];
    }
}