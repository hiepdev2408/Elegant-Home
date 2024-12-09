<div class="header-lower">
    <div class="auto-container">
        <div class="inner-container d-flex justify-content-between align-items-center">

            <div class="logo-box d-flex align-items-center">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('themes/clients/images/logo.png') }}"
                            alt="" title=""></a></div>
            </div>
            <div class="nav-outer clearfix">
                <nav class="main-menu show navbar-expand-md">
                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="{{ route('shop') }}">Sản phẩm</a></li>
                            <li><a href="{{ route('policy') }}">Chính sách đổi trả</a></li>
                            <li><a href="">Bài viết</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="outer-box d-flex align-items-center">
                <div class="options-box d-flex align-items-center">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item mt-2" href="{{ route('profile.info') }}">Thông tin cá
                                        nhân</a></li>
                                @if (Auth::user()->role->id == 1 || Auth::user()->role->id == 2)
                                    <li><a class="dropdown-item mt-2" href="{{ route('admin') }}">Đến trang quản trị</a>
                                    </li>
                                @endif
                                <li><a class="dropdown-item mt-2" href="{{ route('profile.order') }}">Đơn hàng</a>
                                </li>
                                <li><a class="dropdown-item mt-2" href="{{ route('show.favorite') }}">Yêu thích</a>
                                </li>
                                <li><a class="dropdown-item mt-2" href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    @else
                        <a class="user-box flaticon-user-3" href="{{ route('auth.login') }}"></a>
                    @endif
                </div>
                <div class="cart-box">
                    <div class="box-inner">
                        <a href="{{ route('cart') }}" class="icon-box">
                            <span class="icon flaticon-bag"></span>
                            <i class="total-cart">
                                {{ $totalCart }}
                            </i>
                        </a>
                        Điện thoại<br>
                        <a class="phone" href="tel:0382500462">0382500462</a>
                    </div>
                </div>
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
            </div>
        </div>
    </div>
</div>

<div class="sticky-header">
    <div class="auto-container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ route('home') }}" title=""><img
                        src="{{ asset('themes/clients/images/logo-small.png') }}" alt="" title=""></a>
            </div>

            <div class="right-box">
                <nav class="main-menu">
                </nav>
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
    <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"><img src="{{ asset('themes/clients/images/mobile-logo.png') }}"
                    alt="" title=""></a>
        </div>
        <div class="search-box">
            <form method="post" action="https://html.themexriver.com/bloxic/contact.html">
                <div class="form-group">
                    <input type="search" name="search-field" value="" placeholder="SEARCH HERE" required>
                    <button type="submit"><span class="icon flaticon-search-1"></span></button>
                </div>
            </form>
        </div>
        <div class="menu-outer">
        </div>
    </nav>
</div>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <!-- Toast container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <!-- Success Toast -->
        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>Thành công!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Error Toast -->
        @if (session('error'))
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>Lỗi!</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
</div>
