<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>futureMind</title>
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
    <main class="company_register_wrap">
        <h1 class="register_title text-center">futureMind</h1>
        <p class="company_title text-center">（企業様ページ）</p>
        <div class="register_form_wrap">
            <form action="{{ url("$authgroup/register")}}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">企業名</label>
                    @if($errors->has('name'))
                    <p class="error-text">{{$errors->first('name')}}</p>
                    @endif
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder="株式会社やる気">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">アイコン</label>
                    <div class="company_icon_img"><img src="" alt=""></div>
                    @if($errors->has('company_icon'))
                    <p class="error-text">{{$errors->first('company_icon')}}</p>
                    @endif
                    <input type="file" class="file_wrap" id="exampleInputPassword1" name="company_icon">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">メールアドレス</label>
                    @if($errors->has('email'))
                    <p class="error-text">{{$errors->first('email')}}</p>
                    @endif
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" placeholder="test@test.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">パスワード</label>
                    @if($errors->has('password'))
                    <p class="error-text">{{$errors->first('password')}}</p>
                    @endif
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="********">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">新規登録</button>
                </div>
                <div class="text-center" style="margin-top:10px;">
                    <a href="{{route('company.login')}}" class="mt-10">ログイン</a>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ secure_asset('js/app.js')}}"></script>
</body>
</html>
