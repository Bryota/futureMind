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
                            <div class="text-center mb-10"><input type="file" name="company_icon" accept="image/*"></div>
                            <div class="company_info company_edit">
                                <ul>
                                    <li><label for="company">企業名</label>：<input type="text" id="company" name="name" value="{{$company->name}}"></li>
                                    @if($errors->has('name'))
                                    <p class="error-text" style="margin-top: -10px">{{$errors->first('name')}}</p>
                                    @endif
                                    <li><label for="industry">業界</label>：
                                        <select id="industry" name="industry">
                                            @foreach(IndustryConst::INDUSTRY_CONST as $industry)
                                            @if($industry === $company->industry)
                                            <option value="{{$industry}}" selected>{{$industry}}</option>
                                            @else
                                            <option value="{{$industry}}">{{$industry}}</option>
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
                                    @if($errors->has('comment'))
                                    <p class="error-text" style="margin-top: -10px">{{$errors->first('comment')}}</p>
                                    @endif
                                    <li><label for="voice">音声メッセージ</label><br>
                                        <audio src="{{$company->voicePath}}" controls></audio>
                                        <input type="file" id="voice" name="voice" accept="webm">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            録音する
                                        </button>
                                    </li>
                                    @if($errors->has('voice'))
                                    <p class="error-text" style="margin-top: -10px">{{$errors->first('voice')}}</p>
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="mb-3">
                                <button id="start" class="btn btn-primary mr-2" type="button">開始</button><button id="stop" class="btn btn-danger" type="button" disabled>終了</button>
                            </div>
                            <p><audio id="audio" controls></audio></p>
                            <p>録音しただけでは、音声メッセージは更新されません。お手数ですが、一度音声ファイルをダウンロードしてからファイルをアップロードしてください。</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection