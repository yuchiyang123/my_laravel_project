@extends('admin.layout.layout')

@section('main_content')
<form action="{{ route('user_auth_data_submit', $user->id) }}" method="post" enctype="multipart/form-data">
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
                      <label>聯絡方式</label>
                      <input type="text" class="form-control" placeholder="{{ $shop_apply->phone_number }}" disabled>
                    </div>
                </div>
            </div>

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
        </div>
    </div>

</form>
@endsection