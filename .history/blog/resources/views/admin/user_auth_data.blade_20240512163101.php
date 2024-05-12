@extends('admin.layout.layout')

@section('main_content')
<!-- general form elements disabled -->
<div class="card card-warning">
    
    <!-- /.card-header -->
    <div class="card-body">
      <form>
        <div class="row">
            <div class="col-sm-6"><label>用戶頭貼</label>
                <div class="form-group">
                  
                  <img src="{{asset('image/head.png')}}" alt="User Image" class="img-circle" style="width: 150px; height: 150px;">
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <br>
                        <button type="button" class="btn btn-block btn-outline-primary">Primary</button>
                      
                    
                        <button type="button" class="btn btn-block btn-outline-secondary">Secondary</button>
                      
                  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label>用戶名</label>
                  <input type="text" class="form-control" placeholder="" disabled>
                </div>
            </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>電子郵件</label>
              <input type="text" class="form-control" placeholder="" disabled>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label>電話</label>
                  <input type="text" class="form-control" placeholder="" disabled>
                </div>
              </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>身分組</label>
                <input type="text" class="form-control" placeholder="" disabled>
              </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm">
              <div class="form-group">
                <label>密碼</label>
                <input type="password" class="form-control" placeholder="" disabled>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Text Disabled</label>
                <input type="text" class="form-control" placeholder="Enter ..." disabled>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <!-- textarea -->
            <div class="form-group">
              <label>自我介紹</label>
              <textarea class="form-control" rows="3" placeholder=""></textarea>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>社群連結1</label>
                <input type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>社群連結2</label>
                    <input type="text" class="form-control" placeholder="Enter ...">
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>社群連結3</label>
                <input type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>社群連結4</label>
                    <input type="text" class="form-control" placeholder="Enter ...">
                  </div>
            </div>
        </div>
        <!-- input states -->
        

        <div class="row">
          
          <div class="col-sm-6">
            <!-- radio -->
            <div class="form-group">
             <label>是否公開收藏</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="radio1">
                <label class="form-check-label">收藏公開</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="radio1" checked>
                <label class="form-check-label">收藏不公開</label>
              </div>
              
            </div>
          </div>
        </div>

        

      </form>
    </div>
    <!-- /.card-body -->
  </div>



<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-danger">55%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar bg-warning" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-warning">70%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-primary">30%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar bg-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-success">90%</span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
@endsection