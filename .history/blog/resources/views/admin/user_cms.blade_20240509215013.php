@extends('admin.layout.layout')

@section('main_content')
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
                <td><a href="#"><button class="btn btn-primary btn-sm">詳細</button></a></td>
              </tr>
              
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
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
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