<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\BusinessService;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function store(BusinessService $businessService)
    {
        $shop = Auth::user()->shops()->first();

        $result = $businessService->run($shop);

        return view('business.result', compact(
            'shop',
            'result' 
        ));
    }
}
