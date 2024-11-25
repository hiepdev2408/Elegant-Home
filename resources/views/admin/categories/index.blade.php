@extends('admin.layouts.master')
@section('title')
    Danh sách danh mục
@endsection
@section('menu-item-categories')
    open
@endsection

@section('menu-sub-index-categories')
    active
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Danh Mục /</span> Danh sách danh mục
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card-header d-flex justify-content-end align-items-center mb-3 gap-3">
            <a class="btn btn-primary" href="{{ route('categories.create') }}">
                <i class="mdi mdi-plus me-0 me-sm-1"></i>
                Thêm mới danh mục</a>
            <a href="{{ route('categories.delete') }}" class="btn btn-danger">Thùng rác</a>
        </div>
        <div class="card">
            <div class="card-body">
                {{-- @if ($data->isEmpty())
                    <div class="alert alert-warning">
                        Không có danh mục nào.
                    </div>
                @else --}}
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Danh mục cha</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $stt = 1; @endphp
                        @foreach ($data as $category)
                            @if (is_null($category->parent))
                                <!-- Kiểm tra xem đây có phải danh mục cha không -->
                                <tr>
                                    <td>{{ $stt++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>Không có</td>
                                    <td>
                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-primary btn-sm">Sửa</a>

                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach ($category->children as $child)
                                    <tr>
                                        <td>--</td>
                                        <td>{{ $child->name }}</td> <!-- Thêm dấu gạch ngang để phân biệt -->
                                        <td>{{ $category->name }}</td> <!-- Tên danh mục cha -->
                                        <td>
                                            <span class="badge {{ $child->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $child->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.edit', $child->id) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>

                                            <form action="{{ route('categories.destroy', $child->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục con này không?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{-- @endif --}}
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
