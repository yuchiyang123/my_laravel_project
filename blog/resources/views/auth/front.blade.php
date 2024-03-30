<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
@extends('layouts.frontpage')

@section('title', '')

@section('condition_add')
<div class="condition">
    <div class="radio-tophead d-block mx-auto fs-3 fw-bolder ">
        <label></label>
    </div>
    <div class="condition-radio text-start">
        <div class="radio-head fs-5 fw-bolder border-bottom pb-2">
            <label>天數</label-->
        </div>

        <div class="radio-group pt-2 pb-1">
            <div class="form-check pb-1">
                <input class="form-check-input " type="radio" name="date" value=""><label class="form-check-label fw-bold">全部(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input pb-2" type="radio" name="date" value="1day"><label class="form-check-label fw-bold">當天來回(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input" type="radio" name="date" value="2days"><label class="form-check-label fw-bold">兩日遊(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input" type="radio" name="date" value="3days"><label class="form-check-label fw-bold">三日遊(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input" type="radio" name="date" value="4days"><label class="form-check-label fw-bold">四天~六天(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input" type="radio" name="date" value="7days"><label class="form-check-label fw-bold">七天~九天(0)</label>
            </div>
        </div>
        <div class="radio-group">
            <div class="form-check pb-1">
                <input class="form-check-input" type="radio" name="date" value="10days"><label class="form-check-label fw-bold">十天以上(0)</label>
            </div>
        </div>
    </div>

    <div class="condition-radio text-start">
        <div class="condition-radio">
            <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                <label>性別</label>
            </div>
            <div class="radio-group">
                <div class="form-check pt-2 pb-1">
                    <input class="form-check-input" type="radio" name="sex" value=""><label class="form-check-label fw-bold">不拘</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="sex" value="male"><label class="form-check-label fw-bold">男</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="sex" value="woman"><label class="form-check-label fw-bold">女</label>
                </div>
            </div>
        </div>
    </div>



    <div>
        <div class="condition-radio text-start">
            <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                <label>技能</label>
            </div>
            <div class="radio-group">
                <div class="form-check pt-2 pb-1">
                    <input class="form-check-input" type="radio" name="skill" value=""><label class="form-check-label fw-bold">不拘</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="skill" value="car"><label class="form-check-label fw-bold">開車</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="skill" value="motorcycle"><label class="form-check-label fw-bold">騎車</label>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="condition-radio text-start">
            <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                <label>人數</label>
            </div>
            <div class="radio-group">
                <div class="form-check pt-2 pb-1">
                    <input class="form-check-input" type="radio" name="NOpeople" value=""><label class="form-check-label fw-bold">不拘</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="NOpeople" value="two"><label class="form-check-label fw-bold">2~4人</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="NOpeople" value="five"><label class="form-check-label fw-bold">5~7人</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="NOpeople" value="eight"><label class="form-check-label fw-bold">8~10人</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="NOpeople" value="tenOver"><label class="form-check-label fw-bold">10人以上</label>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="condition-radio text-start">
            <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                <label>年齡</label>
            </div>
            <div class="radio-group">
                <div class="form-check pt-2 pb-1">
                    <input class="form-check-input" type="radio" name="age" value=""><label class="form-check-label fw-bold">不拘</label>
                </div>
            </div>
            <div class="radio-group pb-1">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="age" value="20y"><label class="form-check-label fw-bold">20~30歲</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="age" value="31y"><label class="form-check-label fw-bold">31~40歲</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="age" value="41y"><label class="form-check-label fw-bold">41~50歲</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-2">
                    <input class="form-check-input" type="radio" name="age" value="51y"><label class="form-check-label fw-bold">51歲以上</label>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('Post')
@foreach($mjoins as $mjoin)
@php
$sectionName = 'Post' . $loop->iteration;
@endphp

<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="image-container">
                {{ $mjoin->posted_by }}
            </div>
            <div class="text-container">
                <div class="user">
                    <!--貼文用戶名-->
                    <div><a href="#">{{ $mjoin->posted_by }}</a></div>
                </div>
                <div class="date">
                    <!--貼文日期-->
                    <div><a href="#">{{ $mjoin->date }}</a></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <p class="main">
                {!! wordwrap($mjoin->description, 86, "<br>\n", true) !!}
                <div class="trigger">
                    <a href="#" id="{{ $mjoin->id }}" data-mjoin-id="{{ $mjoin->id }}" onclick="showPopup({{ $mjoin->id }})">查看完整内容</a>
                </div>
            </p>
            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                    <div>

                        <a href="#">58</a>
                    </div>
                </div>
                <div class="message">
                    <div>
                        <a href="#">8則留言</a>
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="inner-grid">@yield("PostAcion1")</div>
                <div class="inner-grid">@yield("PostAcion2")</div>
                <div class="inner-grid">@yield("PostAcion3")</div>
            </div>
            <div class="SeeAllMessage">
                <a href="#">查看全部留言</a>
            </div>
            <div class="ShowAllMessage" id="showAllMessage_{{ $mjoin->id }}">
                
            </div>
            <div class="ShowAllMessage">
                <script>
                   $(document).ready(function() {
                        showReply({{ $mjoin->id }});
                    });
                    function showReply(mjoinId) {
                        $.ajax({
                            url:"/front-reply/" + mjoinId,
                            type: "GET",
                            success: function(response) {
                                // 在彈出的視窗中顯示留言
                                console.log(response);
                                $('#showAllMessage_' + mjoinId).html(response.htmlContent);
                                $('#showAllMessage_' + mjoinId).show();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        })
                    }
                </script>
               
            </div>
            
        </div>
    </div>
</div>
<br>
@endforeach
@endsection



@section('')
@endsection