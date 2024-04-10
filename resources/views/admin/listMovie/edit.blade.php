@extends('admin.main')
@section('content')
<form class="table table-bordered dropzone" action="" id="video-upload" method="POST" enctype="multipart/form-data">
@csrf
    <div class="card-body">
        @foreach($lists as $list)
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="{{$list->t_Name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="menu">Tên Movie</label>
            <select name="I_Movie_ID" class="I_Movie_ID">
                @foreach($ListNames as $ListName)
                <option value="{{$ListName->id}}" {{$list->I_Movie_ID == $ListName->id ? 'selected' : '' }}>{{$ListName->T_Name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu">Số tập hiện tại</label>
            <input type="text" name="I_Ep_Present" value="{{$list->I_Ep_Present}}" class="form-control">
        </div>
        <div class="form-group">
            <input name="thumb" id="video-upload" value="{{$list->T_Video}}" placeholder="Tên video" readonly>
        </div>
     @endforeach
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo Tập</button>
    </div>
</form>
@endsection