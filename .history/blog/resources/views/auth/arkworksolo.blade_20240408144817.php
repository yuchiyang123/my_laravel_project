
@extends('layouts.frontpage')

@section('title', '')

@section('Post')

<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="text-container">
                <div class="title">
                    <h3>{{ $userarkworksolo->title }}</h3>
                </div>
            </div>
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                <label class="flex-fill ps-3">{{ $userarkworksolo->posted_by_u }}</label>
                <label class="flex-fill">{{ $userarkworksolo->created_at }}</label>
            </div>
            <div class="clearfix"></div>
            <div class="image-container">
                <div class="d-block mb-3 text-start text-break">
                    {!! $userarkworksolo->main !!}
                </div>
            </div>


            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                    <div>
                        <a href="#">0</a>
                    </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $userarkworksolo->id }}">

                </div>
            </div>
            <div class="line">
                <div class="inner-grid">讚</div>
                <div class="inner-grid">
                    <a href="#"></a>
                </div>
                <div class="inner-grid">更多</div>
            </div>

            </div>
            <form action="" method="POST">
                @csrf
                <div class="LeaveMessageInput flex-row">
                    <div class="LeaveMessageInputrpAname p-2">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    </div>
                    <div class="p-2">
                        <textarea class="form-control" placeholder="留言" id="floatingTextarea_{{ $userarkworksolo->id }}" name="MessageTextarea_{{ $userarkworksolo->id }}" rows="1"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">留言</button>
            </form>
        </div>
    </div>
</div>

@endsection