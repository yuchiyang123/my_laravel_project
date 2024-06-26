@extends('admin.layout.layout')

@section('main_content')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<!-- general form elements disabled -->
<div class="card card-warning">
    @if(Session::has('success'))
    <div class="alert alert alert-primary">
        {{ Session::get('success') }}
    </div>
    @endif
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6"><label>用戶頭貼</label>
                <div class="form-group">
                  @php
                    $profile_image_url = 'data:' . $user->profileImage_type . ';base64,' . base64_encode($user->profileImage);
                  @endphp
                  @if(empty($user->profileImage_type))
                  <img src="{{asset('image/head.png')}}" alt="User Image" class="img-circle" style="width: 100px; height: 100px;">
                    @else
                    <img src="{{ $profile_image_url }}" alt="User Image" class="img-circle" style="width: 100px; height: 100px;">
                    @if(!empty($user->profileImage_type))
                        <div style="margin-top: 10px;">
                        <form action="{{ route('user_auth_data_delete_profile_image', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-block btn-primary">清除頭像</button>
                        </form>
                        </div>
                    @endif
                    @endif
                </div>
            </div>
            <form action="{{ route('user_auth_data_submit', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
        
            
            
            <div class="col-sm-12">
                <div class="form-group">
                    <!-- select -->
                    <div class="form-group">
                        <label>性別</label>
                        <select class="form-control" name="sex">
                            @if($user->sex == '未填寫')
                            <option value="未填寫" @if($user->sex == '未填寫') selected @endif>未填寫</option>
                            @endif
                            <option value="male" @if($user->sex == 'male') selected @endif>男</option>
                            <option value="female" @if($user->sex == 'female') selected @endif>女</option>
                        </select>
                        
                        <br>
                        <div class="form-group" name="age">
                            <label name="sex_public" for="timePicker">生日:</label>
                            <input type="time" id="timePicker" name="" class="form-control datepicker" placeholder="{{ $user->age }}" required value="{{ $user->age }}">
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label>用戶名</label>
                  <input type="text" class="form-control" placeholder="{{ $user->username }}" disabled>
                </div>
            </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>電子郵件</label>
              <input type="text" class="form-control" placeholder="{{ $user->email }}" disabled>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label>電話</label>
                  <input type="text" class="form-control" placeholder="@if(!empty($user_phone)){{ $user_phone->phone }}@endif" disabled>
                </div>
              </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>身分組</label>
                <input type="text" class="form-control" placeholder="@if($user->permissions == 3)使用者@elseif($user->permissions ==2)店家@else 管理員 @endif" disabled>
              </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm">
              <div class="form-group">
                <label>密碼</label>
                <input type="password" class="form-control" placeholder="" disabled>
              </div>
            </div>
        </div>
       
        <div class="row">
          <div class="col-sm">
            <!-- textarea -->
            <div class="form-group">
                <label>自我介紹</label>
                <textarea class="form-control" name="self_introduction" rows="3">
                    @if($user_p != null){!!$user_p->self_introduction !!}@endif
                </textarea>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>社群連結1</label>
                <input type="text" class="form-control" name="social_links" pattern="https?://.+" @if($user_p != null) value="{{ $user_p->social_links }}" @endif>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>社群連結2</label>
                    <input type="text" class="form-control" name="social_links2" pattern="https?://.+" @if($user_p != null) value="{{ $user_p->social_links2 }}" @endif>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>社群連結3</label>
                <input type="text" class="form-control" name="social_links3" pattern="https?://.+" @if($user_p != null) value="{{ $user_p->social_links3 }}" @endif>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>社群連結4</label>
                    <input type="text" class="form-control" name="social_links4" pattern="https?://.+" @if($user_p != null) value="{{ $user_p->social_links4 }}" @endif>
                  </div>
            </div>
        </div>
        <!-- input states -->
        

        <div class="row">
          
          <div class="col-sm-4">
            <!-- radio -->
            <div class="form-group">
             <label>是否公開收藏</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="favorite_private" value="public" @if($user_p != null &&$user_p->favorite_articles_visibility == 'public') checked @endif>
                <label class="form-check-label">收藏公開</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="favorite_private" value="private" @if($user_p == null ||$user_p->favorite_articles_visibility == 'private') checked @endif>
                <label class="form-check-label">收藏不公開</label>
              </div>
              
            </div>
          </div>
          <div class="col-sm-4">
            <!-- radio -->
            <div class="form-group">
             <label>是否公開年紀</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="age_private" value="1" @if($user_p_public!= null &&$user_p_public->user_age_public == 1) checked @endif>
                <label class="form-check-label">年紀公開</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="age_private" value="0" @if($user_p_public== null||$user_p_public->user_age_public == 0) checked @endif>
                <label class="form-check-label">年紀不公開</label>
              </div>
              
            </div>
          </div>
          <div class="col-sm-4">
            <!-- radio -->
            <div class="form-group">
             <label>是否公開性別</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="sex_private" value="1" @if($user_p_public!= null&&$user_p_public->user_sex_public == 1) checked @endif>
                <label class="form-check-label">性別公開</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="sex_private" value="0" @if($user_p_public== null||$user_p_public->user_sex_public == 0) checked @endif>
                <label class="form-check-label">性別不公開</label>
              </div>
              
            </div>
          </div>
        </div>

        

      
    </div>
    <!-- /.card-body -->
    <button  type="submit" class="btn btn-block btn-primary">儲存</button>
  </form>
    <br>
  </div>
  




        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".datepicker", {
        enableTime: false, // 启用时间选择
        mode: "single", // 将模式设置为单个日期
        dateFormat: "Y-m-d", // 设置日期和时间格式
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 1) { // 检查是否选择了日期
                const selectedDate = selectedDates[0]; // 获取选择的日期
                instance.input.value = dateStr; // 将格式化后的日期和时间设置为输入框的值
            }
        }
    });
    </script>
@endsection
