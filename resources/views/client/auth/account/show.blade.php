@extends('client.auth.account.partials.master')
@section('content-account')
    <div class="container" style="font-family: 'Roboto', 'Arial', sans-serif;">
        <div class="mt-3  text-center">
            <img src="{{ asset('themes/image/logo.jpg') }}" width="100px" height="100px" style="border-radius: 50px" alt="">
            <p>Đinh Duy Hiệp</p>
        </div>
        <form action="" method="post">
            <div class="container" style="max-width: 600px; margin: auto; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <div class="text-center mb-4">
                    <h2>Thông tin tài khoản</h2>
                </div>
                <div class="form-group mb-3">
                    <label for="name">Họ và tên:</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="gender">Giới tính:</label>
                    <input type="text" class="form-control" name="gender" value="Chưa cập nhật" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="birthday">Sinh nhật:</label>
                    <input type="text" class="form-control" name="birthday" value="" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="join_date">Ngày tham gia Smember:</label>
                    <input type="text" class="form-control" name="join_date" value="{{ Auth::user()->created_at->format('d/m/Y') }}" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="total_accumulated">Tổng tiền tích lũy từ 01/01/2023:</label>
                    <input type="text" class="form-control" name="total_accumulated" value="0đ" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="total_spent">Tổng tiền đã mua sắm:</label>
                    <input type="text" class="form-control" name="total_spent" value="0đ" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-3">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" name="address" value="Chưa có địa chỉ mặc định" readonly style="border-radius: 5px;">
                </div>
                <div class="form-group mb-4">
                    <label for="password">Đổi mật khẩu:</label>
                    <input type="password" class="form-control" name="password" style="border-radius: 5px;">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger" style="padding: 10px 30px; font-size: 16px; border-radius: 5px;">Cập nhật thông tin</button>
                </div>
            </div>
        </form>
    </div>
@endsection


