@extends('admin.layouts.master')
@section('title')
    Danh sách bài viết
@endsection

@section('menu-item-post')
    open
@endsection

@section('menu-sub-index-post')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Quản lý bài viết /</span> Danh sách
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-end align-items-center mb-3 gap-3">
            <a class="btn btn-primary" href="{{ route('blogs.create') }}"><i class="mdi mdi-plus me-0 me-sm-1"></i>Thêm bài
                viết</a>
            <a class="btn btn-danger" href="{{ route('blogs.delete') }}"></i>Thùng rác</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
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
                                    <img src="{{ asset('storage/' . $value->img_path) }}" alt="" width="100px">
                                </td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show"
                                            class="btn btn-info btn-sm me-1" href="{{ route('blogs.show', $value) }}">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"
                                            class="btn btn-warning btn-sm me-1" href="{{ route('blogs.edit', $value) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form action="{{ route('blogs.destroy', $value) }}" method="POST"
                                            class="d-inline">
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
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [1, 'asc']
            ]
        });
    </script>
@endsection
