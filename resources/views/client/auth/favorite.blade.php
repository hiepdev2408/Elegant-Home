@extends('client.layouts.master')
@section('content')
    <div class="container py-5">
        <h3 class="mb-4 text-center text-primary">Sản phẩm yêu thích</h3>

        <div class="card shadow-sm p-4">
            @if (!$favorite || $favorite->isEmpty())
                <div class="favorites-empty text-center p-5">
                    <img src="{{ asset('images/empty-favorites.svg') }}" alt="No Favorites" class="w-25 mx-auto mb-4">
                    <h2 class="text-lg font-semibold text-muted">Danh sách yêu thích của bạn đang trống</h2>
                    <p class="text-gray-600 mb-4">Hãy thêm những mục yêu thích để chúng hiển thị ở đây.</p>
                    <a href="{{ route('shop.filter') }}" class="btn btn-primary mt-4">
                        <i class="fas fa-search"></i> Khám phá sản phẩm
                    </a>
                </div>
            @else
                <table class="table table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Thao tác</th>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Giá</th>
                            <th>Ngày yêu thích</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($favorite as $item)
                            <tr>
                                <td>
                                    <form action="{{ route('deleteFavorite', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm yêu thích này?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-sm" type="submit" aria-label="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $index++ }}</td>
                                <td>
                                    <a href="{{ route('productDetail', $item->product->slug) }}"
                                        class="text-decoration-none text-dark fw-bold">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('productDetail', $item->product->slug) }}">
                                        <img src="{{ Storage::url($item->product->img_thumbnail) }}" alt=""
                                            class="rounded" style="height: 100px; width: 110px; object-fit: cover;">
                                    </a>
                                </td>
                                <td>
                                    <span class="text-muted"><del>{{ number_format($item->product->base_price, 0, ',', '.') }} VND</del></span>
                                    <br>
                                    <span class="text-danger fw-bold">{{ number_format($item->product->price_sale, 0, ',', '.') }} VND</span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
