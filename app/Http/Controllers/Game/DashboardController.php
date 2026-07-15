<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\TimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(TimeService $timeService) 
    {
        $shop = Auth::user()->shops()->first();

        if (!$shop) {
            return redirect()->route('shops.create');
        }

        return view('dashboard.index', [
            'shop'   => $shop,
            'season' => $timeService->getSeason($shop->day),
            'week'   => $timeService->getWeek($shop->day),
        ]);
    }
}
