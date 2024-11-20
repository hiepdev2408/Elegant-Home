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
        <h1>Thêm sản phẩm kho hàng</h1>
        <form action="{{ route('warehouses.store') }}" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tên sản phẩm</label>
                <select name="product_id" id="product_id" class="form-control">
                    @foreach ($product as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- User ID -->
           <div class="mb-3">
                <label for="title" class="form-label">Người nhập kho</label>
                   <input type="text" class="form-control" id="date_import" name="user_id" value="{{$user->name}}">
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">Tổng số lượng</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Số lượng" oninput="calculateTotal()">
            </div>
            @error('quantity')
                <span class="" style="color: red">{{ $message }}</span>
            @enderror


            <div class="mb-3">
                <label for="price_import" class="form-label">Giá nhập hàng</label>
                <input type="number" class="form-control" id="price_import" name="price_import" oninput="calculateTotal()"
                    placeholder="Giá nhập sản phẩm">
            </div>
            @error('price_import')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="date_import" class="form-label">Ngày nhập Hàng</label>
                <input type="date" class="form-control" id="date_import" name="date_import"
                   >
            </div>
            <div class="mb-3">
                <label for="Date_manufacture" class="form-label">Ngày sản xuất</label>
                <input type="date" class="form-control" id="Date_manufacture" name="Date_manufacture"
                   >
            </div>
            @error('Total_amount')
                <span class=" " style="color: red">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="Total_amount" class="form-label">Tổng số tiền</label>
                <input type="number" class="form-control" id="Total_amount" name="Total_amount" readonly
                   >
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Thêm nhập kho</button>
        </form>
    </div>
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
    // Tính tổng tiền khi người dùng nhập số lượng hoặc giá nhập
    function calculateTotal() {
        var quantity = document.getElementById('quantity').value;
        var purchasePrice = document.getElementById('price_import').value;
        var totalPrice = quantity * purchasePrice;
        document.getElementById('Total_amount').value = totalPrice;
    }
</script>
@endsection
