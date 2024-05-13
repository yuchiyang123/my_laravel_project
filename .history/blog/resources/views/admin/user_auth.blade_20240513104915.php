@extends('admin.layout.layout')

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">用戶管理</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>使用者名稱</th>
              <th>電話</th>
              <th>Email</th>
              <th>身分</th>
              <th>功能</th>
              <th>狀態</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
              <td><span>{{ $user->username }}</span></td>
              <td>@if($user->phone!=null)<span>{{ $user->phone }}@else<span>還沒驗證電話</span>@endif</td>
              </td>
              <td>{{ $user->email }}</td>
              <td>@if($user->permissions=='3')<span>使用者</span>
                  @elseif($user->permissions=='2')<span>店家</span>
                  @else<span>管理員</span>@endif
              </td>
              <td>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    列表
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/user_auth_data_{{ $user->id }}">查看資料</a>
                    <a class="dropdown-item" href="/user_join_status{{ $user->id }}">參與情況</a>
                    <a class="dropdown-item" href="#">連絡他</a>
                    <div class="dropdown-divider"></div>
                    @if($user->state=='action')
                      <button class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-secondary">用戶停權</button>
                    @else
                      <a  href="/user_resume/{{ $user->id }}"><button class="dropdown-item" type="submit">用戶解除停權</button></a>
                    @endif
                </div>
              </td>
              <td>{{ $user->state }}</td>
            </tr>
            @endforeach
            @if($user->state=='action')
            <div class="modal fade" id="modal-secondary">
                <div class="modal-dialog">
                  <div class="modal-content bg-secondary">
                    <div class="modal-header">
                      <h4 class="modal-title">用戶停權</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="/user_stop/{{ $user->id }}" method="POST">
                      @csrf
                    <div class="modal-body">
                      <textarea class="form-control" rows="3" placeholder="請輸入被停權原因..." required name="msg"></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-outline-light">確認停權</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            @endif
            </tbody>
            <tfoot>
            <tr>
              <th>使用者名稱</th>
              <th>電話</th>
              <th>Email</th>
              <th>身分</th>
              <th>功能</th>
              <th>狀態</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      
      <!-- /.card -->
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
<!-- ./wrapper -->

<!-- jQuery -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

@endsection




<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>
</html>
