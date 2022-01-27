@extends('layouts.company_header')

@section('content')
<main>
        <div class="bg_line top company_color"></div>
        <div class="bg_line bottom company_color"></div>
        <div class="diagnosis_wrap">
            <div class="container">
                <h3 class="diagnosis_title company_title">企業診断</h3>
                <div class="questions_wrap">
                    <div id="q1" class="question_wrap show">
                        <p class="diagnosis_num">No.1</p>
                        <p class="diagnosis_content">パンは最高の朝食である</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q2" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q2" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q2" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q2" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q2" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q2" class="question_wrap hidden">
                        <p class="diagnosis_num">No.2</p>
                        <p class="diagnosis_content">朝食は7時に食べる</p>
                        <div class="diagnosis_selects">
                        <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q3" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q3" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q3" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q3" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q3" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count "></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q3" class="question_wrap hidden">
                        <p class="diagnosis_num">No.3</p>
                        <p class="diagnosis_content">設問３サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q4" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q4" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q4" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q4" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q4" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q4" class="question_wrap hidden">
                        <p class="diagnosis_num">No.4</p>
                        <p class="diagnosis_content">設問４サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q5" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q5" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q5" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q5" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q5" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q5" class="question_wrap hidden">
                        <p class="diagnosis_num">No.5</p>
                        <p class="diagnosis_content">設問５サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q6" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q6" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q6" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q6" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q6" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q6" class="question_wrap hidden">
                        <p class="diagnosis_num">No.6</p>
                        <p class="diagnosis_content">設問６サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q7" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q7" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q7" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q7" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q7" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q7" class="question_wrap hidden">
                        <p class="diagnosis_num">No.7</p>
                        <p class="diagnosis_content">設問７サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q8" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q8" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q8" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q8" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q8" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count "></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q8" class="question_wrap hidden">
                        <p class="diagnosis_num">No.8</p>
                        <p class="diagnosis_content">設問８サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q9" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q9" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q9" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q9" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q9" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q9" class="question_wrap hidden">
                        <p class="diagnosis_num">No.9</p>
                        <p class="diagnosis_content">設問９サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q10" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q10" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q10" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q10" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q10" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q10" class="question_wrap hidden">
                        <p class="diagnosis_num">No.10</p>
                        <p class="diagnosis_content">設問１０サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q11" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q11" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q11" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q11" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q11" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q11" class="question_wrap hidden">
                        <p class="diagnosis_num">No.11</p>
                        <p class="diagnosis_content">設問１１サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q12" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q12" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q12" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q12" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q12" class="diagnosis_btn diagnosis_company_btn" data-companydevelopmentvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q12" class="question_wrap hidden">
                        <p class="diagnosis_num">No.12</p>
                        <p class="diagnosis_content">設問１２サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q13" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q13" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q13" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q13" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q13" class="diagnosis_btn diagnosis_company_btn" data-companysocialvalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q13" class="question_wrap hidden">
                        <p class="diagnosis_num">No.13</p>
                        <p class="diagnosis_content">設問１３サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q14" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q14" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q14" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q14" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q14" class="diagnosis_btn diagnosis_company_btn" data-companystablevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q14" class="question_wrap hidden">
                        <p class="diagnosis_num">No.14</p>
                        <p class="diagnosis_content">設問１４サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#q15" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q15" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q15" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q15" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#q15" class="diagnosis_btn diagnosis_company_btn" data-companyteammatevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="q15" class="question_wrap hidden">
                        <p class="diagnosis_num">No.15</p>
                        <p class="diagnosis_content">設問１５サンプルテキスト</p>
                        <div class="diagnosis_selects">
                            <div class="row">
                                <div class="col-2 offset-md-1">
                                    <a href="#submit" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="1"><span class="circle circle_big circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#submit" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="2"><span class="circle circle_middle circle_no"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#submit" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="3"><span class="circle circle_small"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#submit" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="4"><span class="circle circle_middle circle_yes"></span></a>
                                </div>
                                <div class="col-2">
                                    <a href="#submit" class="diagnosis_btn diagnosis_company_btn" data-companyfuturevalue="5"><span class="circle circle_big circle_yes"></span></a>
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
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count checked"></span>
                            <span class="diagnosis_count"></span>
                        </div>
                    </div>
                    <div id="submit" class="question_wrap hidden">
                            <form action="{{route('company.diagnosisPost')}}" method="post" class="text-center">
                                @csrf
                                <input class="diagnosis_submit company_btn" type="submit" value="送信">
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
    </main>
@endsection
