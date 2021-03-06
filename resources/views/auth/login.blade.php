<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>futureMind</title>
    @if(app('env')=='local')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
    <main class="login_wrap">
        <div class="bg_line top self_color"></div>
        <div class="bg_line center self_color"></div>
        <div class="bg_line bottom self_color"></div>
        <h1 class="login_title text-center">futureMind</h1>
        <div class="login_form_wrap">
            <form action="{{route('login')}}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">メールアドレス</label>
                    @if($errors->has('email'))
                    <p class="error-text">{{$errors->first('email')}}</p>
                    @endif
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" placeholder="test@test.com" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">パスワード</label>
                    @if($errors->has('password'))
                    <p class="error-text">{{$errors->first('password')}}</p>
                    @endif
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="*********">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </div>
                <div class="text-center" style="margin-top:10px;">
                    <a href="{{route('register')}}" class="mt-10">新規登録</a>
                </div>
            </form>
        </div>
    </main>
    @if(app('env')=='local')
        <script src="{{ asset('js/app.js')}}"></script>
    @else
        <script src="{{ secure_asset('js/app.js')}}"></script>
    @endif
</body>
</html>
