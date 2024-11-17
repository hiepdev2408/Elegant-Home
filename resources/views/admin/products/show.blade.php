@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h2>Thông tin sản phẩm</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- Thông tin sản phẩm -->
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" id="productName" name="name" class="form-control" value="{{ $product->name }}"
                        disabled>
                </div>

                <div class="form-group">
                    <label for="productSlug">Slug:</label>
                    <input type="text" id="productSlug" name="slug" class="form-control" value="{{ $product->slug }}"
                        disabled>
                </div>

                <div class="form-group">
                    <label for="base_price">Giá sản phẩm:</label>
                    <input type="number" name="base_price" class="form-control" value="{{ $product->base_price }}"
                        step="0.01" disabled>
                </div>

                <div class="form-group">
                    <label for="img_thumbnail">Ảnh thumbnail hiện tại:</label><br>
                    <img src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="Thumbnail" width="100">

                </div>

                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea name="description" id="description" class="form-control" rows="4" disabled> {{ $product->description }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                @if ($product->galleries && $product->galleries->count() > 0)
                    <!-- Gallery của sản phẩm -->
                    <h4>Gallery</h4>
                    <div class="row" id="gallery-container">
                        @foreach ($product->galleries as $index => $gallery)
                            <div class="col-md-4 mb-3" id="gallery_{{ $index }}">
                                <img src="{{ asset('storage/' . $gallery->img_path) }}" alt="Gallery Image" width="100">

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Biến thể sản phẩm -->
        @if ($product->variants && $product->variants->count() > 0)
            <h4 class="mt-5">Biến Thể Sản Phẩm</h4>
            <div id="variants">
                @foreach ($product->variants as $variantIndex => $variant)
                    <div class="variant mb-4" id="variant_{{ $variantIndex }}">
                        <h5>Biến Thể {{ $variantIndex + 1 }}</h5>

                        <div class="form-group">
                            <label for="variant_sku_{{ $variantIndex }}">Mã biến thể:</label>
                            <input disabled type="text" name="variants[{{ $variant->id }}][sku]" class="form-control"
                                value="{{ $variant->sku }}">
                        </div>

                        <div class="form-group">
                            <label for="variant_price_modifier_{{ $variantIndex }}">Giá điều chỉnh:</label>
                            <input disabled type="number" name="variants[{{ $variant->id }}][price_modifier]"
                                class="form-control" value="{{ $variant->price_modifier }}" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="variant_stock_{{ $variantIndex }}">Số lượng tồn kho:</label>
                            <input disabled type="number" name="variants[{{ $variant->id }}][stock]" class="form-control"
                                value="{{ $variant->stock }}">
                        </div>

                        <!-- Thuộc tính của biến thể -->
                        @foreach ($attributes as $attribute)
                            <div class="form-group">
                                <label>{{ $attribute->name }}:</label>
                                <select name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]"
                                    class="form-control" disabled>
                                    <option value="">Chọn {{ $attribute->name }}</option>
                                    @foreach ($attribute->values as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $variant->attributes->contains('id', $value->id) ? 'selected' : '' }}>
                                            {{ $value->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif


        <a class="btn btn-dark mt-3" href="{{ route('products.index') }}">Quay lại</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">Chỉnh
            sửa</a>
        <button class="btn btn-info mt-3" id="show-comments-btn">Xem bình luận</button>

        {{-- Bình luận  --}}
        <div id="comments-section" class="border border-3 p-2" style="display: none; margin-top: 20px;">
            <h2>Bình luận</h2>
            <div class="comments-area p-3">

                @if (isset($product->comments) && $product->comments->count() == 0)
                    <p>Không có bình luận nào</p>
                @else
                    @foreach ($product->comments->where('parent_id', null) as $comment)
                        <div class="mb-3 p-4 border-bottom">
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div>
                                        <h4 class="mb-1">
                                            @if ($comment->user->img_thumbnail)
                                                <img src="{{ Storage::url($comment->user->img_thumbnail) }}"
                                                    class="rounded-circle me-3" alt="User Avatar" width="50">
                                            @else
                                                <img src="{{ asset('themes/image/logo.jpg') }}" class="rounded-circle me-3"
                                                    alt="User Avatar" width="50">
                                            @endif
                                            {{ $comment->user->name }}
                                        </h4>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        <p class="mt-2">{{ $comment->comment }}</p>
                                        <!-- Nút trả lời -->
                                        @if (Auth::check())
                                            <button class="btn btn-sm btn-outline-primary reply-btn" type="button"
                                                data-id="{{ $comment->id }}">Trả
                                                lời</button>
                                        @endif

                                    </div>

                                </div>

                            </div>
                            <!-- Bình luận cấp 2 (trả lời) -->
                            @foreach ($comment->replies as $reply)
                                <div class="card-body ps-5 mt-3">
                                    <div class="d-flex mb-4">

                                        <div>
                                            <h5 class="mb-1">
                                                @if ($reply->user->img_thumbnail)
                                                    <img src="{{ Storage::url($reply->user->img_thumbnail) }}"
                                                        class="rounded-circle me-3" alt="User Avatar" width="50">
                                                @else
                                                    <img src="{{ asset('themes/image/logo.jpg') }}"
                                                        class="rounded-circle me-3" alt="User Avatar" width="50">
                                                @endif
                                                {{ $reply->user->name }}
                                            </h5>
                                            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                            <p class="mt-2">{{ $reply->comment }}</p>
                                            @if (Auth::check())
                                                <button class="btn btn-sm btn-outline-primary reply-btn" type="button"
                                                    data-id="{{ $comment->id }}">Trả
                                                    lời</button>
                                            @else
                                                <hr width="1200px">
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                            <!-- Khu vực nhập bình luận trả lời -->
                            <div class="card-body ps-5 d-none reply-form" id="reply-form-{{ $comment->id }}">
                                <form action="{{ route('comments', $comment->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="mb-2">
                                        <textarea class="form-control" name="comment" rows="3" placeholder="Nhập câu trả lời..."></textarea>
                                    </div>
                                    <button class="btn btn-primary btn-sm">Gửi</button>
                                    <button type="button" class="btn btn-secondary btn-sm cancel-btn">Hủy</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>


    </div>
@endsection
@section('script-libs')
    <script>
        // Hiển thị hoặc ẩn phần bình luận khi nhấn nút
        document.getElementById('show-comments-btn').addEventListener('click', function() {
            const commentsSection = document.getElementById('comments-section');
            if (commentsSection.style.display === 'none') {
                commentsSection.style.display = 'block';
            } else {
                commentsSection.style.display = 'none';
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các nút trả lời
            const replyButtons = document.querySelectorAll(".reply-btn");

            // Lặp qua từng nút và thêm sự kiện click
            replyButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Lấy ID của comment
                    const commentId = this.getAttribute("data-id");
                    // Tìm form trả lời tương ứng với comment
                    const replyForm = document.getElementById(`reply-form-${commentId}`);
                    // Toggle lớp d-none để hiện/ẩn form trả lời
                    replyForm.classList.toggle("d-none");
                });
            });

            // Hủy form trả lời khi nhấn nút Hủy
            const cancelButtons = document.querySelectorAll(".cancel-btn");
            cancelButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const replyForm = this.closest(".reply-form");
                    replyForm.classList.add("d-none");
                });
            });
        });
    </script>
@endsection
