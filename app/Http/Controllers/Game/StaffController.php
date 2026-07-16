<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // -----------------------------
    // アルバイトを雇う
    // -----------------------------
    public function partTime()
    {
        $shop = Auth::user()->shops()->first();

        if(
            !$shop->part_time_staff &&
            $shop->money >= 50000
        ) {
            $shop->money -= 50000;
            $shop->part_time_staff = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }

    // -----------------------------
    // ベテラン店員を雇う
    // -----------------------------
    public function veteran()
    {
        $shop = Auth::user()->shops()->first();

        if (
            !$shop->veteran_staff &&
            $shop->money >= 120000
        ) {
            $shop->money -= 120000;
            $shop->veteran_staff = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }

    // -----------------------------
    // 料理人を雇う
    // -----------------------------
    public function chef()
    {
        $shop = Auth::user()->shops()->first();
        
        if (
            !$shop->cheff_staff &&
            $shop->money >= 200000
        ){
            $shop->money -= 200000;
            $shop->chef_staff = true;
            $shop->save();
        }

        return redirect()->route('dashboard');
    }
}