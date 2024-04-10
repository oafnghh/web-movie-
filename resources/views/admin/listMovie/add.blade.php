@extends('admin.main')
@section('content')
<form class="table table-bordered dropzone" action="" id="video-upload" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Tên Movie</label>
            <select name="I_Movie_ID" class="I_Movie_ID">
                @foreach($ListNames as $ListName)
                <option value="{{$ListName->id}}">{{$ListName->T_Name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu">Số tập hiện tại</label>
            <input type="text" name="I_Ep_Present" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Link phim</label>
            <input type="text" name="link" value="" class="form-control">
        </div>
        <div class="form-group">
            <input name="thumb" id="video-upload" placeholder="Tên video" readonly>
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo Tập</button>
    </div>
</form>
@endsection