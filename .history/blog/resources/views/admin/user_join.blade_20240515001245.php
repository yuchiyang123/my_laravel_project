@extends('admin.layout.layout')

@section('main_content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">揪團</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          揪團標題
                      </th>
                      <th style="width: 30%">
                          團隊成員
                      </th>
                      <th>
                          主揪
                      </th>
                      <th style="width: 8%" class="text-center">
                          狀態
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @if(!$mjoins->isEmpty())
                    @foreach($mjoins as $mjoin)
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
                                {{ $mjoin->title }}
                            </a>
                            <br/>
                            <small>
                                {{ $mjoin->created_at }}
                            </small>
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}" target="_new"><img alt="Avatar" class="table-avatar" src="{{ $mjoin->profile_image_url }}"></a>
                                </li>
                                @foreach($joiners as $joinerCollection)
                                    @foreach($joinerCollection as $joiner)
                                        @if($joiner->article_id == $mjoin->id)
                                            @php
                                                $user = App\Models\User::where('id', $joiner->user_id)->first();
                                            @endphp
                                            <li class="list-inline-item">
                                                <a href="/user-profile/index/d/{{ $user->username }}" target="_new"><img alt="Avatar" class="table-avatar" src="{{ $joiner->profile_image_url }}"></a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach

                            </ul>
                        </td>
                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div>
                            <small>
                                57% Complete
                            </small>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-success">
                                @if($mjoin->status=='end')
                                    結束揪團
                                @elseif($mjoin->status=='pending')
                                    正在招募
                                @else 
                                    已刪除
                                @endif
                            </span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="/user_cms_mjoin_edit_{{ $mjoin->id }}">
                                <i class="fas fa-folder">
                                </i>
                                查看
                            </a>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                編輯
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                強制停止
                            </a>
                        </td> 
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

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">打工</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        打工店名
                    </th>
                    <th style="width: 30%">
                        團隊成員
                    </th>
                    <th>
                        店長
                    </th>
                    <th style="width: 8%" class="text-center">
                        狀態
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
              @if(!$shops->isEmpty())
                  @foreach($shops as $shop)
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                              {{ $shop->shop_name }}
                          </a>
                          <br/>
                          <small>
                              {{ $shop->created_at }}
                          </small>
                      </td>
                      <td>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <a href="/user-profile/index/d/{{ $shop->posted_by_u }}"><img alt="Avatar" class="table-avatar" src="{{ $shop->profile_image_url }}">
                              </li>
                              @foreach($shop_joiners as $joinerCollection)
                                  @foreach($joinerCollection as $joiner)
                                      @if($joiner->article_id == $mjoin->id)
                                          <li class="list-inline-item">
                                            @php
                                                $user_shop = \App\Models\User::where('id',$joiner->id)->first();
                                            @endphp
                                            <a href="/user-profile/index/d/{{ $user_shop->username }}"><img alt="Avatar" class="table-avatar" src="{{ $joiner->profile_image_url }}"></a>
                                          </li>
                                      @endif
                                  @endforeach
                              @endforeach

                          </ul>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                              </div>
                          </div>
                          <small>
                              57% Complete
                          </small>
                      </td>
                      <td class="project-state">
                          <span class="badge badge-success">
                              @if($shop->status=='end')
                                  結束揪團
                              @elseif($shop->status=='pending')
                                  正在招募
                              @else 
                                  已刪除
                              @endif
                          </span>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              查看
                          </a>
                          <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              編輯
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              強制停止
                          </a>
                      </td> 
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

  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->
@endsection