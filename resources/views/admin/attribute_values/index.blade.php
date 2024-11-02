@extends('admin.layouts.master')

@section('title')
    Danh sách giá trị thuộc tính
@endsection

@section('menu-item-attribute')
    open
@endsection

@section('menu-sub-create-attribute')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Thuộc Tính /</span> Danh sách giá trị thuộc tính
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Danh sách giá trị thuộc tính</h5>
            </div>
            <div class="card-header d-flex justify-content-end align-items-center mb-3">
                <a class="btn btn-primary me-2" href="{{ route('attribute_values.create') }}">
                    <i class="mdi mdi-plus me-0 me-sm-1"></i>
                    Thêm mới giá thuộc tính</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
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
                                        <a href="{{ route('attribute_values.edit', $attributeValue->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $attributeValue->id }}" action="{{ route('attribute_values.destroy', $attributeValue->id) }}" method="post">
                                            @csrf
                                            @method("delete")
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

@section('script-libs')
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
@endsection