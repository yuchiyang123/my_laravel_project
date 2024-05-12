@extends('admin.layout.layout')

@section('main_content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Striped Full Width Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>店家名稱</th>
            <th>申請時間</th>
            <th>狀態</th>
            <th>功能</th>
          </tr>
        </thead>
        <tbody>
            @foreach($shop_applys as $shop_apple)
            <tr>
                <td>{{ $shop_apple->id }}</td>
                <td>{{ $shop_apple->company_name }}</td>
                <td>
                    {{ $shop_apple->created_at }}
                </td>
                <td><span class="badge bg-danger">{{ $shop_apple->status }}</span></td>
                <td><span class="badge bg-danger">55%</span></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
</div>
@endsection