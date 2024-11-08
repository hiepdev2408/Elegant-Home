@extends('client.layouts.master')
@section('content')
    <h4>Sản phẩm yêu thích</h4>
    <div class="car">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá cơ bản và giá Sale</th>
                    <th>Ngày yêu thích</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($favorite as $item)
                <tr>


                        <td>

                                <form action="{{route('deleteFavorite',$item->id)}}" method="POST" onclick="confirm('bạn có chắc muốn xóa sản phẩn yêu thích')">
                                    @csrf
                                    @method('delete')

                                    <button class="cart__remove--btn" aria-label="search button" type="submit">


                                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px"
                                    height="16px">
                                    <path
                                        d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                </svg>
                            </button>
                                </form>

                        </td>
                        <td>{{ $item->product_id }}</td>
                        <td><a href="">{{ $item->product->name }}</a></td>
                        <td>
                            <img src="{{ Storage::url($item->product->img_thumbnail) }}" alt="" height="100px"
                                width="110px">
                        </td>
                        <td>{{ number_format($item->product->base_price, 0, '', '') }}VND/{{ number_format($item->product->price_sale, 0, '', '') }}VND
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
