@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách thuộc tính</h5>
            <a href="{{ route('attributes.create') }}" class="btn btn-info">Thêm thuộc tính</a>
            <a href="{{ route('attributes.delete') }}" class="btn btn-dark">Thùng rác</a>
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
                                <div class="d-flex justify-content-center">

                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"
                                        class="btn btn-warning btn-sm me-1" href="{{ route('attributes.edit', $value->id) }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form id="delete-form-{{ $value->id }}" action="{{ route('attributes.destroy', $value->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"
                                            class="btn btn-danger btn-sm me-1"
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
@endsection
    @section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Hành động này sẽ chuyển mục vào thùng rác!",
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
