@extends('admin.layouts.master')
@section('title')
    Thêm mới bài viết
@endsection
@section('menu-item-post')
    open
@endsection

@section('menu-sub-create-post')
    active
@endsection
@section('content')
    <div class="container mt-5">
        <h1>Thêm bài viết</h1>
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- User ID -->
            <div class="mb-3">
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden>
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề">
            </div>
            @error('title')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            {{-- <!-- Slug -->
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter blog slug">
            </div> --}}

            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="img_path" name="img_path">
            </div>
            @error('img_path')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <!-- Content -->
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="15" placeholder="Nội dung"></textarea>
            </div>
            @error('content')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
        </form>
    </div>
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
