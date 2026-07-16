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
    <h3>今日の行動</h3>

    <label> 
        <input type="radio" name="action" value="normal" checked>
        通常営業
    </label><br>

    <label> 
        <input type="radio" name="action" value="advertise">
        広告を出す
    </label><br>

    <label> 
        <input type="radio" name="action" value="clean">
        店内を掃除する
    </label><br>

    <label> 
        <input type="radio" name="action" value="study">
        料理の研究
    </label><br><br>

    <button type="submit">
        営業開始
    </button>
</form>

<hr>

<a href="{{ route('menus.index') }}">
    メニュー開発
</a>

<hr>

<h2>設備投資</h2>

<form action="{{ route('upgrade.kitchen') }}" method="post">
    @csrf
    <button
        {{ $shop->kitchen_upgrade ? 'disabled' : '' }}>
        厨房改装(100,000)円
    </button>
</form>

<br>

<form action="{{ route('upgrade.table') }}" method="post">
    @csrf
    <button
        {{ $shop->table_upgrade ? 'disabled' : '' }}>
        テーブル増設(80,000)円
    </button>
</form>

<br>

<form action="{{ route('upgrade.interior') }}" method="post">
    @csrf
    <button
        {{ $shop->interior_upgrade ? 'disabled' : '' }}>
        内装リニューアル(150,000)円
    </button>
</form>

@endsection