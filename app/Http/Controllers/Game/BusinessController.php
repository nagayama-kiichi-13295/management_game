<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\BusinessService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BusinessController extends Controller
{
    public function store(Request $request, BusinessService $businessService)
    {
        $shop = Auth::user()->shops()->first();

        $result = $businessService->run(
            $shop,
            $request->action
        );

        $shop->refresh();

        return view('business.result', compact(
            'shop',
            'result' 
        ));
    }
}
