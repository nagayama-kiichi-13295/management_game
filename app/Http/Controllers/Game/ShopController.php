<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|max:30',
        ]);

        Auth::user()->shops()->create([
            'shop_name' => $request->shop_name,
        ]);

        return redirect()->route('dashboard');
    }
}
