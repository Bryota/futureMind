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
                        <a href="{{route('admin.home')}}">FutureMind</a>
                    </h1>
                </div>
                <div class="header_nav col-md-9">
                    <nav>
                        <ul class="admin_header">
                            <li><a href="{{route('admin.diagnosis_question_index')}}">診断質問</a></li>
                            <li><a href="{{route('admin.future_index')}}">理想分析コメント</a></li>
                            <li><a href="{{route('admin.self_index')}}">自己分析コメント</a></li>
                            <li><a href="{{route('admin.diagnosis_index')}}">診断コメント</a></li>
                            <li><a href="{{route('admin.future_company_index')}}">会社理想分析コメント</a></li>
                            <li><a href="{{route('admin.self_company_index')}}">会社自己分析コメント</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header_ham col-9">
                    <span class="hum_btn"><i class="fas fa-bars"></i></span>
                    <span class="hum_close"><i class="fas fa-times"></i></span>
                </div>
                <div class="hum_wrap">
                    <nav>
                        <ul>
                            <li><a href="{{route('admin.diagnosis_question_index')}}">診断質問</a></li>
                            <li><a href="{{route('admin.future_index')}}">理想分析コメント</a></li>
                            <li><a href="{{route('admin.self_index')}}">自己分析コメント</a></li>
                            <li><a href="{{route('admin.diagnosis_index')}}">診断コメント</a></li>
                            <li><a href="{{route('admin.future_company_index')}}">会社理想分析コメント</a></li>
                            <li><a href="{{route('admin.self_company_index')}}">会社自己分析コメント</a></li>
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