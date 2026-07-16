<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shops()->first();

        $menus = $shop->menus;

        return view('menus.index', compact(
            'shop',
            'menus'
        ));
    }

    public function develop(Menu $menu)
    {
        $shop = Auth::user()->shops()->first();
        if(
        $menu->shop_id == $shop->id &&
        !$menu->developed &&
        $shop->money >= 30000
        ){
            $shop->money -= 30000;
            $shop->save();

            $menu->developed = true;
            $menu->popularity = 10;
            $menu->save();
        }

        return redirect()->route('menus.index');
    }
}
