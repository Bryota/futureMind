@extends('layouts.layout')
@section('content')
    <main>
        <div class="user_wrap">
            <div class="container">
                <div class="row row_wrap">
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>志望業界</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->industry}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>氏名</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>卒業年度</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->year}}</p>
                        </div>
                    </div>
                </div>
                <div class="row row_wrap">
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>部活動・サークル</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->club}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div>
                            <img class="info_img" src="{{$userData->profilePath}}" alt="画像">
                        </div>
                        <div class="toEdit_btn">
                            <a href="{{route('user.edit')}}"><p>編集</p></a>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>在学学校</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->university}}</p>
                        </div>
                    </div>
                </div>
                <div class="row row_wrap">
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>趣味</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->hobby}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>出身</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->hometown}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>メールアドレス</p>
                        </div>
                        <div class="info_content">
                            <p>{{$userData->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

