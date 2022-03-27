@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">自己分析会社コメント</h3>
            <table class="table admin_comment_list_table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%">id</th>
                        <th scope="col" style="width: 55%">コメント</th>
                        <th scope="col" style="width: 10%">タイプ</th>
                        <th scope="col" style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->comment_type }}</td>
                        <td>
                            <a href="{{ route('admin.self_company_edit', ['id' => $comment->id ]) }}" class="btn btn_edit">編集</a>
                            <form method="POST" action="{{ route('admin.self_company_delete', ['id' => $comment->id ]) }}">
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