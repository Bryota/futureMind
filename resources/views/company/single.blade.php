@extends('layouts.company_header')
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
                            <p>{{$user->industry}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>氏名</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>卒業年度</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->year}}</p>
                        </div>
                    </div>
                </div>
                <div class="row row_wrap">
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_future">
                            <p>部活動・サークル</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->club}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div>
                            <img class="info_img" src="{{Storage::disk('s3')->url($user->img_name)}}" alt="画像">
                        </div>
                        <div class="toEdit_btn">
                            <a href="{{route('company.chat',['student_id'=>$user->id,'id'=>$Room_id])}}"><p>チャット</p></a>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>在学学校</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->university}}</p>
                        </div>
                    </div>
                </div>
                <div class="row row_wrap">
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>趣味</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->hobby}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>出身</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->hometown}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 info_wrap">
                        <div class="info_title border_self">
                            <p>メールアドレス</p>
                        </div>
                        <div class="info_content">
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

