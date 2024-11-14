@extends('client.layouts.master')
@section('title')
    Giỏ Hàng
@endsection

@section('content')
@foreach(session('cart.items', []) as $item)
<div>
    <p>Tên sản phẩm: {{ $item['name'] }}</p>
    <p>Số lượng: {{ $item['quantity'] }}</p>
    <p>Giá: {{ $item['price'] }}</p>
    <p>Thuộc tính:</p>
    <ul>
        @foreach($item['attributes'] as $attributeName => $attributeValue)
            <li>{{ $attributeName }}: {{ $attributeValue }}</li>
        @endforeach
    </ul>
</div>
@endforeach
@endsection

