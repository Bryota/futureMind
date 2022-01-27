@extends('layouts.layout')
@section('content')
    <main>
        <div class="companyList_wrap">
            <div class="container">
            <h3 class="companyList_title primary_title">検索結果</h3>
            <div class="companies">
                <div class="row">
                @if(!$companies->isEmpty())
                    @foreach($companies as $company)
                    <div class="col-md-4">
                        <a  href="{{route('search.single',['id'=>$company->id])}}"><img class="company_logo primary_border" src="{{Storage::disk('s3')->url($company->company_icon)}}" alt=""></a>
                        <p class="company_name">{{$company->name}}</p>
                    </div>
                    @endforeach
                @else
                <div class="text-center" style="width:100%;">
                    <p style="font-size:25px; font-weight:bold;">申し訳ございません。<br>該当の企業は見つかりませんでした。</p>
                    <a href="{{route('search.search')}}" class="search_btn primary_btn"><span>検索画面</span></a>
                </div>
                @endif
                </div>
                <div class="text-center" style="margin:0 auto; display: table;">
                {{ $companies->appends(request()->input())->links() }}
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection
