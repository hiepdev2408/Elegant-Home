@extends('admin.layouts.master')
@section('title')
    Thêm xuất hàng kho
@endsection
@section('menu-item-post')
    open
@endsection

@section('menu-sub-create-post')
    active
@endsection
@section('content')
    <div class="container mt-5">
        <h1> Thêm xuất hàng kho</h1>
        <form action="{{ route('exportwarehouses.store') }}" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tên sản phẩm và số lượng còn</label>
                <select name="warehouse_id" id="warehouse_id" class="form-control">
                    @foreach ( $products as $product)
                        <option value="{{ $product->id }}">{{ $product->product->name  }}/SL:{{ $product->quantity }}</option>
                    @endforeach
                </select>
            </div>
            <!-- User ID -->
            <div class="mb-3">
                <label for="title" class="form-label">Người xuất kho</label>
               <input type="text" name="user_id" class="form-control" value="{{$user->name}}" readonly>
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">Số lượng xuất</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Số lượng" oninput="calculateTotal()">
            </div>
            @error('quantity')
                <span class="" style="color: red">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="datetime" class="form-label">ngày xuất Hàng</label>
                <input type="datetime-local" class="form-control" id="datetime" name="Shipment_date"
                   >
            </div>
            @error('Shipment_date')
            <span class="" style="color: red">{{ $message }}</span>
        @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Ghi chú</label>
               <textarea name="note" id="" cols="10" rows="5" class="form-control"></textarea>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Thêm xuất kho</button>
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
