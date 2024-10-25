@extends('admin.layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Quản lý loại tin /</span> Danh sách
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="mdi mdi-plus me-0 me-sm-1"></i>Thêm sản
                phẩm</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá cơ bản</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Biến thể</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            {{-- @dd($product->productAttributes) --}}
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->base_price, 0, ',', '.') }} VND</td>
                                <td>
                                    @if ($product->img_thumbnail)
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt="{{ $product->name }}"
                                            style="width: 100px;">
                                    @else
                                        <span>Chưa có hình</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->variants->isEmpty())
                                        <em>Không có biến thể</em>
                                    @else
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tên Biến Thể</th>
                                                    <th>Giá</th>
                                                    <th>Tồn Kho</th>
                                                    <th>Ảnh biến thể</th>
                                                    <th>Thuộc Tính</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->variants as $variant)
                                                    <tr>
                                                        <td>{{ $variant->sku }}</td>
                                                        <td>{{ number_format($variant->price_modifier, 0, ',', '.') }} VND</td>
                                                        <td>{{ $variant->stock }}</td>
                                                        <td>
                                                            @if ($variant->image)
                                                                <img src="{{ Storage::url($variant->image) }}" width="50px" alt="">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($variant->attributes)
                                                                <ul>
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        <li>{{ $attribute->attribute->name }}:
                                                                            {{ $attribute->attributeValue->value }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <em>Không có thuộc tính</em>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Chỉnh
                                        sửa</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
