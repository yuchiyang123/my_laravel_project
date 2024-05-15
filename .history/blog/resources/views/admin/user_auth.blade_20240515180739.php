<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>旅遊媒合平台後台系統</title>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin_index" class="nav-link">首頁</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">平台後台系統</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('image/head.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
        <button class="btn btn-default btn-flat float-right" onclick="location.href='/admin_logout'">登出</button>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                分支
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="/admin_index" class="nav-link {{ Route::is('admin_index')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>首頁</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/user_auth" class="nav-link {{ Route::is('user_auth')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>使用者管理</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/user_cms" class="nav-link {{ Route::is('user_cms')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS管理</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/user_join" class="nav-link {{ Route::is('user_join','user_join_status')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>加入狀況</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/shop_apply" class="nav-link {{ Route::is('shop_apply')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>店家審核</p>
                </a>
              </li>
            </ul>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">用戶管理</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                    <div class="dropdown-divider"></div>
                    @if($user->state=='action')
                      <button class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-secondary{{ $user->id }}">用戶停權</button>
                    @else
                      <a href="/user_resume/{{ $user->id }}"><button class="dropdown-item" type="submit">用戶解除停權</button></a>
                    @endif
                </div>
              </td>
              <td>{{ $user->state }}</td>
            </tr>
            @if($user->state=='action')
            <div class="modal fade" id="modal-secondary{{ $user->id }}">
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
            @endforeach
           
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
      </div>
      <!-- /.card -->
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
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






<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "charset": 'utf-8',
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
