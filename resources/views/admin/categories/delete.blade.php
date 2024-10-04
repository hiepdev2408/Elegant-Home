@extends('admin.layouts.master')
@section('title')
    Danh sách thùng rác
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Danh Sách Thùng Rácc</h3>
                        <a href="{{ route('categories.index') }}" class="btn btn-dark float-end">Quay lại</a>
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-end">Thêm danh mục mới</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($data->isEmpty())
                            <div class="alert alert-warning">
                                Không có danh mục nào.
                            </div>
                        @else
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên danh mục</th>
                                        <th>Danh mục cha</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                {{ $category->parent ? $category->parent->name : 'Không có' }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $category->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                                                </span>
                                            </td>
                                            <td>


                                                <form action="{{ route('categories.restore', $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf

                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục này không?')">Khôi Phục</button>
                                                </form>
                                                <form action="{{ route('categories.forceDelete', $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa Vĩnh Viễn</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Danh sách danh mục con nếu có -->
                                        @if ($category->children)
                                            @foreach ($category->children as $child)
                                                <tr>
                                                    <td>—</td>
                                                    <td>{{ $child->name }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $child->is_active ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $child->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('categories.restore', $child->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf

                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục này không?')">Khôi Phục</button>
                                                        </form>
                                                        <form action="{{ route('categories.forceDelete', $child->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa Vĩnh Viễn</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
