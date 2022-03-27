@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">自己分析編集</h3>
            <form action="{{ route('admin.self_update', ['id' => $comment->id ]) }}" class="mt-5 admin_edit_form" method="POST">
                @csrf
                <div class="mb-3 form-group">
                    <label for="comment" class="form-label">コメント</label>
                    @if($errors->has('comment'))
                    <p class="error-text">{{$errors->first('comment')}}</p>
                    @endif
                    <textarea type="text" class="form-control" id="comment" name="comment">{{ $comment->comment }}</textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="type" class="form-label">タイプ</label>
                    @if($errors->has('comment_type'))
                    <p class="error-text">{{$errors->first('comment_type')}}</p>
                    @endif
                    <select class="form-select form-control d-block" id="type" name="comment_type">
                        @foreach(CommentTypeConst::Comment_Type as $comment_type)
                        @if($comment_type === $comment->comment_type)
                        <option value="{{$comment_type}}" selected>{{$comment_type}}</option>
                        @else
                        <option value="{{$comment_type}}">{{$comment_type}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="text-center mt-4">
                    <input type="submit" class="btn btn_edit" value="変更">
                </div>
            </form>
        </div>
    </div>
</main>
@endsection