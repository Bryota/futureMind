@extends('layouts.layout')
@section('content')
    <main>
        <div class="companyList_wrap">
            <div class="container">
            <h3 class="companyList_title self_title">オススメの企業</h3>
            <div class="companies">
                <div class="row">
                    @if(!$companies->isEmpty())
                        @foreach($companies as $company)
                        <div class="col-md-4">
                            <a  href="{{route('diagnosis.selfSingleCompany',['id'=>$company->id])}}"><img class="company_logo primary_border" src="{{Storage::disk('s3')->url($company->company_icon)}}" alt=""></a>
                            <p class="company_name">{{$company->name}}</p>
                        </div>
                        @endforeach
                    @else
                    <div class="text-center" style="width:100%;">
                        <p style="font-size:25px; font-weight:bold;">申し訳ございません。<br>オススメの企業は見つかりませんでした。</p>
                        <a href="{{route('diagnosis.result')}}" class="search_btn future_btn"><span>結果へ戻る</span></a>
                    </div>
                    @endif
                    <div class="text-center" style="margin:0 auto 30px; display: table;">
                        {{$companies->links()}}
                    </div>
            </div>
            </div>
        </div>
    </main>
@endsection
