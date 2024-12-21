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
                                <a href="{{ route('products.index') }}" class="mt-2">
                                    <h6>Xem chi tiết</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">
                                <i class="fa-solid fa-shopping-cart fa-2x text-warning mb-2"></i>
                                <h5 class="card-title">Đơn hàng</h5>
                                <a href="{{ route('orders.index') }}" class="mt-2">
                                    <h6>Xem chi tiết</h6>
                                </a>
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
            <div class="row">
                <!-- Bảng thông tin khách hàng -->
                <div class="col-xl-8 order-xl-1 order-2">
                    <div class="card mb-5">
                        <div class="table-responsive">
                            <table class="table table-hover">
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
                                            <td class="text-primary fw-bold">{{ $item->user_id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ asset('themes') }}/admin/img/avatars/1.png"
                                                            alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-truncate">{{ $item->name }}</h6>
                                                        <small class="text-truncate text-muted">{{ $item->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-truncate fw-bold text-success">
                                                {{ number_format($item->gia_mua_hang, 0, ',', '.') }} VND
                                            </td>
                                            <td>
                                                <span class="badge bg-success rounded-pill fw-normal">
                                                    {{ $item->tong_don_hang }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">Dữ liệu được cập nhật lúc {{ now()->format('H:i d/m/Y') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Phần tổng giao dịch -->
                <div class="col-xl-4 order-xl-2 order-1">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="mb-3 text-muted">Giao dịch hôm nay</h6>
                            <h4 class="mb-2 text-primary fw-bold">{{ $tongGiaoDichHomNay }}
                            </h4>
                            <small class="text-muted">Tổng giá trị giao dịch</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <form method="GET" action="{{ route('admin') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Từ ngày:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                value="{{ $startDate }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Đến ngày:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5>Tổng số đơn hàng hôm nay: {{ $tongGiaoDichHomNay }}</h5>
                    <p>So với hôm qua: {{ number_format($thayDoi, 2) }}%</p>
                </div>
                <div class="col-md-6">
                    <h5>Doanh thu từ {{ $startDate }} đến {{ $endDate }}:
                        {{ number_format($tongSoTienTheoNgay, 0, ',', '.') }} VND</h5>
                </div>
            </div>
            <div class="container mt-5">
                <h2 class="text-center mb-4">Thống kê doanh thu và đơn hàng</h2>
                <div class="row">
                    <!-- Biểu đồ cột -->
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Số lượng doanh thu theo ngày</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ tròn -->
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Tỷ lệ doanh thu theo danh mục</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="inventoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Biểu đồ cột: Số lượng đơn hàng theo ngày
        const ordersData = {

            labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'],
            datasets: [{
                label: 'Doanh thu',
                data: [
                    {{ $tongGiaoDichHomNay }},
                    {{ $tongSoTienTheoNgay }},
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        };

        const ordersConfig = {
            type: 'bar',
            data: ordersData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Số lượng doanh thu theo ngày',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                },
            },
        };

        new Chart(document.getElementById('ordersChart'), ordersConfig);

        // Biểu đồ tròn: Tỷ lệ doanh thu theo danh mục
        const revenueData = {
            labels: ['Thời trang', 'Đồ gia dụng', 'Điện tử', 'Khác'],
            datasets: [{
                label: 'Tỷ lệ doanh thu',
                data: [40, 25, 20, 15],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
                hoverOffset: 4,
            }]
        };

        const revenueConfig = {
            type: 'pie',
            data: revenueData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Tỷ lệ doanh thu theo danh mục',
                    },
                },
            },
        };

        new Chart(document.getElementById('revenueChart'), revenueConfig);
    </script>
@endsection
