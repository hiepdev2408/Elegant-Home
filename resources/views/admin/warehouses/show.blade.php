@extends('admin.layouts.master')
@section('title')
    Thêm sản phẩm kho hàng
@endsection
@section('menu-item-post')
    open
@endsection

@section('menu-sub-create-post')
    active
@endsection
@section('content')
    <div class="container mt-5">
        <h1>Chi tiết phẩm kho hàng</h1>
        <form action="" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tên sản phẩm</label>
                <input type="text" name="" value="{{$warehouse->product->name}}" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">ảnh sản phẩm</label><br>
                  <img src="{{ Storage::url($warehouse->product->img_thumbnail) }}" alt="" height="100px" >
            </div>
            <!-- User ID -->
            <div class="mb-3">
                <label for="title" class="form-label">Người nhập kho</label>
            <input type="text" name="" value="{{$warehouse->user->name}}" class="form-control" readonly>
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">Tổng số lượng</label>
                <input type="number" class="form-control" id="quantity"  value="{{$warehouse->quantity}}" readonly>
            </div>
            @error('quantity')
                <span class="" style="color: red">{{ $message }}</span>
            @enderror


            <div class="mb-3">
                <label for="price_import" class="form-label">Giá nhập hàng</label>
                <input type="number" class="form-control" value="{{$warehouse->price_import}}" readonly>

            </div>
            @error('price_import')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="date_import" class="form-label">Ngày nhập Hàng</label>
                <input type="date" class="form-control" value="{{$warehouse->date_import}}" readonly
                   >
            </div>
            <div class="mb-3">
                <label for="Date_manufacture" class="form-label">Ngày sản xuất</label>
                <input type="date" class="form-control" value="{{$warehouse->Date_manufacture}}" readonly
                   >
            </div>
            @error('Total_amount')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="Total_amount" class="form-label">Tổng số tiền</label>
                <input type="number" class="form-control" value="{{$warehouse->Total_amount}}" readonly
                   >
            </div>
            <a href="" class="btn btn-primary" onclick="window.print()">Xuất phiếu nhập kho</a>
            <a href="{{ route('warehouses.index') }}" class="btn btn-info">Quay lại</a>
        </form>
    </div>
@endsection

