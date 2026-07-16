@extends('layouts.app')

@section('title', '営業結果')

@section('content')

    <h3>今日の行動</h3>
    <p>{{ $result['action'] }}</p>

    <hr>
    
    <h1>営業結果</h1>

    @if ($result['rank_up'])
        <div style="
            background:#fff3cd;
            border:2px solid orange;
            padding:20px;
            text-align:center;
            margin-bottom:20px;
        ">

            <h2>🎉 ランクアップ</h2>
            <p>
                お店が
                <strong>{{ $rank }}</strong>
                に昇格しました！
            </p>
        </div>
    @endif

    <hr>
    <h3>🍀 季節</h3>
    <p>{{ $result['season'] }}</p>
    
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
    <p>🏆 店舗ランク：{{ $rank }}</p>

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

    <h3>設備状況</h3>

    <ul>
        <li>
            厨房:
            {{ $shop->kitchen_upgrade ? '✅ 改装済み' : '未改装' }}
        </li>
        <li>
            テーブル:
            {{ $shop->table_upgrade ? '✅ 増設済み' : '未増設' }}
        </li>
        <li>
            内装:
            {{ $shop->interior_upgrade ? '✅ リニューアル済み' : '未改装' }}
        </li>
    </ul>

    <hr>

    <h3>💬 店員コメント</h3>
    <p>{{ $result['comment'] }}</p>

    <br>

    <a href="{{ route('dashboard') }}">
        ダッシュボードへ戻る
    </a>
@endsection