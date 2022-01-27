@extends('layouts.layout')
@section('content')
    <main>
        <div class="user_wrap">
            <div class="container">
                <form action="{{route('user.update')}}" enctype="multipart/form-data" method="POST">
                @csrf
                    <div class="row row_wrap">
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_future">
                                <p><label for="industry">志望業界</label></p>
                                @if($errors->has('industry'))
                                <p class="error-text">{{$errors->first('industry')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <select id="industry" name="industry" >
                                    @foreach(IndustryConst::INDUSTRY_CONST as $industry)
                                        @if($industry === $userData->industry)
                                            <option value="{{$industry}}" selected>{{$industry}}</option>
                                        @else
                                            <option value="{{$industry}}" >{{$industry}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_future">
                                <p><label for="name">氏名</label></p>
                                @if($errors->has('name'))
                                <p class="error-text">{{$errors->first('name')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <p><input type="text" id="name" name="name" value="{{$userData->name}}"></p>
                            </div>
                        </div>
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_future">
                                <p><label for="year">卒業年度</label></p>
                                @if($errors->has('year'))
                                <p class="error-text">{{$errors->first('year')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <select id="year" name="year" >
                                    @foreach(GraduateYearsConst::GRADUATE_YEARS as $year)
                                        @if($year === $userData->year)
                                            <option value="{{$year}}" selected>{{$year}}</option>
                                        @else
                                            <option value="{{$year}}" >{{$year}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row_wrap">
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_future">
                                <p><label for="club">部活動・サークル</label></p>
                            </div>
                            <div class="info_content">
                                <p><input type="text" id="club" name="club" value="{{$userData->club}}"></p>
                            </div>
                        </div>
                        <div class="col-md-3 info_wrap">
                            <div >
                                <img class="info_img" src="{{$userData->profilePath}}" alt="画像">
                            </div>
                            <input type="file" name="img_name">
                            <input type="submit" value="更新" class="toEdit_btn">
                        </div>
                        <div class="col-md-3 info_wrap text-center">
                            <div class="info_title border_self">
                                <p><label for="university">在学学校</label></p>
                                @if($errors->has('university'))
                                <p class="error-text">{{$errors->first('university')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <p><input type="text" id="university" name="university" value="{{$userData->university}}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row row_wrap">
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_self">
                                <p><label for="hobby">趣味</label></p>
                                @if($errors->has('hobby'))
                                <p class="error-text">{{$errors->first('hobby')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <p><input type="text" id="hobby" name="hobby" value="{{$userData->hobby}}"></p>
                            </div>
                        </div>
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_self">
                                <p><label for="hometown">出身</label></p>
                                @if($errors->has('hometown'))
                                <p class="error-text">{{$errors->first('hometown')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <select id="hometown" name="hometown" >
                                    <option value="{{$userData->hometown}}" selected>{{$userData->hometown}}</option>
                                    @foreach(PrefectureConst::PREFECTURE_CONST as $prefecture)
                                        @if($prefecture === $userData->hometown)
                                            <option value="{{$prefecture}}" selected>{{$prefecture}}</option>
                                        @else
                                            <option value="{{$prefecture}}" >{{$prefecture}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 info_wrap">
                            <div class="info_title border_self">
                                <p><label for="email">メールアドレス</label></p>
                                @if($errors->has('email'))
                                <p class="error-text">{{$errors->first('email')}}</p>
                                @endif
                            </div>
                            <div class="info_content">
                                <p><input type="email" id="email" name="email" value="{{$userData->email}}"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
