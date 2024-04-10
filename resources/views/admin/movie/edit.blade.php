@extends('admin.main')
@section('content')
<form class="table table-bordered" action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        @foreach($Movies as $Movie)
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="{{$Movie->T_Name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Description</label>
            <input id="editor" type="text" name="Description" value="{{$Movie->T_Description}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Thời gian phát hành</label>
            <input type="text" name="ReleaseDate" value="{{$Movie->D_ReleaseDate}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Thời lượng</label>
            <input type="text" name="Time" value="{{$Movie->I_Duration}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Ngôn Ngữ</label>
            <input type="text" name="language" value="{{$Movie->T_Language}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Đạo diễn</label>
            <input type="text" name="Directer" value="{{$Movie->T_Directer}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Số Tập</label>
            <input type="number" name="Ep" value="{{$Movie->I_Ep}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Poster</label>
            <input type="file" class="form-control" id="uploads">
            <div id="image-show">
                <a href="{{$Movie->T_Thumb}}" target="_blank">
                    <img src="{{$Movie->T_Thumb}}" width="100px">
                </a>
            </div>
            <input type="hidden" name="thumb" id="thumb" value="{{$Movie->T_Thumb}}">
        </div>
        <div class="form-group">
            <label for="menu">Thể Loại</label>
            <select name="genresID" class="genresID">
                @foreach($ID_Genres as $Genre)
                <option value="{{ $Genre->id }}" {{ $Movie->I_Genres_ID == $Genre->id ? 'selected' : '' }}>{{$Genre->T_Name}}</option>
                @endforeach
            </select>
        </div>
        @endforeach
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    @csrf
</form>
@endsection