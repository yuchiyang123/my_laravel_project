@extends('admin.layout.layout')

@section('main_content')

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
                        <div><img src="{{ $profile_image_url }}" alt="" style="width: 500px; height: 500px;"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>身分證</label>
                      <div><img src="{{ $profile_image_url1 }}" alt="" style="width: 500px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <form action="" method="POST" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-primary">通過</button>
                    </form>
                    </div>
                </div>
        
                <div class="col-sm-6">
                    <div class="form-group">
                        <button class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-secondary">拒絕</button>
                    </div>
                </div>
            </div>
        
        <div class="modal fade" id="modal-secondary">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">拒絕申請</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST">
                  @csrf
                <div class="modal-body">
                  <textarea class="form-control" rows="3" placeholder="請輸入被拒絕申請..." required name="msg"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-light">確認拒絕申請</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    
@endsection