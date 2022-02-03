@extends('layouts.company_header')
@section('content')
    <main>
        <div class="companyList_wrap">
            <div class="container">
            <h3 class="companyList_title primary_title">お気に入りをされた学生</h3>
            <div class="companies">
                <div class="row">
                @if(!$likeUsers->isEmpty())
                    @foreach($likeUsers as $user)
                    <div class="col-md-4">
                        @if($user->img_name)
                            <a href="{{route('company.singleStudent',['id'=>$user->id])}}"><img class="company_logo primary_border" src="{{Storage::disk('s3')->url($user->img_name)}}" alt="{{$user->name}}"></a>
                            <p class="company_name">{{$user->name}}@if ($user->unCheckedMessageNum) <span>{{ $user->unCheckedMessageNum }}</span> @endif</p>
                        @else
                            <a href="{{route('company.singleStudent',['id'=>$user->id])}}">{{$user->name}}</a>
                            <span class="company_name">@if ($user->unCheckedMessageNum) <span>{{ $user->unCheckedMessageNum }}</span> @endif</span>
                        @endif
                    </div>
                    @endforeach
                @else
                <div class="text-center" style="width:100%;">
                    <p style="font-size:25px; font-weight:bold;">お気に入りに入れた学生はまだいません</p>
                </div>
                @endif
                </div>
                <div class="text-center" style="margin:0 auto; display: table;">
                    {{$likeUsers->links()}}
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection
