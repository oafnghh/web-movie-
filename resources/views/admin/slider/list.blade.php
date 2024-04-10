@extends('admin.main')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Ảnh</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sliders as $slider)
        <tr>
            <td>{{$slider->T_Name}}</td>
            <td>{{$slider->T_Description}}</td>
            <td><img style="width: 50px;" src="{{$slider->F_Thumb}}"></td>
            <td>{{$slider->I_Active}}</td>
            <td>
                <a class=" btn btn-primary btn-sm" href="/admin/slider/edit/{{$slider->id}}">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a class="btn btn-danger btn-sm" href="/admin/slider/delete/{{$slider->id}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection