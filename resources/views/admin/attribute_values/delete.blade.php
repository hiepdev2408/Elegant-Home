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
                        @foreach ($attributeValues as $attributeValue)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>{{ $value->attribute->name }}</td>
                                <td>{{ $value->value }}</td>
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
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(id) {
            if (confirm('Bạn có chắc chắn muốn xóa giá trị thuộc tính này?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection