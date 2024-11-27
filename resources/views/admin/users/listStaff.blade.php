@extends('admin.layouts.master')
@section('title')
    Nhân viên
@endsection
@section('menu-item-account')
    open
@endsection

@section('menu-sub-staff')
    active
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Tài Khoản /</span> Nhân Viên
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <a class="btn btn-primary me-2" href="{{ route('attributes.create') }}">
                <i class="mdi mdi-plus me-0 me-sm-1"></i>
                Thêm mới tài khoản</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead class="border-top table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên tài khoản</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->address }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->created_at ? $value->created_at->format('d/m/Y') : '' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"
                                            class="btn btn-warning btn-sm me-1"
                                            href="{{ route('attributes.edit', $value->id) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $value->id }}"
                                            action="{{ route('attributes.destroy', $value->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Delete" class="btn btn-danger btn-sm me-1"
                                                onclick="confirmDelete({{ $value->id }})">
                                                <i class="mdi mdi-delete-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <style>
        .swal2-container {
            z-index: 9999 !important;
        }
    </style>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Hành động này sẽ xóa vĩnh viễn thuộc tính!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
