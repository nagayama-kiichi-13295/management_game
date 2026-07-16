<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    public function kitchen()
    {
        $shop = Auth::user()->shops()->first();

        if(!$shop->kitchen_upgrade && $shop->money >= 100000) {
            $shop->money -= 100000;
            $shop->kitchen_upgrade = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }

    public function table() 
    {
        $shop = Auth::user()->shops()->first();

        if(!$shop->table_upgrade && $shop->money >= 80000) {
            $shop->money -= 80000;
            $shop->table_upgrade = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }

    public function interior()
    {
        $shop = Auth::user()->shops()->first();

        if (!$shop->interior_upgrade && $shop->money >= 150000) {
            $shop->money -= 150000;
            $shop->interior_upgrade = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }
}