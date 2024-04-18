<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
@include ('header')

@extends('layouts.frontpage')

@section('title', '')

@section('Post')

<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="image-container">
                <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                </a>
            </div>
            <div class="text-container">
                <div class="title">
                    <!--貼文用戶名-->
                    <div>{{ $userarkworksolo->title }}</a></div>
                </div>
                <div class="user">
                    <!--貼文用戶名-->
                    <div><a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">{{ $mjoin->posted_by_u }}</a></div>
                </div>
                <div class="date">
                    <!--貼文日期-->
                    <div><a href="#">{{ $userarkworksolo->created_at }}</a></div>
                </div>
            </div>
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                <label class="flex-fill ps-3">{{ $userarkworksolo->posted_by_u }}</label>
                <label class="flex-fill">{{ $userarkworksolo->created_at }}</label>
                <label class="flex-fill">預算:{{ $mjoin->money }}</label>
                <label class="flex-fill">性別:{{ $mjoin->sex }}</label>
                <label class="flex-fill">需要技能:{{ $mjoin->skill }}</label>
                <label class="flex-fill pe-3">年齡:{{ $mjoin->age }}</label>
            </div>
            <div class="clearfix"></div>
            <div class="image-container">
                <div class="d-block mb-3 text-start text-break">
                    {!! $mjoin->description !!}
                </div>
            </div>


            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                    <div>
                        <a href="#">0</a>
                    </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $mjoin->id }}">

                </div>
            </div>
            <div class="line">
                <div class="inner-grid">讚</div>
                <div class="inner-grid">
                    <a href="#" id="{{ $mjoin->id }}" data-mjoin-id="{{ $mjoin->id }}" onclick="showPopup({{ $mjoin->id }})">查看完整内容</a>
                </div>
                <div class="inner-grid">更多</div>
            </div>

            </div>
            <form action=" {{ route('front.reply.submit', ['mjoinid' => $mjoin->id]) }}" method="POST">
                @csrf
                <div class="LeaveMessageInput flex-row">
                    <div class="LeaveMessageInputrpAname p-2">
                        <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                    </div>
                    <div class="p-2">
                        <textarea class="form-control" placeholder="留言" id="floatingTextarea_{{ $mjoin->id }}" name="MessageTextarea_{{ $mjoin->id }}" rows="1"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">留言</button>
            </form>
        </div>
    </div>
</div>

@endsection