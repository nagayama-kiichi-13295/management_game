@extends('layouts.app')

@section('title','メニュー開発')

@section('content')

<h2>メニュー開発</h2>

<p>所持金：{{ number_format($shop->money) }} 円</p>

<hr>

@foreach($menus as $menu)

    <h3>{{ $menu->name }}</h3>

    <p>価格：{{ $menu->price }} 円</p>

    <p>人気：{{ $menu->popularity }}</p>

    @if($menu->developed)

        <span>✅ 開発済み</span>

    @else

        <form action="{{ route('menus.develop',$menu) }}" method="POST">
            @csrf
            <button>
                開発する（30,000円）
            </button>
        </form>

    @endif

    <hr>

@endforeach

<a href="{{ route('dashboard') }}">
    ダッシュボードへ戻る
</a>

@endsection