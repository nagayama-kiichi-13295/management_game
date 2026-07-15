@extends('layouts.app')
@section('title', 'ゲーム開始')
@section('content')
    <h2>ゲーム開始</h2>
    <p>店舗名を入力してください。</p>

    <form action="{{ route('shops.store') }}" method="post">
        @csrf
        <input
            type="text"
            name="shop_name"
            placeholder="例:〇〇ラーメン">
        
        <button type="submit">
            ゲーム開始
        </button>
    </form>
@endsection