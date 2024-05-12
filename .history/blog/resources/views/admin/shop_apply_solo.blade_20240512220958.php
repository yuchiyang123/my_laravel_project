@extends('admin.layout.layout')

@section('main_content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>店名</label>
                        <input type="text" class="form-control" placeholder="{{ $shop_apply->company_name }}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>聯絡方式</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->phone_number }}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>店名</label>
                        <input type="text" class="form-control" placeholder="{{ $shop_apply->uniform_numbers }}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>地址</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->company_location }}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>所在縣市</label>
                        <input type="text" class="form-control" placeholder="{{ $shop_apply->county }}" disabled>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>申請人</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->applicant }}" disabled>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>申請帳號ID</label>
                      <div class="form-group">
                      <a href="/user_auth_data_{{ $shop_apply->user_id }}"><label>{{ $shop_apply->user_id }}</label></a></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>營業執照</label>
                        <input type="text" class="form-control" placeholder="{{ $shop_apply->uniform_numbers }}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>身分證</label>
                      <div><img src="{{ $profile_image_url1 }}" alt="" style="width: 100px; height: 100px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection