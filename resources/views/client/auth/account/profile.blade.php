@extends('client.layouts.master')
@section('title')
    Thông tin tài khoản
@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <aside class="sidebar col-4">
                <ul class="menu-list">
                    <li class="menu-item active">
                        <i class="fas fa-home"></i> Trang chủ
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-history"></i> Lịch sử mua hàng
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-shield-alt"></i> Tra cứu bảo hành
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-gift"></i> Ưu đãi của bạn
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-graduation-cap"></i> Chương trình S-Student
                        <span class="badge hot">HOT</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-medal"></i> Hạng thành viên
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-user-circle"></i> Tài khoản của bạn
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-link"></i> Liên kết tài khoản
                        <span class="badge new">MỚI</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-headset"></i> Hỗ trợ
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-comment-dots"></i> Góp ý - Phản hồi
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-sign-out-alt"></i> Thoát tài khoản
                    </li>
                </ul>
            </aside>
            <section class="col-8">
                <!-- Nội dung chính -->
            </section>
        </div>
    </div>
@endsection
@section('style')
    <style>
        /* Reset styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar styles */
        .sidebar {
            width: 280px;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            height: auto; /* Để chiều cao tự động */
            padding: 10px 0;
            position: sticky;
            top: 20px; /* Khoảng cách từ đỉnh màn hình */
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 15px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .menu-item i {
            font-size: 18px;
            margin-right: 12px;
            color: #666;
        }

        .menu-item:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .menu-item.active {
            background-color: #fff5f5;
            color: #dc3545;
            font-weight: bold;
            border-left: 4px solid #dc3545;
        }

        .menu-item.active i {
            color: #dc3545;
        }

        .badge {
            margin-left: auto;
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            color: #fff;
        }

        .badge.hot {
            background-color: #dc3545;
        }

        .badge.new {
            background-color: #28a745;
        }

        /* Nội dung chính */
        .container {
            display: flex;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll(".menu-item");

            menuItems.forEach((item) => {
                item.addEventListener("click", () => {
                    const currentActive = document.querySelector(".menu-item.active");

                    // Xóa trạng thái active trước đó
                    if (currentActive) {
                        currentActive.classList.remove("active");
                    }

                    // Thêm trạng thái active vào mục mới được chọn
                    item.classList.add("active");
                });
            });
        });
    </script>
@endsection
