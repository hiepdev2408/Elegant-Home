@extends('admin.layouts.master')

@section('style-libs')


@endsection
@section('title')
Danh sách Loại Tin
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">Sửa Thông Tin Người Dùng</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="userForm" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

       

        <div class="form-group">
            <label for="phone">Điện Thoại:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="form-group">
            <label for="address">Địa Chỉ:</label>
            <textarea class="form-control" id="address" name="address">{{ old('address', $user->address) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="avatar">Ảnh Đại Diện:</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mt-2" style="max-width: 100px;">
            @endif
        </div>

        <button type="button" class="btn btn-primary" id="updateButton">Cập Nhật Người Dùng</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay Lại Danh Sách</a>
    </form>
</div>

<script>
    document.getElementById('updateButton').addEventListener('click', function() {
        document.getElementById('userForm').submit();
    });
</script>
@endsection     
@section('script-libs')


@endsection

