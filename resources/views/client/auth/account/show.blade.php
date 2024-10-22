@extends('client.auth.account.partials.master')
@section('content-account')
    <div class="mt-3  text-center">
        <img src="{{ asset('themes/image/logo.jpg') }}" width="100px" height="100px" style="border-radius: 50px" alt="">
        <p>{{ Auth::user()->name }}</p>
    </div>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="gender">Giới tính:</label>
                <input type="text" class="form-control" name="gender" value="Chưa cập nhật" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" readonly>
            </div>
            <div class="form-group">
                <label for="birthday">Sinh nhật:</label>
                <input type="text" class="form-control" name="birthday" value="" placeholder="Chưa cập nhật">
            </div>
            <div class="form-group">
                <label for="join_date">Ngày tham gia Smember:</label>
                <input type="text" class="form-control" name="created_at" value="{{ Auth::user()->created_at->format('d/m/Y') }}" readonly>
            </div>
            <div class="form-group">
                <label for="total_accumulated">Tổng tiền tích lũy từ 01/01/2023:</label>
                <input type="text" class="form-control" name="total_accumulated" value="0đ" readonly>
            </div>
            <div class="form-group">
                <label for="total_spent">Tổng tiền đã mua sắm:</label>
                <input type="text" class="form-control" name="total_spent" value="0đ" readonly>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" name="address" value="Chưa có địa chỉ mặc định" readonly>
            </div>
            <div class="form-group">
                <label for="password">Đổi mật khẩu:</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
            </div>
            <button type="submit" class="btn-update">Cập nhật thông tin</button>
        </form>
    </div>
@endsection
@section('style')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
        }

        .profile-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .form-group {
            margin: 15px 0;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #555;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 15px;
            background-color: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            color: #333;
        }

        .form-control[readonly] {
            background-color: #f1f3f5;
            border: 1px solid #eaeaea;
            color: #888;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-update {
            width: 100%;
            padding: 12px;
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-update:hover {
            background-color: #0056b3;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            .profile-header h2 {
                font-size: 20px;
            }

            .btn-update {
                font-size: 14px;
            }
        }
    </style>
@endsection
