@extends('admin.layouts.master')

@section('title')
    Bảng điều khiển
@endsection

@section('menu-item-dashboard')
    active
@endsection

@section('content')
<div class="container mt-2">
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h3 class="mb-0 text-white">Thống kê</h3>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                            <h5 class="card-title">Khách hàng</h5>
                            <h6 class="mt-2">{{ $user }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="fa-solid fa-box fa-2x text-success mb-2"></i>
                            <h5 class="card-title">Sản phẩm</h5>
                            <a href="{{ route('products.index') }}" class="mt-2"><h6>Xem chi tiết</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="fa-solid fa-shopping-cart fa-2x text-warning mb-2"></i>
                            <h5 class="card-title">Đơn hàng</h5>
                            <a href="{{ route('orders.index') }}" class="mt-2"><h6>Xem chi tiết</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="fa-solid fa-dollar-sign fa-2x text-danger mb-2"></i>
                            <h5 class="card-title">Doanh thu</h5>
                            <h6>{{ number_format($totalAmount, '0', '0', ',') }} VNĐ</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1 order-2">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-truncate"># ID</th>
                                <th class="text-truncate">Khách hàng</th>
                                <th class="text-truncate">Số tiền đã mua</th>
                                <th class="text-truncate">Số đơn hàng đã mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td class="text-primary">{{ $item->user_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <img src="{{ asset('themes') }}/admin/img/avatars/1.png"
                                                    alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-truncate">{{ $item->name }}</h6>
                                                <small class="text-truncate">{{ $item->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">{{ number_format($item->gia_mua_hang, 0, ',', '.') }}
                                        VND</td>
                                    <td><span
                                            class="badge bg-label-success rounded-pill fw-normal">{{ $item->tong_don_hang }}</span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <h6 class="mb-2">Giao dịch</h6>
            <div class="d-flex flex-wrap mb-2 gap-2 pb-1 align-items-center">
                <h4 class="mb-0">{{ $tongGiaoDichHomNay }}</h4>
            </div>
            <small>Giao dịch hôm nay</small>
        </div>
    </div>
</div>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/css/pages/app-ecommerce-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        }
    </style>
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-dashboard.js"></script>
@endsection
