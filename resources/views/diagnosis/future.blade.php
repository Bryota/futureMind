@extends('layouts.layout')
@section('content')
<main>
    <div class="bg_line top future_color"></div>
    <div class="bg_line bottom future_color"></div>
    <div class="diagnosis_wrap">
        <div class="container">
            <h3 class="diagnosis_title future_title">理想分析</h3>
            <div class="questions_wrap">
                @foreach ($questions as $question)
                @php $next_id = $loop->iteration + 1; @endphp
                <div id="q{{ $loop->iteration }}" class="question_wrap {{ $loop->first ? 'show' : 'hidden'}}">
                    <p class="diagnosis_num">No.{{ $loop->iteration }}</p>
                    <p class="diagnosis_content">{{ $question->question }}</p>
                    <div class="diagnosis_selects">
                        <div class="row">
                            <div class="col-2 offset-md-1">
                                <a href='{{ $loop->last ? "#submit" : "#q$next_id" }}' class="diagnosis_btn diagnosis_future_btn" data-{{ $question->diagnosisDataType() }}="1"><span class="circle circle_big circle_no"></span></a>
                            </div>
                            <div class="col-2">
                                <a href='{{ $loop->last ? "#submit" : "#q$next_id" }}' class="diagnosis_btn diagnosis_future_btn" data-{{ $question->diagnosisDataType() }}="2"><span class="circle circle_middle circle_no"></span></a>
                            </div>
                            <div class="col-2">
                                <a href='{{ $loop->last ? "#submit" : "#q$next_id" }}' class="diagnosis_btn diagnosis_future_btn" data-{{ $question->diagnosisDataType() }}="3"><span class="circle circle_small"></span></a>
                            </div>
                            <div class="col-2">
                                <a href='{{ $loop->last ? "#submit" : "#q$next_id" }}' class="diagnosis_btn diagnosis_future_btn" data-{{ $question->diagnosisDataType() }}="4"><span class="circle circle_middle circle_yes"></span></a>
                            </div>
                            <div class="col-2">
                                <a href='{{ $loop->last ? "#submit" : "#q$next_id" }}' class="diagnosis_btn diagnosis_future_btn" data-{{ $question->diagnosisDataType() }}="5"><span class="circle circle_big circle_yes"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="diagnosis_select_text">
                        <div class="row">
                            <div class="col-2 offset-md-1">
                                <p>そう思わない</p>
                            </div>
                            <div class="col-2 offset-md-6 offset-8">
                                <p>そう思う</p>
                            </div>
                        </div>
                    </div>
                    <div class="diagnosis_counts">
                        @for($i = 1; $i <= $question->count(); $i++)
                            <span class="diagnosis_count {{ $i <= $loop->iteration ? 'checked' : '' }}"></span>
                            @endfor
                    </div>
                </div>
                @endforeach
                <div id="submit" class="question_wrap hidden">
                    <form action="{{route('diagnosis.futurePost')}}" method="post" class="text-center">
                        @csrf
                        <input class="diagnosis_submit future_btn" type="submit" value="送信">
                        <input type="hidden" id="developmentvalue" name="developmentvalue">
                        <input type="hidden" id="socialvalue" name="socialvalue">
                        <input type="hidden" id="stablevalue" name="stablevalue">
                        <input type="hidden" id="teammatevalue" name="teammatevalue">
                        <input type="hidden" id="futurevalue" name="futurevalue">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection