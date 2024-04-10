@extends('admin.main')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Video</th>
            <th>Số tập</th>
            <th>Tên Movie</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listMovies as $listmovie)
        <tr>
            <td>{{$listmovie->t_Name}}</td>
            <td style="max-width: 100px; overflow: hidden;">{{$listmovie->T_Video}}</td>
            <td>{{$listmovie->I_Ep_Present}}</td>
            <td>{{$listmovie->I_Movie_ID}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/listMovie/edit/{{$listmovie->id}}">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a class="btn btn-danger btn-sm" href="/admin/listMovie/delete/{{$listmovie->id}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection