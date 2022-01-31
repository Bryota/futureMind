@extends('layouts.layout_chat_user')
@section('content')
    <main>
        <div class="chat_wrap">
            <div class="container">
            <h3 class="chat_title">チャット</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center chat_user">
                            <p class="chat_name">{{$company_user->name}}</p>
                            <img class="chat_img" src="{{Storage::disk('s3')->url($company_user->company_icon)}}" alt="画像">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="message_wrap message_wrap_student" id="message_wrap">
                        </div>
                    </div>
                    <div class="col-md-3 auth_profile">
                        <div class="text-center chat_user">
                            <p class="chat_name">あなた</p>
                            @if($student_user->img_name)
                                <img class="chat_img" src="{{Storage::disk('s3')->url($student_user->img_name)}}" alt="画像">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="chat_form_wrap">
                    <div class="input-group mb-3 chat_form">
                        <input type="text" class="form-control chat_input" name="message" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <input type="hidden" name="room_id" value="{{ $room_id }}" >
                        <div class="input-group-append chat_btn_wrap">
                            <button class="btn btn-outline-secondary chat_btn" type="submit" >送信</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
