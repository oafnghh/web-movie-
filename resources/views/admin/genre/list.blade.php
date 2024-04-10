@extends('admin.main')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên Thể Loại</th>
        </tr>
    </thead>
    <tbody>
        @foreach($genres as $genre)
        <tr>
            <td>{{$genre->T_Name}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/genre/edit/{{$genre->id}}">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a class="btn btn-danger btn-sm" href="/admin/genre/delete/{{$genre->id}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection