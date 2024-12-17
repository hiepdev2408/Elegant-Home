@extends('client.layouts.master')

@section('title')
    Yêu cầu trả hàng hàng/Hoàn tiền
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h3 class="text-center mb-4">Yêu cầu trả hàng hàng/Hoàn tiền</h3>
            <form action="{{ route('profile.refundRequests') }}" method="post">
                @csrf
                <div class="col-12 col-md-12">
                    <table class="datatables-order-details table">
                        <thead>
                            <tr>
                                <th class="w-50">Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td>
                                        @if ($item->product)
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="avatar me-2 pe-1">
                                                    @if ($item->product->img_thumbnail)
                                                        <img src="{{ Storage::url($item->product->img_thumbnail) }}"
                                                            width="50px" alt="">
                                                    @else
                                                        <img src="{{ asset('images/default-thumbnail.png') }}"
                                                            width="50px" alt="Default Image">
                                                    @endif
                                                </div>
                                                <div>
                                                    <span>{{ $item->product->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <span>{{ $item->product->name }}</span>
                                        @else
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="avatar me-2 pe-1">
                                                    @if ($item->variant && $item->variant->product->img_thumbnail)
                                                        <img class="rounded-2"
                                                            src="{{ Storage::url($item->variant->product->img_thumbnail) }}"
                                                            width="50px" alt="">
                                                    @else
                                                        <img src="{{ asset('images/default-thumbnail.png') }}"
                                                            width="50px" alt="Default Image">
                                                    @endif
                                                </div>
                                                <div>
                                                    <span>{{ optional($item->variant)->product->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <br>
                                            <span>
                                                @foreach ($item->variant->attributes as $attribute)
                                                    @if (!$loop->first)
                                                        <br>
                                                    @endif
                                                    {{ $attribute->attribute->name }}:
                                                    @if (!$loop->first)
                                                    @endif
                                                    {{ $attribute->attributeValue->value }}.
                                                @endforeach

                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->variant->price_modifier, 0, ',', '.') }} VND</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->total_amount, 0, ',', '.') }} VND</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-12">
                    <label for="reason" class="mb-1 mt-2">Lý do</label>
                    <select class="form-select" name="reason">
                        <option selected>Lý do hoàn tiền</option>
                        <option value="Thiếu hàng">Thiếu hàng</option>
                        <option value="Hàng lỗi">Hàng lỗi</option>
                        <option value="Khác với mô tả">Khác với mô tả</option>
                    </select>
                </div>
                <div class="col-12 col-md-12">
                    <label for="total_amount" class="mb-1 mt-2">Số tiền hoàn lại</label>
                    <input type="text" name="total_amount" class="form-control"
                        value="{{ number_format($item->order->total_amount, 0, ',', '.') }} VND" disabled>
                </div>
                <div class="col-12 col-md-12">
                    <label for="refund_on" class="mb-1 mt-2">Hoàn tiền vào ( Ngân Hàng/STK/Chủ Tài Khoản )</label>
                    <input type="text" name="refund_on" class="form-control"
                        placeholder="VÍ DỤ: MBBANK/070820045555/NGUYỄN VĂN DƯƠNG" />
                </div>
                <div class="col-12 col-md-12">
                    <label for="note" class="mb-1 mt-2">Mô tả</label>
                    <input type="text"name="note" class="form-control" placeholder="Lý do chi tiết" />
                </div>
                <div class="col-12 col-md-12">
                    <label for="Email" class="mb-1 mt-2">Email</label>
                    <input type="email"name="email" class="form-control" placeholder="Email"
                        value="{{ $item->order->user_email }}" />
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi Yêu Cầu</button>
                    <a href="{{ route('profile.order') }}" class="btn btn-outline-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
