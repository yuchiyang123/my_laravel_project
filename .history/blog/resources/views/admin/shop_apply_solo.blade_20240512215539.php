@extends('admin.layout.layout')

@section('main_content')
<form action="{{ route('user_auth_data_submit', $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label>店名</label>
                    <div class="form-group">
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection