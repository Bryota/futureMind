@extends('layouts.layout')
@section('content')
    <main>
        <div class="bg_line top primary_color"></div>
        <div class="bg_line bottom primary_color"></div>
        <div class="search_wrap">
            <div class="container">
            <h3 class="search_title primary_title">企業検索</h3>
            <div class="search_form">
                <form action="{{route('search.searchPost')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-2 text-center form_item_wrap">
                            <p class="form_item"><label for="industry">業種</label></p>
                            <select name="industry" id="industry">
                                <option value="メーカー">メーカー</option>
                                <option value="商社">商社</option>
                                <option value="マスコミ">マスコミ</option>
                                <option value="物流">物流</option>
                                <option value="不動産">不動産</option>
                                <option value="IT">IT</option>
                                <option value="医療">医療</option>
                                <option value="教育">教育</option>
                                <option value="流通">流通</option>
                                <option value="金融">金融</option>
                                <option value="コンサルティング">コンサルティング</option>
                                <option value="環境">環境</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>
                        <div class="col-xl-2 text-center form_item_wrap">
                            <p class="form_item"><label for="area">地域</label></p>
                            <select name="area" id="area">
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都" selected>東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                            </select>
                        </div>
                        <div class="col-xl-2 text-center form_item_wrap">
                            <p class="form_item"><label for="employee">規模</label></p>
                            <select name="employee" id="employee">
                                <option value="~50">~50人</option>
                                <option value="51~100">51~100人</option>
                                <option value="101~300">101~300人</option>
                                <option value="301~500">301~500人</option>
                                <option value="501~1000">501~1000人</option>
                                <option value="1000~">1000人~</option>
                            </select>
                        </div>
                        <div class="col-xl-6 text-center range_wrap form_item_wrap">
                            <p class="form_item">詳細条件</p>
                            <p class="range_label"><label for="development">成長意欲</label></p>
                            <p><input class="range" type="range" id="development" name="development" min="1" max="5" step="1" value="1"><span class="range_value" style="margin-left:10px;">1</span></p>
                            <p class="range_label"><label for="social">社会貢献</label></p>
                            <p><input class="range" type="range" id="social" name="social" min="1" max="5" step="1" value="1"><span class="range_value" style="margin-left:10px;">1</span></p>
                            <p class="range_label"><label for="stable">安定</label></p>
                            <p><input class="range" type="range" id="stable" name="stable" min="1" max="5" step="1" value="1"><span class="range_value" style="margin-left:10px;">1</span></p>
                            <p class="range_label"><label for="teammate">仲間</label></p>
                            <p><input class="range" type="range" id="teammate" name="teammate" min="1" max="5" step="1" value="1"><span class="range_value" style="margin-left:10px;">1</span></p>
                            <p class="range_label"><label for="future">将来性</label></p>
                            <p><input class="range" type="range" id="future" name="future" min="1" max="5" step="1" value="1"><span class="range_value" style="margin-left:10px;">1</span></p>
                        </div>
                    </div>
                    <div class="search_btn_wrap">
                        <button type="submit" class="search_btn future_btn"><span>検索</span></button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </main>
@endsection