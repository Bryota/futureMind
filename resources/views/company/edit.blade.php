@extends('layouts.company_header')

@section('content')
<main>
    <span id="js_company_developmentValue" data-companydevelopmentvalue="{{$company->diagnosis->developmentvalue}}"></span>
    <span id="js_company_socialValue" data-companysocialvalue="{{$company->diagnosis->socialvalue}}"></span>
    <span id="js_company_stableValue" data-companystablevalue="{{$company->diagnosis->stablevalue}}"></span>
    <span id="js_company_teammateValue" data-companyteammatevalue="{{$company->diagnosis->teammatevalue}}"></span>
    <span id="js_company_futureValue" data-companyfuturevalue="{{$company->diagnosis->futurevalue}}"></span>
        <div class="singleCompany_wrap">
            <div class="companyProfile_title">プロフィール編集</div>
            <div class="singleCompany_content mt-0">
                <div class="container">
                    <div class="row">
                        <div class="company_chart col-md-6">
                            <canvas id="companyChart" width="60%" height="40%"></canvas>
                        </div>
                        <div class="col-md-6  company_details">
                            <form action="{{route('company.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="text-center">
                                    <img class="company_logo company_admin" src="{{$company->profilePath}}" alt="">
                                </div>
                                <div class="text-center mb-10"><input type="file" name="company_icon"></div>
                                <div class="company_info company_edit">
                                    <ul>
                                        <li><label for="company">企業名</label>：<input type="text" id="company" name="name" value="{{$company->name}}"></li>
                                        @if($errors->has('name'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('name')}}</p>
                                        @endif
                                        <li><label for="industry">業界</label>：
                                            <select id="industry" name="industry" >
                                                @foreach(IndustryConst::INDUSTRY_CONST as $industry)
                                                    @if($industry === $company->industry)
                                                        <option value="{{$industry}}" selected>{{$industry}}</option>
                                                    @else
                                                        <option value="{{$industry}}" >{{$industry}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </li>
                                        @if($errors->has('industry'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('industry')}}</p>
                                        @endif
                                        <li><label for="office">場所</label>：<input type="text" id="office" name="office" value="{{$company->office}}"></li>
                                        @if($errors->has('office'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('office')}}</p>
                                        @endif
                                        <li><label for="employee">社員数</label>：約<input type="text" id="employee" name="employee" value="{{$company->employee}}">人</li>
                                        @if($errors->has('employee'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('employee')}}</p>
                                        @endif
                                        <li><label for="homepage">ホームページ</label>：<input type="text" id="homepage" name="homepage" value="{{$company->homepage}}"></li>
                                        @if($errors->has('homepage'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('homepage')}}</p>
                                        @endif
                                        <li><label for="comment">企業からのコメント</label><br>
                                            <textarea type="text" id="comment" name="comment" style="width:100%;">{{$company->comment}}</textarea>
                                        </li>
                                        @if($errors->has('comment'))
                                        <p class="error-text" style="margin-top: -10px">{{$errors->first('comment')}}</p>
                                        @endif
                                    </ul>
                                </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="toEdit_btn">更新</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
