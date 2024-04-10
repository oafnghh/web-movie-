@extends('admin.main')
@section('content')
<form class="table table-bordered" action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
    @foreach($genres as $genre)
        <div class="form-group">
            <label for="menu">Tên</label>
            <input type="text" name="name" value="{{$genre->T_Name}}" class="form-control">
        </div>
        @endforeach
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa</button>
    </div>
    @csrf
</form>
@endsection