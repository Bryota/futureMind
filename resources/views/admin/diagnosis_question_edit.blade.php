@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">診断質問編集</h3>
            <form action="{{ route('admin.diagnosis_question_update', ['id' => $question->id]) }}" class="mt-5 admin_edit_form" method="POST">
                @csrf
                <div class="mb-3 form-group">
                    <label for="question" class="form-label">質問</label>
                    @if($errors->has('question'))
                    <p class="error-text">{{$errors->first('question')}}</p>
                    @endif
                    <textarea type="text" class="form-control" id="question" name="question">{{ $question->question }}</textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="type" class="form-label">タイプ</label>
                    @if($errors->has('diagnosis_type'))
                    <p class="error-text">{{$errors->first('diagnosis_type')}}</p>
                    @endif
                    <select class="form-select form-control d-block" id="type" name="diagnosis_type">
                        @foreach(CommentTypeConst::Comment_Type as $diagnosis_type)
                        @if($diagnosis_type === $question->diagnosisTextType())
                        <option value="{{$loop->index}}" selected>{{$diagnosis_type}}</option>
                        @else
                        <option value="{{$loop->index}}">{{$diagnosis_type}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 form-group">
                    <label for="weight" class="form-label">順番</label>
                    @if($errors->has('weight'))
                    <p class="error-text">{{$errors->first('weight')}}</p>
                    @endif
                    <input type="number" class="form-control" id="weight" name="weight" value="{{ $question->weight }}">
                </div>
                <div class="text-center mt-4">
                    <input type="submit" class="btn btn_edit" value="変更">
                </div>
            </form>
        </div>
    </div>
</main>
@endsection