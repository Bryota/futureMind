<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FutureMind</title>
    @if(app('env')=='local')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @endif
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    @if(app('env')=='local')
        <link rel="shortcut icon" href="{{ asset('/futureMindfavicon.ico') }}">
    @else
        <link rel="shortcut icon" href="{{ secure_asset('/futureMindfavicon.ico') }}">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
<header>
        <div class="container">
            <div class="row">
                <div class="header_logo col-3">
                    <h1>
                        <a href="{{route('diagnosis.index')}}">FutureMind</a>
                    </h1>
                </div>
                <div class="header_nav col-md-7">
                    <nav>
                        <ul>
                            <li><a href="{{route('diagnosis.about')}}">FutureMindについて</a></li>
                            <li><a href="{{route('diagnosis.result')}}">結果を見る</a></li>
                            <li><a href="{{route('search.search')}}">企業を探す</a></li>
                            <li>
                                <a href="{{route('user.likes')}}">お気に入り企業を見る</a>
                                @if (session('is_uncheckedMessage_for_user'))
                                <span></span>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header_icon col-md-2">
                    <div>
                        <span><a href="{{route('user.index')}}"><i class="far fa-user"></i></a></span>
                    </div>
                </div>
                <div class="header_ham col-9">
                    <span class="hum_btn"><i class="fas fa-bars"></i></span>
                    <span class="hum_close"><i class="fas fa-times"></i></span>
                </div>
                <div class="hum_wrap">
                    <nav>
                        <ul>
                            <li><a href="{{route('diagnosis.about')}}">FutureMindについて</a></li>
                            <li><a href="{{route('diagnosis.result')}}">結果を見る</a></li>
                            <li><a href="{{route('search.search')}}">企業を探す</a></li>
                            <li><a href="{{route('user.likes')}}">お気に入り企業を見る</a></li>
                            <li><a href="{{route('user.index')}}">プロフィール</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    @if(app('env')=='local')
        <script src="{{ asset('js/app.js')}}"></script>
    @else
        <script src="{{ secure_asset('js/app.js')}}"></script>
    @endif
</body>
</html>
