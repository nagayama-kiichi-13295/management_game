<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\BusinessService;
use App\Services\RankService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BusinessController extends Controller
{
    public function store(
        Request $request, 
        BusinessService $businessService,
        RankService $rankService
    ){
        $shop = Auth::user()->shops()->first();

        $result = $businessService->run(
            $shop,
            $request->action
        );

        $shop->refresh();
        $shop->load('shopSkills.skill');

        return view('business.result', [
            'shop' => $shop,
            'result' => $result,
            'rank' => $rankService->getRank($shop), 
        ]);
    }
}
