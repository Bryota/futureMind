<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FutureMind</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/futureMindfavicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
<header>
        <div class="container">
            <div class="row">
                <div class="header_logo col-3">
                    <h1>
                        <a href="{{route('company.home')}}">FutureMind</a>
                    </h1>
                </div>
                <div class="header_nav col-md-7">
                    <nav>
                        <ul>
                            <li><a href="{{route('company.diagnosis')}}">診断をする</a></li>
                            <li><a href="{{route('company.student')}}">学生を見る</a></li>
                            <li><a href="{{route('company.logout')}}">ログアウト</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header_icon col-md-2">
                    <div>
                        <span><a href="{{route('company.home')}}"><i class="far fa-user"></i></a></span>
                    </div>
                </div>
                <div class="header_ham col-9">
                    <span class="hum_btn"><i class="fas fa-bars"></i></span>
                    <span class="hum_close"><i class="fas fa-times"></i></span>
                </div>
                <div class="hum_wrap">
                <nav>
                        <ul>
                            <li><a href="{{route('company.diagnosis')}}">診断をする</a></li>
                            <li><a href="{{route('company.student')}}">学生を見る</a></li>
                            <li><a href="#">ログアウト</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/companyChart.js')}}"></script>
</body>
</html>
