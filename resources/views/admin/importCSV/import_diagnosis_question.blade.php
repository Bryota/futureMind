@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">診断質問インポート</h3>
            <form action="{{ route('admin.diagnosis_question_store') }}" class="mt-5 admin_edit_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 form-group">
                    <label for="question" class="form-label">ファイル</label>
                    @if($errors->has('file'))
                    <p class="error-text">{{$errors->first('file')}}</p>
                    @endif
                    <input type="file" id="file" name="file" class="form-control-file" accept=".xlsx, .csv">
                </div>
                <div class="text-center mt-4">
                    <input type="submit" class="btn btn_edit" value="アップロード">
                </div>
            </form>
        </div>
    </div>
</main>
@endsection