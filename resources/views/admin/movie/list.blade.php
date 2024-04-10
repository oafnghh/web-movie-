@extends('admin.main')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>thời lượng</th>
            <th>Ngôn Ngữ</th>
            <th>Hình Ảnh</th>
            <th>Số Tập</th>
            <th>Thể Loại</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Movies as $movie)
        <tr>
            <td>{{$movie->T_Name}}</td>
            <td style="max-width: 100px; overflow: hidden;">{{$movie->T_Description}}</td>
            <td>{{$movie->I_Duration}}</td>
            <td>{{$movie->T_Language}}</td>
            <td><img style="width: 50px;" src="{{$movie->T_Thumb}}"></td>
            <td>{{$movie->I_Ep}}</td>
            <td>{{$movie->genre_name}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/movie/edit/{{$movie->id}}">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a class="btn btn-danger btn-sm" href="/admin/movie/delete/{{$movie->id}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <div class="pagination">
        {{ $Movies->links() }}
    </div>
</table>

@endsection