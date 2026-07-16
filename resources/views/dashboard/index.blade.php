@extends('layouts.app')
@section('title', 'ダッシュボード')
@section('content')
    <h2>{{ $shop->shop_name }}</h2>
    <p>所持金: {{ number_format($shop->money) }} 円</p>
    <p>{{ $shop->day }} 日目</p>
    <p>季節: {{ $season }}</p>
    <p>曜日: {{ $week }}曜日</p>
    <p>店舗ランク: {{ $rank }}</p>
    <p>評判: {{ $shop->reputation }}</p>

    <form action="{{ route('business.store') }}" method="post">
        @csrf
        <button>営業する</button>
    </form>
@endsection