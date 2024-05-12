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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>所在縣市</label>
                        <input type="text" class="form-control" placeholder="{{ $shop_apply->county }}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>申請人</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->applicant }}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>申請帳號ID</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->applicant }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection