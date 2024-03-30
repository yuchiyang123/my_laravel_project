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

@foreach($mjoins as $mjoin)
    @section('Post')
        
    @endsection
    @section('PostUsernameIMG')
            {{ $mjoin->posted_by }}
        @endsection
        @section('PostUsername')
            {{ $mjoin->posted_by }}
        @endsection 
        @section('CreatedData')
            {{ $mjoin->date }}
        @endsection

@endforeach

@section('')
@endsection

