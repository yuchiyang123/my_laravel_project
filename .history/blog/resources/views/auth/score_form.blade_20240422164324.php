@extends('layouts.app')

@section('title', '用戶評分')

@section('content')
<form method="GET" action="/score_form/submit/{{ $mjoin_author_1->id }}">
    @csrf

<body>
<!-- partial:index.partial.html -->

<div style="text-align: center; ">
    <label for="title" class="FW-bold mb-2" style="font-size: 25PX">揪團用戶評價</label>
    <div><label for="title" class="d-flex justify-content-start FW-bold" style="font-size: 20px">評價揪團-{{ $mjoin_author_1->title }}</label></div>
    @if(Auth::user()->username != $mjoin_author_1->posted_by_u)
        <div class="score-container d-flex justify-content-start pt-2  border-top border-2"><h3 class="fw-bolder">主揪人:{{ $mjoin_author_1->posted_by_u }}</h3></div>
        <div class="feedback d-flex justify-content-center m-1 " >
            <label class="angry">
                @php
                $user_id = DB::table('user')->where('username', $mjoin_author_1->posted_by)->first();
                @endphp
                <input type="radio" value="1" name="feedback{{ $user_id }}" />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="sad">
                <input type="radio" value="2" name="feedback{{ $user_id }}" />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="ok">
                <input type="radio" value="3" name="feedback{{ $mjoin_author_1->$user_id  }}" />
                <div></div>
            </label>
            <label class="good">
                <input type="radio" value="4" name="feedback{{ $mjoin_author_1->$user_id  }}" checked />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="happy">
                <input type="radio" value="5" name="feedback{{ $mjoin_author_1->$user_id  }}" />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                </div>
            </label>
        </div>
                
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
            </symbol>
        </svg>
        @if(session('user_name')!=null)                    
        @csrf
        <div class="LeaveMessageInput flex-row border-bottom border-2">
            <div class="p-2">
                <textarea class="form-control" placeholder="詳細說明這旅程與他想處的經過" id="comments_{{ $mjoin_author_1->posted_by_u }}" 
                    name="comments_{{ $mjoin_author_1->posted_by_u }}" rows="3
                "></textarea>
            </div>
        </div>
        @endif
    @endif
    <!---------->
    @if($join_members_1 != null)
    @foreach($join_members_1 as $join_member)
    @php
        $join_member_name = DB::table('user')->where('id', $join_member->user_id)->first();
    @endphp
    <div class="score-container d-flex justify-content-start pt-2  border-top border-2"><h3 class="fw-bolder">夥伴:{{ $join_member_name }}</h3></div>
<div class="feedback d-flex justify-content-center m-1 " >
    <label class="angry">
        <input type="radio" value="1" name="feedback{{ $join_member->user_id }}" />
        <div>
            <svg class="eye left">
                <use xlink:href="#eye">
            </svg>
            <svg class="eye right">
                <use xlink:href="#eye">
            </svg>
            <svg class="mouth">
                <use xlink:href="#mouth">
            </svg>
        </div>
    </label>
    <label class="sad">
        <input type="radio" value="2" name="feedback{{ $join_member->user_id }}" />
        <div>
            <svg class="eye left">
                <use xlink:href="#eye">
            </svg>
            <svg class="eye right">
                <use xlink:href="#eye">
            </svg>
            <svg class="mouth">
                <use xlink:href="#mouth">
            </svg>
        </div>
    </label>
    <label class="ok">
        <input type="radio" value="3" name="feedback{{ $join_member->user_id }}" />
        <div></div>
    </label>
    <label class="good">
        <input type="radio" value="4" name="feedback{{ $join_member->user_id }}" checked />
        <div>
            <svg class="eye left">
                <use xlink:href="#eye">
            </svg>
            <svg class="eye right">
                <use xlink:href="#eye">
            </svg>
            <svg class="mouth">
                <use xlink:href="#mouth">
            </svg>
        </div>
    </label>
    <label class="happy">
        <input type="radio" value="5" name="feedback{{ $join_member->user_id }}" />
        <div>
            <svg class="eye left">
                <use xlink:href="#eye">
            </svg>
            <svg class="eye right">
                <use xlink:href="#eye">
            </svg>
        </div>
    </label>
</div>
        
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
        <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
        <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
    </symbol>
</svg>
@if(session('user_name')!=null)                    
@csrf
<div class="LeaveMessageInput flex-row border-bottom border-2">
    <div class="p-2">
        <textarea class="form-control" placeholder="詳細說明這旅程與他想處的經過" id="comments_{{ $join_member->user_id }}" name="comments_{{ $join_member->user_id }}" rows="3
        "></textarea>
    </div>
</div>
@endif
@endforeach
@endif
<button type="submit" class="btn btn-primary mt-2" id="submit">評分</button>
</div>

</body>

@endsection