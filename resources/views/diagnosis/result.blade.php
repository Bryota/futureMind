@extends('layouts.layout')
@section('content')
    <main>
        <span id="js_future_developmentValue" data-futuredevelopmentvalue="{{$futureDiagnosisDataAsArray[0]}}"></span>
        <span id="js_future_socialValue" data-futuresocialvalue="{{$futureDiagnosisDataAsArray[1]}}"></span>
        <span id="js_future_stableValue" data-futurestablevalue="{{$futureDiagnosisDataAsArray[2]}}"></span>
        <span id="js_future_teammateValue" data-futureteammatevalue="{{$futureDiagnosisDataAsArray[3]}}"></span>
        <span id="js_future_futureValue" data-futurefuturevalue="{{$futureDiagnosisDataAsArray[4]}}"></span>
        <span id="js_self_developmentValue" data-selfdevelopmentvalue="{{$selfDiagnosisDataAsArray[0]}}"></span>
        <span id="js_self_socialValue" data-selfsocialvalue="{{$selfDiagnosisDataAsArray[1]}}"></span>
        <span id="js_self_stableValue" data-selfstablevalue="{{$selfDiagnosisDataAsArray[2]}}"></span>
        <span id="js_self_teammateValue" data-selfteammatevalue="{{$selfDiagnosisDataAsArray[3]}}"></span>
        <span id="js_self_futureValue" data-selffuturevalue="{{$selfDiagnosisDataAsArray[4]}}"></span>
        <div class="result_wrap">
        <h3 class="diagnosis_title primary_title">分析結果</h3>
        <div class="result_content">
            <div class="container">
                <div class="row">
                    <div class="result_chart">
                        <canvas id="resultChart" width="60%" height="40%"></canvas>
                    </div>
                    <div class="result_text">
                        <div class="result_tabs">
                            <div class="result_tab self_tab checked"><span >今の自分</span></div>
                            <div class="result_tab future_tab"><span >理想の自分</span></div>
                            <div class="result_tab want_tab"><span>なりたい自分へ</span></div>
                        </div>
                        <div class="self_text content_wrap active">
                            <div class="text_wrap">
                                <h3 class="text_title">今の自分</h3>
                                @foreach ($selfComments as $selfComment)
                                <h4 class="comment_type">{{$selfComment->comment_type}}</h4>
                                <p class="text_content">
                                    {{$selfComment->comment}}
                                </p>
                                @endforeach
                            </div>
                            <div class="result_btn_wrap">
                                <a href="{{route('diagnosis.selfCompany')}}" class="result_btn self_btn"><span>オススメの企業</span></a>
                            </div>
                        </div>
                        <div class="future_text content_wrap">
                            <div class="text_wrap">
                                <h3 class="text_title">理想の自分</h3>
                                @foreach ($futureComments as $futureComment)
                                <h4 class="comment_type">{{$futureComment->comment_type}}</h4>
                                <p class="text_content">
                                    {{$futureComment->comment}}
                                </p>
                                @endforeach
                            </div>
                            <div class="result_btn_wrap">
                                <a href="{{route('diagnosis.futureCompany')}}" class="result_btn future_btn"><span>オススメの企業</span></a>
                            </div>
                        </div>
                        <div class="gap_text content_wrap">
                            <div class="text_wrap">
                                <h3 class="text_title">理想の自分へ</h3>
                                @foreach ($toFutureComments as $toFutureComment)
                                <h4 class="comment_type">{{$toFutureComment->comment_type}}</h4>
                                <p class="text_content">
                                    {{$toFutureComment->comment}}
                                </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
