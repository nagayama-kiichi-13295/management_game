<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
    {
        $shop = Auth::user()->shops->first();
        if (!$shop) {
            return redirect()->route('shops.create');
        }

        return view('dashboard.index', compact('shop'));
    }
}
