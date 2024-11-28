@extends('admin.layouts.master')
@section('title')
Danh sách các sản phẩm bán chạy nhất
@endsection


@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thống Kê Sản Phẩm Bán Chạy</h1>
    <form method="GET" action="{{ route('top_sell.index') }}" class="mb-4">
        <div class="d-flex justify-content-between mb-3">
            <div class="form-group mr-2" style="flex: 1;">
                <label for="type">Chọn kiểu thống kê:</label>
                <select name="type" id="type" class="form-control">
                    <option value="day" {{ $type == 'day' ? 'selected' : '' }}>Theo ngày</option>
                    <option value="month" {{ $type == 'month' ? 'selected' : '' }}>Theo tháng</option>
                    <option value="year" {{ $type == 'year' ? 'selected' : '' }}>Theo năm</option>
                </select>
            </div>

            <div class="form-group" style="flex: 1;">
                <label for="date">Chọn ngày/tháng/năm:</label>
                <input type="date" name="date" id="date" value="{{ $date }}" class="form-control" required>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Xem</button>
        </div>
    </form>
    <h2>Sản phẩm bán chạy nhất
        @if($type == 'day')

        ngày {{ \Carbon\Carbon::parse($date)->format('d-m-Y')}}

        @elseif($type == 'month ')

        tháng {{\Carbon\Carbon::parse($date)->format('m-Y')}}

        @elseif($type == 'year')

        năm {{\Carbon\Carbon::parse($date)->format('Y') }}
        @endif
    </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ảnh Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng Bán</th>
                <th>Ngày Mua Hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProduct as $item)
            <tr>
                <td>
                    <img src="{{ Storage::url($item->product->img_thumbnail) }}" alt="{{ $item->product->name }}" style="width: 50px; height: auto;">
                </td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->tong_so_luong }}</td>
                <td>{{ $item->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('style-libs')

@endsection

@section('script-libs')

@endsection
