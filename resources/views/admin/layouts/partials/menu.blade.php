<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="/admin" class="app-brand-link">
            <img src="{{ asset('themes') }}/admin/img/logo/logo.png" alt="" height="30px">

            <span class="app-brand-text demo menu-text fw-semibold ms-2">𝐄𝐥𝐞𝐠𝐚𝐧𝐭</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item @yield('menu-item-dashboard')">
            <a href="/admin" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Bảng điều khiển">Bảng điều khiển</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
        </li>
        <!-- Apps & Pages -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>
        <li class="menu-item @yield('menu-item-chat')">
            <a href="{{ route('chat') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-message-outline"></i>
                <div data-i18n="Trò chuyện">Trò chuyện</div>
            </a>
        </li>

        <li class="menu-item @yield('menu-item-order')">
            <a class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-order-bool-descending-variant'></i>
                <div data-i18n="Đơn Hàng">Đơn Hàng</div>
                <div class="badge bg-danger rounded-pill ms-auto">0</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-order')">
                    <a href="{{ route('attributes.create') }}" class="menu-link">
                        <div data-i18n="Tạo mới đơn hàng">Tạo mới đơn hàng</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-order')">
                    <a href="{{ route('attributes.index') }}" class="menu-link">
                        <div data-i18n="Danh sách đơn hàng">Danh sách đơn hàng</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-voucher')">
            <a class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-sale-outline"></i>
                <div data-i18n="Khuyến Mãi">Khuyến Mãi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-voucher')">
                    <a href="{{ route('vouchers.create') }}" class="menu-link">
                        <div data-i18n="Thêm voucher">Thêm voucher</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-voucher')">
                    <a href="{{ route('vouchers.index') }}" class="menu-link">
                        <div data-i18n="Danh sách voucher">Danh sách voucher</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-categories')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-notebook-outline'></i>
                <div data-i18n="Danh mục">Danh mục</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-categories')">
                    <a href="{{ route('categories.create') }}" class="menu-link">
                        <div data-i18n="Thêm danh mục">Thêm danh mục</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-categories')">
                    <a href="{{ route('categories.index') }}" class="menu-link">
                        <div data-i18n="Danh sách danh mục">Danh sách danh mục</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-delete-categories')">
                    <a href="{{ route('categories.delete') }}" class="menu-link">
                        <div data-i18n="Thùng rác">Thùng rác</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-product')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-unity'></i>
                <div data-i18n="Sản phẩm">Sản phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-product')">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div data-i18n="Thêm sản phẩm">Thêm sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-product')">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <div data-i18n="Danh sách sản phẩm">Danh sách sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-warehouse')">
                    <a href="{{ route('products.warehouse') }}" class="menu-link">
                        <div data-i18n="Quản Lý Kho">Quản Lý Kho</div>
                    </a>
                </li>
            </ul>
        </li>

        {{--
        <li class="menu-item @yield('menu-item-product')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-atlassian'></i>
                <div data-i18n="Kho hàng">Kho hàng</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-warehouse')">
                    <a href="{{ route('warehouses.create') }}" class="menu-link">
                        <div data-i18n="Thêm nhập kho">Thêm nhập kho</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-warehouse')">
                    <a href="{{ route('warehouses.index') }}" class="menu-link">
                        <div data-i18n="Danh sách nhập kho">Danh sách nhập kho</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-create-exportwarehouses')">
                    <a href="{{ route('exportwarehouses.create') }}" class="menu-link">
                        <div data-i18n="Thêm xuất kho">Thêm xuất kho</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-exportwarehouses')">
                    <a href="{{ route('exportwarehouses.index') }}" class="menu-link">
                        <div data-i18n="Danh sách xuất kho">Danh sách xuất kho</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-item @yield('menu-item-attribute')">
            <a class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-distribute-horizontal-center'></i>
                <div data-i18n="Thuộc tính">Thuộc tính</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-attribute')">
                    <a href="{{ route('attributes.create') }}" class="menu-link">
                        <div data-i18n="Thêm thuộc tính">Thêm thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-attribute')">
                    <a href="{{ route('attributes.index') }}" class="menu-link">
                        <div data-i18n="Danh sách thuộc tính">Danh sách thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-attribute-value')">
                    <a href="{{ route('attribute_values.index') }}" class="menu-link">
                        <div data-i18n="Giá trị thuộc tính">Giá trị thuộc tính</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-account')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
                <div data-i18n="Tài Khoản">Tài Khoản</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-customer')">
                    <a href="{{ route('account.listCustomer') }}" class="menu-link">
                        <div data-i18n="Khách Hàng">Khách Hàng</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-staff')">
                    <a href="{{ route('account.listStaff') }}" class="menu-link">
                        <div data-i18n="Nhân Viên">Nhân Viên</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-admin')">
                    <a href="{{ route('account.listAdmin') }}" class="menu-link">
                        <div data-i18n="Quản Trị Viên">Quản Trị Viên</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-role')">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <div data-i18n="Vai Trò">Vai Trò</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-permission')">
                    <a href="{{ route('permissions.index') }}" class="menu-link">
                        <div data-i18n="Quyền Truy Cập">Quyền Truy Cập</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-contact')">
            <a href="{{ route('contact.index') }}" class="menu-link">
                <i class='menu-icon tf-icons mdi mdi-card-account-mail-outline'></i>
                <div data-i18n="Liên Hệ">Liên Hệ</div>
                <div class="badge bg-danger rounded-pill ms-auto">{{ $countContact }}</div>
            </a>
        </li>

        <li class="menu-item @yield('menu-item-post')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-post'></i>
                <div data-i18n="Bài viết">Bài viết</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-post')">
                    <a href="{{ route('blogs.create') }}" class="menu-link">
                        <div data-i18n="Thêm bài viết">Thêm bài viết</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-post')">
                    <a href="{{ route('blogs.index') }}" class="menu-link">
                        <div data-i18n="Danh sách bài viết">Danh sách bài viết</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
