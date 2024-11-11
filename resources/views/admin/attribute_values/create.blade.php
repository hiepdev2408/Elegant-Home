@extends('admin.layouts.master')

@section('title', 'Thêm giá trị thuộc tính')

@section('menu-item-attribute_value', 'open')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Thêm giá trị thuộc tính mới</h4>

        <form action="{{ route('attribute_values.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="attribute_id">Chọn thuộc tính</label>
                        <select class="form-control" name="attribute_id" id="attribute_id">
                            <option value="">Chọn thuộc tính</option>
                            @foreach ($attributes as $id => $name)
                             <option value="{{ $id }}">{{ $name }}</option>
                           @endforeach
                             </select>
                        @error('attribute_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="value">Giá trị thuộc tính</label>
                        <input type="text" class="form-control" name="value" id="value" value="{{ old('value') }}">
                        @error('value')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Thêm giá trị thuộc tính</button>
                    <a href="{{ route('attribute_values.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
@endsection
