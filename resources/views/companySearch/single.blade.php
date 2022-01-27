@extends('layouts.company_single')
@section('content')
    <main>
    <span id="js_company_developmentValue" data-companydevelopmentvalue="{{$company->diagnosis->developmentvalue}}"></span>
        <span id="js_company_socialValue" data-companysocialvalue="{{$company->diagnosis->socialvalue}}"></span>
        <span id="js_company_stableValue" data-companystablevalue="{{$company->diagnosis->stablevalue}}"></span>
        <span id="js_company_teammateValue" data-companyteammatevalue="{{$company->diagnosis->teammatevalue}}"></span>
        <span id="js_company_futureValue" data-companyfuturevalue="{{$company->diagnosis->futurevalue}}"></span>
        <div class="singleCompany_wrap">
            <div class="singleCompany_title primary_color">{{$company->name}}</div>
            <div class="singleCompany_content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 company_chart">
                            <canvas id="companyChart" width="60%" height="40%"></canvas>
                        </div>
                        <div class="col-xl-6 company_details">
                            <div class="text-center"><img class="company_logo" src="{{Storage::disk('s3')->url($company->company_icon)}}" alt=""></div>
                            <div class="company_info">
                                <ul>
                                    <li>企業:{{$company->name}}</li>
                                    <li>業界：{{$company->industry}}</li>
                                    <li>場所：{{$company->office}}</li>
                                    <li>社員数：{{$company->employee}}人</li>
                                    <li>ホームページ：{{$company->homepage}}</li>
                                    <li>企業からのコメント<br>
                                        {{$company->comment}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if($isLiked === false)
                    <form method="POST" action="{{ route('search.likeCompany',['id'=>$company->id])}}" class="likes_btn_wrap text-center">
                    @csrf
                        <input type="hidden" name="company_id" value="{{$company->id}}"/>
                        <button type="submit" class="likes_btn future_btn"><span>お気に入りに追加</span></button>
                    </form>
                    @else
                    <div  class="likes_btn_wrap text-center">
                        @if($chat == true)
                        <p type="submit" class="likes_btn future_btn"><a href="{{route('user.chat',['id'=>$room_id])}}">チャット</a></p>
                        @else
                        <p type="submit" class="likes_btn liked_btn"><span>お気に入りに追加済み</span></p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/companyChart.js')}}"></script>

@endsection
