@extends('layouts.app')

@section('title', '営業結果')

@section('content')
    <h1>営業結果</h1>

    <hr>

    <h3>☀ 天気</h3>
    <p>{{ $result['weather'] }}</p>

    <h3>🎉 イベント</h3>
    <p>{{ $result['event'] }}</p>

    <hr>

    <h3>営業成績</h3>
    <p>👥 来客数：{{ $result['customers'] }} 人</p>
    <p>💰 売上：{{ number_format($result['sales']) }} 円</p>
    <p>📦 仕入：{{ number_format($result['expense']) }} 円</p>
    <p>💵 利益：{{ number_format($result['profit']) }} 円</p>
    <p>⭐ 評判：+{{ $result['reputation'] }}</p>

    <hr>

    <h3>スキル成長</h3>
    <ul>
        @foreach($shop->shopSkills as $skill)
            <li>
                {{ $skill->skill->name }}
                Lv{{ $skill->level }}
                EXP {{ $skill->exp }}/{{ 100 + (($skill->level - 1) * 50) }}
            </li>
        @endforeach
    </ul>

    <hr>

    <h3>💬 店員コメント</h3>
    <p>{{ $result['comment'] }}</p>

    <br>

    <a href="{{ route('dashboard') }}">
        ダッシュボードへ戻る
    </a>
@endsection