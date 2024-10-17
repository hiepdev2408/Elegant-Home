@extends('admin.layouts.master')

@section('title')
    Chi Tiết Bài Viết
@endsection

@section('menu-item-post')
    open
@endsection

@section('menu-sub-index-post')
    active
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Bài viết /</span>
            <span class="font-weight-bold text-primary">Chi Tiết Bài Viết</span>
        </h4>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h1 class="post-title text-center text-primary mb-4">{{ $dataID->title }}</h1>
                <p class="post-meta text-muted text-center">
                    <strong>Ngày đăng:</strong> {{ $dataID->created_at->format('d/m/Y H:i') }}
                    | <strong>Tác giả:</strong> {{ $dataID->user->name }}
                </p>

                <div class="post-image my-4 text-center">
                    <img src="{{ asset('storage/' . $dataID->img_path) }}" alt="{{ $dataID->title }}" class="img-fluid rounded shadow">
                </div>

                <div class="post-content mt-4">
                    <p class="text-justify">{!! $dataID->content !!}</p>
                </div>

                <div class="text-center my-4">
                    <hr>
                    <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-lg">Quay lại danh sách bài viết</a>
                </div>
            </div>
        </div>
    </div>
@endsection
