@extends('admin.layouts.master')

@section('title')
    Giá trị thuộc tính
@endsection

@section('menu-item-attribute', 'open')
@section('menu-sub-attribute-value', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Thuộc Tính /</span> Danh sách giá trị thuộc tính
        </h4>

        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <a class="btn btn-primary me-2" href="{{ route('attribute_values.create') }}">
                <i class="mdi mdi-plus me-0 me-sm-1"></i>
                Thêm giá trị thuộc tính</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên thuộc tính</th>
                            <th>Giá trị</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $attributeValue)
                            <tr>
                                <td>{{ $attributeValue->id }}</td>
                                <td>{{ $attributeValue->attribute->name }}</td>
                                <td>{{ $attributeValue->value }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('attribute_values.edit', $attributeValue->id) }}"
                                            class="btn btn-warning btn-sm me-1">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $attributeValue->id }}"
                                            action="{{ route('attribute_values.destroy', $attributeValue->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Delete" class="btn btn-danger btn-sm me-1"
                                                onclick="confirmDelete({{ $attributeValue->id }})">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Điều này không thể khôi phục!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
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
