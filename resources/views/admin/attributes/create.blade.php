@extends('admin.layouts.master')
@section('content')
<div class="container mt-5">
    <h1>Thêm thuộc tính</h1>
    <form action="{{ route('attributes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label for="category" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="name" class="form-label">Tên thuộc tính</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thuộc tính">
        </div>

        <button class="btn btn-primary mt-3">Thêm mới</button>
    </form>
</div>
@endsection
