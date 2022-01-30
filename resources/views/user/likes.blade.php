@extends('layouts.layout')
@section('content')
    <main>
        <div class="companyList_wrap">
            <div class="container">
            <h3 class="companyList_title primary_title">お気に入りの企業</h3>
            <div class="companies">
                <div class="row">
                @if(!$likeCompanies->isEmpty())
                    @foreach($likeCompanies as $company)
                    <div class="col-md-4">
                    @if(app('env')=='local')
                        <a  href="{{route('search.single',['id'=>$company->id])}}"><img class="company_logo primary_border" src="{{asset('storage/images/' . $company->company_icon)}}" alt=""></a>
                    @else
                        <a  href="{{route('search.single',['id'=>$company->id])}}"><img class="company_logo primary_border" src="{{secure_asset('storage/images/' . $company->company_icon)}}" alt=""></a>
                    @endif
                        <p class="company_name">{{$company->name}}</p>
                    </div>
                    @endforeach
                @else
                <div class="text-center" style="width:100%;">
                    <p style="font-size:25px; font-weight:bold;">お気に入りの企業がありません。</p>
                </div>
                @endif
                </div>
                <div class="text-center">
                    {{$likeCompanies->links()}}
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection
