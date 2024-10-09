@extends('admin.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách thuộc tính đã xóa</h5>
            <a href="{{ route('attributes.index') }}" class="btn btn-primary">Quay lại</a>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="border-top table-light">
                    <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Thuộc tính</th>
                        <th>Ngày Đăng</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->category->name }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('attributes.restore', $value->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục thuộc tính này không?')">Khôi Phục</button>
                            </form>
                            <form action="{{ route('attributes.forceDelete', $value->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn không?')">Xóa Vĩnh Viễn</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
