
@extends('admin.layout.layout')

@section('main_content')

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

@endsection