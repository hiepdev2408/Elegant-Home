<div class="header-lower">
    <div class="auto-container">
        <div class="inner-container d-flex justify-content-between align-items-center">

            <div class="logo-box d-flex align-items-center">
                <!-- Logo -->
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('themes/clients/images/logo.png') }}"
                            alt="" title=""></a></div>
            </div>
            <div class="nav-outer clearfix">
                <!-- Main Menu -->
                <nav class="main-menu show navbar-expand-md">
                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a>
                            </li>
                            <li><a href="#">Blog</a>
                            </li>

                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                            @if (Auth::check())
                                <li>
                                    <form action="{{ route('chat.create', Auth::user()->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Liên Hệ Admin</button>
                                    </form>
                                </li>
                            @endif



                        </ul>
                    </div>
                </nav>
                <!-- Main Menu End-->
            </div>
            <!-- Outer Box -->
            <div class="outer-box d-flex align-items-center">
                <!-- Options Box -->
                <div class="options-box d-flex align-items-center">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            @if (Auth::user()->role->id == 1 || Auth::user()->role->id == 2)
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item mt-2" href="{{ route('profile.info') }}">Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item mt-2" href="{{ route('admin') }}">Đến trang quản trị</a></li>
                                    <li><a class="dropdown-item mt-2" href="{{ route('profile.order') }}">Đơn hàng</a></li>
                                    <li><a class="dropdown-item mt-2" href="{{ route('logout') }}">Đăng xuất</a></li>
                                </ul>
                            @else
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item mt-2" href="{{ route('profile.info') }}">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item mt-2" href="{{ route('profile.order') }}">Đơn hàng</a></li>
                                <li><a class="dropdown-item mt-2" href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                            @endif
                        </div>
                    @else
                    <a class="user-box flaticon-user-3" href="{{ route('auth.login') }}"></a>
                    @endif

                </div>

                <!-- Cart Box -->
                <div class="cart-box">
                    <div class="box-inner">
                        <a href="{{ route('cart') }}" class="icon-box">
                            <span class="icon flaticon-bag"></span>
                            <i class="total-cart">
                                {{ $totalCart }}
                            </i>
                        </a>
                        Phone<br>
                        <a class="phone" href="tel:0382500462">0382500462</a>
                    </div>
                </div>
                <!-- End Cart Box -->

                <!-- Mobile Navigation Toggler -->
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
            </div>
            <!-- End Outer Box -->

        </div>

    </div>
</div>
<!-- End Header Lower -->

<!-- Sticky Header  -->
<div class="sticky-header">
    <div class="auto-container">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}" title=""><img
                        src="{{ asset('themes/clients/images/logo-small.png') }}" alt="" title=""></a>
            </div>

            <!-- Right Col -->
            <div class="right-box">
                <!-- Main Menu -->
                <nav class="main-menu">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
                <!-- Main Menu End-->

                <!-- Mobile Navigation Toggler -->
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
            </div>

        </div>
    </div>
</div>
<!-- End Sticky Menu -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
    <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"><img src="{{ asset('themes/clients/images/mobile-logo.png') }}"
                    alt="" title=""></a>
        </div>
        <!-- Search -->
        <div class="search-box">
            <form method="post" action="https://html.themexriver.com/bloxic/contact.html">
                <div class="form-group">
                    <input type="search" name="search-field" value="" placeholder="SEARCH HERE" required>
                    <button type="submit"><span class="icon flaticon-search-1"></span></button>
                </div>
            </form>
        </div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
    </nav>
</div>
