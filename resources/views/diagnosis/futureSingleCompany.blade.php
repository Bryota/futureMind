@extends('layouts.layout')
@section('content')
    <main>
        <div class="singleCompany_wrap">
            <div class="singleCompany_title future_color">{{$company->name}}</div>
            <div class="singleCompany_content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 order-xl-2 company_details">
                            <div class="text-center"><img class="company_logo future_logo" src="{{Storage::disk('s3')->url($company->company_icon)}}" alt=""></div>
                            <div class="company_info">
                                <ul>
                                    <li>企業名：{{$company->name}}</li>
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
                        <div class="col-xl-6 order-xl-1 singleCompany_analysis">
                            <div class="analysis_title future_color">あなたが足りない点</div>
                            <div class="analysis_content">
                                <ul>
                                    @foreach($companyComments as $companyComment)
                                    <li style="margin-top: 20px;">〇{{$companyComment->comment_type}}<br>
                                        {{$companyComment->comment}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if($isLiked === false)
                    <form method="POST" action="{{ route('diagnosis.futureLikeCompany',['id'=>$company->id])}}" class="likes_btn_wrap text-center">
                    @csrf
                        <input type="hidden" name="company_id" value="{{$company->id}}"/>
                        <button type="submit" class="likes_btn future_btn"><span>お気に入りに追加</span></button>
                    </form>
                    @else
                    <div  class="likes_btn_wrap text-center">
                        <p type="submit" class="likes_btn liked_btn"><span>お気に入りに追加済み</span></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
