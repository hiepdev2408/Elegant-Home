@extends('admin.layouts.master')
@section('title')
    Thêm danh mục
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Thêm Danh Mục Mới</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            <!-- Tên danh mục -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nhập tên danh mục" required>
                            </div>

                            <!-- Danh mục cha -->
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Danh mục cha</label>
                                <select name="parent_id" id="parent_id" class="form-select">
                                    <option value="">Chọn danh mục cha (nếu có)</option>
                                    @foreach ($data as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Trạng thái kích hoạt -->
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                                <label class="form-check-label">Kích hoạt danh mục</label>
                            </div>

                            <!-- Nút submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Tạo danh mục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
