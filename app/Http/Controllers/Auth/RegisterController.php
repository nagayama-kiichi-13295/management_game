<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
        ]);

        // ユーザ登録
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return redirect('/login');
    }
}