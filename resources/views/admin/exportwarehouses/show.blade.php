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
                <input type="text" name="" value="{{$warehouseExport->warehouse->product->name}}" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">ảnh sản phẩm</label><br>
                  <img src="{{ Storage::url($warehouseExport->warehouse->product->img_thumbnail) }}" alt="" height="100px" >
            </div>
            <!-- User ID -->
            <div class="mb-3">
                <label for="title" class="form-label">Người nhập kho</label>
            <input type="text" name="" value="{{$warehouseExport->user->name}}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tổng số lượng trong kho</label>
                <input type="number" class="form-control" id="quantity"  value="{{$warehouseExport->warehouse->quantity}}" readonly>
            </div>
            @error('quantity')
                <span class="" style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Tổng số lượng</label>
                <input type="number" class="form-control" id="quantity"  value="{{$warehouseExport->quantity}}" readonly>
            </div>
            @error('quantity')
                <span class="" style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="date_import" class="form-label">Ngày nhập Hàng</label>
                <input type="datetime-local" class="form-control" value="{{$warehouseExport->Shipment_date}}" readonly
                   >
            </div>
            <div class="mb-3">
                <label for="Date_manufacture" class="form-label">Ghi chú</label>
                <textarea name="" id="" cols="30" rows="10" class="form-control"  readonly>{{$warehouseExport->note}}</textarea>
            </div>
            <a href="" class="btn btn-primary" onclick="window.print()">Xuất phiếu nhập kho</a>
            <a href="{{ route('exportwarehouses.index') }}" class="btn btn-info">Quay lại</a>
        </form>
    </div>
@endsection

