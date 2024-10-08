@extends('admin.layouts.master')
@section('content')
<div class="container mt-5">
    <h1>Cập nhật thuộc tính</h1>
    <form action="{{ route('attributes.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label for="category" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $id => $name)
                    <option @selected($attribute->category_id == $id) value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="name" class="form-label">Tên thuộc tính</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $attribute->name }}" placeholder="Tên thuộc tính">
        </div>

        <button class="btn btn-primary mt-3">Cập nhật</button>
    </form>
</div>
@endsection
