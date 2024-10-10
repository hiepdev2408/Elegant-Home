@extends('admin.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách bài viết đã xóa</h5>
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Quay lại</a>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="border-top table-light">
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>SLug</th>
                        <th>Người đăng</th>
                        <th>Ảnh</th>
                        <th>Ngày Đăng</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $key += 1 }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->slug }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$value->img_path) }}" alt="" width="100px">
                            </td>
                            <td>{{ $value->created_at }}</td>
                            <td>
                                <div class="d-flex justify-content-center">

                                    <form action="{{ route('blogs.restore', $value->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn khôi phục bài viết này không?')">Khôi Phục</button>
                                    </form>
                                    <form action="{{ route('blogs.forceDelete', $value->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa Vĩnh Viễn</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
