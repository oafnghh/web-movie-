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
            <input id="" type="text" name="Description" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Thời gian phát hành</label>
            <input type="date" name="ReleaseDate" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Thời lượng</label>
            <input type="text" name="Time" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Ngôn Ngữ</label>
            <input type="text" name="language" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Đạo diễn</label>
            <input type="text" name="Directer" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Số Tập</label>
            <input type="number" name="Ep" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Poster</label>
            <input type="file" class="form-control" id="uploads">
            <div id="image-show">

            </div>
            <input type="hidden" name="thumb" id="thumb">
        </div>
        <div class="form-group">
            <label for="menu">Thể Loại</label>
            <select name="genresID" class="genresID">
                @foreach($ID_Genres as $Genre)
                <option value="{{$Genre->id}}">{{$Genre->T_Name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo Movie</button>
    </div>
    @csrf
</form>
@endsection