<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>経営趣味レーションゲーム</h1>

        @auth
            <p>
                ログイン中:
                {{ Auth::user()->name }}
            </p>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button>
                    ログアウト
                </button>
            </form>
        @endauth
        <hr>
        <nav>
            <a href="{{ route('dashboard') }}">
                ダッシュボード
            </a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>