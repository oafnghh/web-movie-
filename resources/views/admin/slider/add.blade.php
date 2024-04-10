@extends('admin.main')
@section('content')
<form class="table table-bordered" action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Description</label>
            <input id="editor" type="text" name="Description" value="" class="form-control">
        </div>

        <div class="form-group">
            <label for="menu">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="uploads">
            <div id="image-show">

            </div>
            <input type="hidden" name="thumb" id="thumb">
        </div>

        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked="">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo slide</button>
    </div>
    @csrf
</form>
@endsection