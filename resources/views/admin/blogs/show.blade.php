@extends('admin.layouts.master')
@section('title')
    Chi tiết bài viết
@endsection
@section('content')
    <div class="container mt-5">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Bài viết /</span><span> Chi tiết bài viết</span>
        </h4>
        <h1>{{ $dataID->title }}</h1>
        <p class="text-muted">
        <h5>Đăng vào: {{ $dataID->created_at->format('d/m/Y H:i') }} - Tác giả: {{ $dataID->user->name }}</h5>
        </p>
        <img src="{{ asset('storage/' . $dataID->img_path) }}" alt="">
        <div class="content mt-3">

            <p> {!! $dataID->content !!}</p>
        </div>
        <hr>
        <a href="{{ route('blogs.index') }}" class="btn btn-primary">Trở về danh sách bài viết</a>
    </div>
@endsection
