@extends('layouts.admin_header')

@section('content')
<main>
    <div class="admin_wrap">
        <div class="container">
            <h3 class="page_title">管理画面</h3>
            <div class="data_wrap">
                <div class="user_data">
                    <div class="data_header">
                        <p>学生</p>
                    </div>
                    <div class="data_body">
                        <ul>
                            <li>登録者数：{{ $student_num }}人</li>
                        </ul>
                    </div>
                </div>
                <div class="company_data">
                    <div class="data_header">
                        <p>企業</p>
                    </div>
                    <div class="data_body">
                        <ul>
                            <li>登録者数：{{ $company_num }}人</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection