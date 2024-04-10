@extends('admin.main')
@section('content')
<form class="table table-bordered" action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        @foreach($sliders as $slider)
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="{{$slider->T_Name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Description</label>
            <input id="editor" type="text" name="Description" value="{{$slider->T_Description}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="menu">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="uploads">
            <div id="image-show">
                <a href="{{$slider->F_Thumb}}" target="_blank">
                    <img src="{{$slider->F_Thumb}}" width="100px">
                </a>
            </div>
            <input type="hidden" name="thumb" value="{{$slider->F_Thumb}}" id="thumb">
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
        @endforeach
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật slide</button>
    </div>
    @csrf
</form>
@endsection