@extends('admin.layout.layout')

@section('main_content')
@if(Session::has('success'))
    <div class="alert alert alert-primary">
        {{ Session::get('success') }}
    </div>
    @endif

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">揪團</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>文章id</th>
                <th>發文者</th>
                <th>標題</th>
                <th>發文日期</th>
                <th>狀態</th>
                <th>功能</th>
              </tr>
            </thead>
            @foreach ($mjoins as $mjoin)
            <tbody>
              <tr>
                <td><span>{{ $mjoin->id }}</span></td>
                <td><span>{{ $mjoin->posted_by_u }}</span></td>
                <td><span>{{ $mjoin->title }}</span></td>
                <td><span>{{ $mjoin->created_at }}</span></td>
                <td>
                    <span>
                    @if($mjoin->status=='end')
                        結束揪團
                    @elseif($mjoin->status=='pending')
                        正在招募
                    @else 
                        已刪除
                    @endif
                    </span>
                </td>
                <td>
                  <a href="/user_mjoin_solo_{{ $mjoin->id }}"><button class="btn btn-primary btn-sm">詳細</button></a>
                  <a href="/user_cms_mjoin_edit_{{ $mjoin->id }}"><button class="btn btn-secondary btn-sm">編輯</button></a>
                  @if($mjoin->status!='del')
                    <button class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-secondary{{ $mjoin->id }}">刪除</button>
                  @else
                    <a href="/user_mjoin_delete_back_{{ $mjoin->id }}"><button class="btn btn-secondary btn-sm">重新貼文</button></a>
                  @endif
                </td>
              </tr>
              @if($mjoin->status!='del')
              <div class="modal fade" id="modal-secondary{{ $mjoin->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-secondary">
                    <div class="modal-header">
                      <h4 class="modal-title">揪團貼文刪除</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="/user_mjoin_delete_{{ $mjoin->id }}" method="POST">
                      @csrf
                    <div class="modal-body">
                      <textarea class="form-control" rows="3" placeholder="請輸入被刪除的原因..." required name="msg"></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-outline-light">確認刪除</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            @endif
              
            </tbody>
            
            @endforeach
            
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <!--打工-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">打工</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>文章id</th>
                <th>發文者</th>
                <th>店家名稱</th>
                <th>發文日期</th>
                <th>狀態</th>
                <th>功能</th>
              </tr>
            </thead>
            <tbody>
                @if(!$shops->isEmpty())
                    @foreach($shops as $shop)    
                    <tr>
                        <td><span>{{ $shop->id }}</span></td>
                        <td><span>{{ $shop->posted_by_u }}</span></td>
                        <td><span>{{ $shop->shop_name }}</span></td>
                        <td><span>{{ $shop->created_at }}</span></td>
                        <td>
                            <span>
                            @if($shop->status=='end')
                                結束揪團
                            @elseif($shop->status=='pending')
                                正在招募
                            @else 
                                已刪除
                            @endif
                            </span>
                        </td>
                        <td>
                          <a href="/user_shop_solo_{{ $shop->id }}"><button class="btn btn-primary btn-sm">詳細</button></a>
                          <a href="/user_cms_shop_edit_{{ $shop->id }}"><button class="btn btn-secondary btn-sm">編輯</button></a>
                          @if($shop->status!='del')
                            <button class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-secondary_shop{{ $shop->id }}">刪除</button>
                          @else
                            <a href="/user_mjoin_shop_back_{{ $shop->id }}"><button class="btn btn-secondary btn-sm">重新貼文</button></a>
                          @endif
                        </td>
                      </tr>
                      @if($mjoin->status!='del')
                      <div class="modal fade" id="modal-secondary_shop{{ $shop->id }}">
                        <div class="modal-dialog">
                          <div class="modal-content bg-secondary">
                            <div class="modal-header">
                              <h4 class="modal-title">揪團貼文刪除</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="/user_shop_delete_{{ $shop->id }}" method="POST">
                              @csrf
                            <div class="modal-body">
                              <textarea class="form-control" rows="3" placeholder="請輸入被刪除的原因..." required name="msg"></textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-outline-light">確認刪除</button>
                            </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    @endif
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center;">目前無人發文</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!--打工結束-->
  <!--創作-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Fixed Header Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>文章id</th>
                <th>創作者</th>
                <th>標題</th>
                <th>發文日期</th>
                <th>狀態</th>
                <th>功能</th>
              </tr>
            </thead>
            <tbody>
                @if(!$artworks->isEmpty())
                    @foreach($artworks as $artwork)    
                    <tr>
                        <td><span>{{ $artwork->id }}</span></td>
                        <td><span>{{ $artwork->username }}</span></td>
                        <td><span>{{ $artwork->title }}</span></td>
                        <td><span>{{ $artwork->created_at }}</span></td>
                        <td>
                            <span>
                                @if($artwork->status=='pending')
                                    已發文
                                @else 
                                    已刪除
                                @endif
                            </span>
                        </td>
                        <td><a href="#"><button class="btn btn-primary btn-sm">詳細</button></a></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center;">目前無人發文</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <!--創作結束-->

@endsection