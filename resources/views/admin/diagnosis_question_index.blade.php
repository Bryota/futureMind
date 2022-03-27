@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">診断質問コメント<a href="{{ route('admin.diagnosis_question_import') }}" class="btn btn_add">追加</a></h3>
            <table class="table admin_comment_list_table mt-3">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%">id</th>
                        <th scope="col" style="width: 50%">質問</th>
                        <th scope="col" style="width: 10%">タイプ</th>
                        <th scope="col" style="width: 5%">順番</th>
                        <th scope="col" style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->diagnosisTextType() }}</td>
                        <td>{{ $question->weight}}</td>
                        <td>
                            <a href="{{ route('admin.diagnosis_question_edit', ['id' => $question->id ]) }}" class="btn btn_edit">編集</a>
                            <form method="POST" action="{{ route('admin.diagnosis_question_delete', ['id' => $question->id ]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn_delete">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection