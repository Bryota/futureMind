@extends('layouts.company_header')

@section('content')
<main>
    <span id="js_company_developmentValue" data-companydevelopmentvalue="{{$company->diagnosis->developmentvalue}}"></span>
    <span id="js_company_socialValue" data-companysocialvalue="{{$company->diagnosis->socialvalue}}"></span>
    <span id="js_company_stableValue" data-companystablevalue="{{$company->diagnosis->stablevalue}}"></span>
    <span id="js_company_teammateValue" data-companyteammatevalue="{{$company->diagnosis->teammatevalue}}"></span>
    <span id="js_company_futureValue" data-companyfuturevalue="{{$company->diagnosis->futurevalue}}"></span>
    <div class="singleCompany_wrap">
        <div class="companyProfile_title">プロフィール</div>
        <p class="companyProfile_text">（以下の情報が企業データとして記載されます）</p>
        <div class="singleCompany_content mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 company_chart">
                        <canvas id="companyChart" width="60%" height="40%"></canvas>
                    </div>
                    <div class="col-xl-6 company_details">
                        <div class="text-center">
                            <img class="company_logo" src="{{$company->profilePath}}" alt="">
                        </div>
                        <div class="company_info">
                            <ul>
                                <li>企業名：{{$company->name}}</li>
                                <li>業界：{{$company->industry}}</li>
                                <li>場所：{{$company->office}}</li>
                                <li>社員数：{{$company->employee}}人</li>
                                <li>ホームページ：{{$company->homepage}}</li>
                                <li class="company_comment">企業からのコメント<br>{{$company->comment}}</li>
                                <li>音声メッセージ<br>
                                    <audio src="{{$company->voicePath}}" controls></audio>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{route('company.edit')}}" class="toEdit_btn">編集</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection