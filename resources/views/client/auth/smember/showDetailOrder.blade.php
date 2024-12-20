<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-datatable table-responsive">
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
                            @if ($item->product)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar me-2 pe-1">
                                                @if ($item->product->img_thumbnail)
                                                    <img class="rounded-2"
                                                        src="{{ Storage::url($item->product->img_thumbnail) }}"
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
                                    </td>
                                    <td>
                                        @if ($item->product->price_sale)
                                            {{ number_format($item->product->price_sale, 0, ',', '.') }} VND
                                        @elseif ($item->product->base_price)
                                            {{ number_format($item->product->base_price, 0, ',', '.') }} VND
                                        @endif
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->total_amount, 0, ',', '.') }} VND</td>
                                </tr>
                            @else
                                <tr>
                                    <td>
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
                                    </td>
                                    <td>{{ number_format($item->variant->price_modifier, 0, ',', '.') }} VND</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->total_amount, 0, ',', '.') }} VND</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end align-items-center m-3 p-1">
                    <div class="order-calculations">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading fw-bold mt-1">Tổng cộng:</span>
                            <h6 class="mb-0 ms-2 text-danger">
                                {{ number_format($item->order->total_amount, 0, ',', '.') }} VND</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title m-0">Hoạt động</h5>
            </div>
            <div class="card-body mt-3">
                <ul class="timeline pb-0 mb-0">
                    @foreach ($events as $event)
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $event->name }}</h6>
                                    <span class="text-muted">{{ date('d/m/Y', strtotime($event->created_at)) }}
                                        |
                                        {{ $event->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                </div>
                                <p class="mt-2">{{ $event->note }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="card-title mb-1">Chi tiết khách hàng</h6>
                <div class="d-flex justify-content-start align-items-center ">
                    <div class="avatar me-2 pe-1 mt-3">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="User Avatar"
                                class="rounded-circle mb-3" width="50px" style="height: 50px;">
                        @else
                            <img src="{{ asset('themes/image/logo.jpg') }}" alt="User Avatar"
                                class="rounded-circle mb-3" width="50px">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <a href="app-user-view-account.html">
                            <h6 class="mb-1">{{ $item->order->user_name }}</h6>
                        </a>
                        {{-- <small>ID KHÁCH HÀNG: #58909</small> --}}
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Thông tin liên lạc</h6>
                </div>
                <p class=" mb-1">Email: {{ $item->order->user_email }}</p>
                <p class=" mb-0">Số điện thoại: {{ $item->order->user_phone }}</p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="card-title m-0">Địa chỉ giao hàng</h6>
            </div>
            <div class="card-body">
                <p class="mb-0">Số 21, Xuân Phương<br>Nam Từ Liêm <br>Hà Nội<br>Việt Nam</p>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container mt-5">
    <div class="mt-3">
        <h4 class="text-center">Chi tiết đơn hàng #{{ $order->id }}</h4>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white text-dark d-flex justify-content-between">
            <span>Đơn hàng #{{ $order->id }}</span>
            <span>{{ date('d/m/Y', $order->order_date) }}</span>
        </div>
        <div class="card-body">
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái:</strong>
                @if ($order->status_order == 'pending')
                    <span class="badge bg-info">Chờ xác nhận</span>
                @elseif ($order->status_order == 'comfirmed')
                    <span class="badge bg-success">Đã xác nhận</span>
                @elseif ($order->status_order == 'shipping')
                    <span class="badge bg-warning">Chờ giao hàng</span>
                @elseif ($order->status_order == 'delivered')
                    <span class="badge bg-primary">Đã giao hàng</span>
                @elseif ($order->status_order == 'completed')
                    <span class="badge bg-primary">Đã nhận hàng</span>
                @elseif ($order->status_order == 'canceled')
                    <span class="badge bg-danger">Đơn hàng đã hủy</span>
                @endif
            </p>
            <h5 class="mt-3">Chi tiết sản phẩm:</h5>
            <ul class="list-group">
                @foreach ($order->orderDetails as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @if ($item->product)
                            <span>({{ $item->quantity }}x) - {{ $item->product->name }}</span>
                            <span>
                                @if ($item->product->img_thumbnail)
                                    <img src="{{ Storage::url($item->product->img_thumbnail) }}" width="150px"
                                        alt="">
                                @else
                                    <img src="{{ asset('images/default-thumbnail.png') }}" width="150px"
                                        alt="Default Image">
                                @endif
                                {{ number_format($item->total_amount, 0, ',', '.') }} VND
                            </span>
                        @else
                            <span>({{ $item->quantity }}x) - {{ optional($item->variant)->product->name }}</span>
                            <span>
                                @if ($item->variant && $item->variant->product->img_thumbnail)
                                    <img src="{{ Storage::url($item->variant->product->img_thumbnail) }}"
                                        width="150px" alt="">
                                @else
                                    <img src="{{ asset('images/default-thumbnail.png') }}" width="150px"
                                        alt="Default Image">
                                @endif
                                {{ number_format($item->total_amount, 0, ',', '.') }} VND
                            </span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer text-left">
            <a href="{{ route('profile.order') }}" class="btn btn-sm btn-outline-warning float-end me-3">Quay lại</a>
        </div>

    </div>
</div> --}}
