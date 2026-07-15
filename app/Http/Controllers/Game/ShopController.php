<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request, ShopService $shopService)
    {
        $request->validate([
            'shop_name' => 'required|max:30',
        ]);

        $shopService->createShop(
            Auth::user(),
            $request->shop_name
        );

        return redirect()->route('dashboard');
    }
}
