@extends('admin.layout.layout')

@section('main_content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>

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
                                    <img alt="Avatar" class="table-avatar" src="{{ $mjoin->profile_image_url }}">
                                </li>
                                @foreach($joiners as $joinerCollection)
                                    @foreach($joinerCollection as $joiner)
                                        @if($joiner->article_id == $mjoin->id)
                                            <li class="list-inline-item">
                                                <img alt="Avatar" class="table-avatar" src="{{ $joiner->profile_image_url }}">
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach

                            </ul>
                        </td>
                        @php
                            // 將日期範圍拆分為開始日期和結束日期
                            $dates = explode(' - ', $mjoin->time);

                            // 將開始日期和結束日期轉換為 Carbon 實例
                            $start_date = \Carbon\Carbon::parse($dates[0]);
                            $end_date = \Carbon\Carbon::parse($dates[1]);
                            $current_time = \Carbon\Carbon::now();

                            // 計算距離結束時間的時間差
                            $timeDiff = $current_time->diffInSeconds($end_date);

                            // 如果時間差小於等於零，將百分比設置為100%
                            if ($timeDiff <= 0) {
                                $percentage = 100;
                            } else {
                                // 否則，計算距離結束時間的百分比
                                $totalTime = $end_date->diffInSeconds($start_date);
                                $percentage = ($totalTime - $timeDiff) / $totalTime * 100;
                                // 限制百分比在0到100之間
                                $percentage = max(0, min(100, $percentage));
                            }
                        @endphp

                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%">
                                </div>
                            </div>
                            <small>
                                {{ round($percentage) }}% Complete
                            </small>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-success">Success</span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td> 
                    </tr>
                    @endforeach
                  @else
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