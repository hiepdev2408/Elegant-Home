@extends('admin.layouts.master')

@section('title')
    Quyền truy cập
@endsection
@section('menu-item-account')
    open
@endsection

@section('menu-sub-role')
    active
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Tài Khoản /</span><span> {{ $role->name }}</span>
        </h4>
        @if (session('success'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 50px">
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thành Công!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('errors'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 50px">
                <div id="success-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Thất bại!</strong> {{ session('errors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 mt-4"
                                    src="{{ asset('themes') }}/admin/img/avatars/10.png" height="120" width="120"
                                    alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4>{{ $role->name }}</h4>
                                    <span class="badge bg-label-info rounded-pill">{{ $role->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap my-2 py-3">
                            <div class="d-flex align-items-center me-4 mt-3 gap-3">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class='mdi mdi-check mdi-24px'></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-0">1.23k</h4>
                                    <span>Tasks Done</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3 gap-3">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class='mdi mdi-star-outline mdi-24px'></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-0">568</h4>
                                    <span>Projects Done</span>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-3 border-bottom mb-3">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3">
                                    <span class="h6">Username:</span>
                                    <span>@violet.dev</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Email:</span>
                                    <span>vafgot@vultukir.org</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Status:</span>
                                    <span class="badge bg-label-success rounded-pill">Active</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Role:</span>
                                    <span>Author</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Tax id:</span>
                                    <span>Tax-8965</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Contact:</span>
                                    <span>(123) 456-7890</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Languages:</span>
                                    <span>French</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Country:</span>
                                    <span>England</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                    data-bs-toggle="modal">Edit</a>
                                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspend</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!--/ User Tabs -->

                <!-- Project table -->
                <form action="{{ route('permissions.updateGant') }}" method="post">
                    @csrf
                    <div class="card mb-4">
                        <!-- Notifications -->
                        <h5 class="card-header border-bottom">Quyền truy cập</h5>
                        <div class="card-body py-3">
                            <span class="text-heading fw-medium">Thay đổi quyền truy cập, người dùng sẽ nhận quyền truy
                                cập</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-nowrap">Quyền truy cập</th>
                                        <th class="text-nowrap text-center">Xem</th>
                                        <th class="text-nowrap text-center">Thêm</th>
                                        <th class="text-nowrap text-center">Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $category = [
                                            'categories.index' => 'Xem',
                                            'categories.create' => 'Thêm',
                                            'categories.edit' => 'Sửa',
                                        ];
                                        $products = [
                                            'products.index' => 'Xem',
                                            'products.create' => 'Thêm',
                                            'products.edit' => 'Sửa',
                                        ];
                                        $attribute = [
                                            'attributes.index' => 'Xem',
                                            'attributes.create' => 'Thêm',
                                            'attributes.edit' => 'Sửa',
                                        ];
                                        $attribute_value = [
                                            'attribute_values.index' => 'Xem',
                                            'attribute_values.create' => 'Thêm',
                                            'attribute_values.edit' => 'Sửa',
                                        ];
                                        $permissions = [
                                            'permissions.index' => 'Xem',
                                            'permissions.create' => 'Thêm',
                                            'permissions.edit' => 'Sửa',
                                        ];
                                    @endphp
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý danh mục</td>
                                        @foreach ($category as $slug => $label)
                                            @foreach ($roleCategory as $item)
                                                @if ($item->slug == $slug)
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                {{ $item->roles->contains($role->id) ? 'checked' : '' }}
                                                                name="permissions[{{ $role->id }}][]"
                                                                value="{{ $item->id }}" />
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý sản phẩm</td>
                                        @foreach ($products as $slug => $label)
                                            @foreach ($roleProduct as $item)
                                                @if ($item->slug == $slug)
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                {{ $item->roles->contains($role->id) ? 'checked' : '' }}
                                                                name="permissions[{{ $role->id }}][]"
                                                                value="{{ $item->id }}" />
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý thuộc tính</td>
                                        @foreach ($attribute as $slug => $label)
                                            @foreach ($roleAttribute as $item)
                                                @if ($item->slug == $slug)
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                {{ $item->roles->contains($role->id) ? 'checked' : '' }}
                                                                name="permissions[{{ $role->id }}][]"
                                                                value="{{ $item->id }}" />
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý giá trị thuộc tính</td>
                                        @foreach ($attribute_value as $slug => $label)
                                            @foreach ($roleAttribute_value as $item)
                                                {{-- @dd($item) --}}
                                                @if ($item->slug == $slug)
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                {{ $item->roles->contains($role->id) ? 'checked' : '' }}
                                                                name="permissions[{{ $role->id }}][]"
                                                                value="{{ $item->id }}" />
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary me-2">Lưu Lại</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-info me-2"> Quay lai</a>
                            <button type="reset" class="btn btn-outline-secondary">Đăt lại</button>
                        </div>
                        <!-- /Notifications -->
                    </div>
                </form>
                <!-- /Project table -->
            </div>
            <!--/ User Content -->
        </div>
    </div>
@endsection
