@extends('admin.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách bài viết</h5>
            <a href="{{ route('blogs.create') }}" class="btn btn-info">Thêm bài viết</a>
            <a href="{{ route('blogs.delete') }}" class="btn btn-dark">Thùng rác</a>
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

                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"
                                        class="btn btn-warning btn-sm me-1" href="{{ route('blogs.edit', $value) }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('blogs.destroy', $value) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Delete" class="btn btn-danger btn-sm me-1"
                                            onclick="return confirm('Bạn có muốn chuyển vào thùng rác?')">
                                            <i class="mdi mdi-delete-circle"></i>
                                        </button>
                                    </form>
                                </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
