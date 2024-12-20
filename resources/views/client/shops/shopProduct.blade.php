@extends('client.layouts.master')
@section('title')
    Products
@endsection
@section('content')
    <section class="page-title">
        <div class="auto-container">
            <h2>Shop Page</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Shops</li>
            </ul>
        </div>
    </section>
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div id="product-results" class="shops-outer">
                        @include('client.shops.partials.productfilter')
                    </div>
                </div>
                @include('client.shops.partials.sideBarfilter', ['categories' => $categories])
            </div>
        </div>
    </div>
@endsection
@section('script-libs')
    <script>
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            if (replyForm.style.display === "none") {
                replyForm.style.display = "block";
            } else {
                replyForm.style.display = "none";
            }
        }
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="{{ asset('themes/client/assets/js/plugins/swiper-bundle.min.js') }}" defer="defer"></script>
     <script src="{{ asset('themes/client/assets/js/plugins/glightbox.min.js') }}" defer="defer"></script>
 
     <!-- Customscript js -->
     <script src="{{ asset('themes/client/assets/js/script.js') }}" defer="defer"></script>
  
     <script>
        $(document).ready(function() {
            // Xử lý tìm kiếm
            $('#search-form').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn hành động gửi form mặc định
        
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#product-results').html(response); // Cập nhật danh sách sản phẩm
                        console.log("Search results updated."); // Log khi cập nhật
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                });
            });
        
            // Xử lý nhấp vào danh mục
            $('.category-link').on('click', function(e) {
                e.preventDefault();
                var categoryId = $(this).data('id');
                console.log('Category ID:', categoryId);

                $.ajax({
                    url: '{{ route("shop.categoryProduct", ":category_id") }}'.replace(':category_id', categoryId),
                    type: 'GET',
                    success: function(response) {
                        console.log("Products updated for category:", categoryId);
                        $('#product-results').html(response);
                    },
                    error: function(xhr) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                });
            });
        
            // Xử lý lọc sản phẩm
            $('#filter-form').on('submit', function(e) {
                e.preventDefault(); 
                console.log("Filter form submitted"); // Log khi form lọc được gửi
        
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#product-results').html(response); // Cập nhật danh sách sản phẩm
                        console.log("Filter results updated."); // Log khi cập nhật
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                });
            });
        });
        </script>
   
 
    
        {{-- lọc giá --}}
    
        
    
@endsection
