
@extends('admin.layout.layout')

@section('main_content')
<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="text-container">
                <div class="title">
                    <h3>{{ $userarkworksolo->title }}</h3>
                </div>
            </div>
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                <label class="flex-fill ps-3">創作者:{{ $userarkworksolo->username }}</label>
                <label class="flex-fill">創作日期:{{ $userarkworksolo->created_at }}</label>
                <label class="flex-fill">分類:{{ $userarkworksolo->class }}</label>
            </div>
            <div class="clearfix"></div>
            <div class="image-container">
                <div class="d-block mb-3 mt-3 text-start text-break">
                    {!! $userarkworksolo->main !!}
                </div>
            </div>
            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                        <div>
                            <a href="#">
                                <span class="goodcount_{{ $userarkworksolo->id }}"></span>
                            </a>
                        </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $userarkworksolo->id }}">

                </div>
            </div>
        </div>
        <div class="ShowAllMessage" id="">
            @if($userartworkreplys!=null)
                @foreach($userartworkreplys as $userartworkreply)
                <div class="LeaveMessage">
                    <div>
                        <div class="LeaveMessageimgdiv">
                            <a href="/user-profile/index/d/'.$mjoin_reply->name_u.' ">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                            </a>
                        </div>
                        <div class="LeaveMessageall">
                            <div class="LeaveMessageUsername">
                                <a href="/user-profile/index/d/'.$mjoin_reply->name_u.'">{{ $userartworkreply->name_u }}</a>
                            </div>
                            <div class="LeaveMessageMain">
                                {{ $userartworkreply->main }}
                            </div>
                            <div class="LeaveMessageAction">
                                <a href="#">{{ $userartworkreply->created_at }}</a>&emsp;
                                <a href="'.$mjoin_reply->level.$mjoin_reply->reply_id.'">回覆</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                    <h2>無留言</h2>
                </div>
            @endif
            
        </div>
    </div>
    </div>
</div>
<div><button class="btn btn-primary" href="">編輯</button></div>
@endsection