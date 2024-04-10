@extends('admin.main')
@section('content')
<form class="table table-bordered" action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="" class="form-control">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo</button>
    </div>
    @csrf
</form>
@endsection