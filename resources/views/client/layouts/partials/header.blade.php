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
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Main Menu End-->
            </div>
            <!-- Outer Box -->
            <div class="outer-box d-flex align-items-center">
                <!-- Options Box -->
                <div class="options-box d-flex align-items-center">

                    <!-- Search Box -->
                    <div class="search-box-outer">
                        <div class="search-box-btn"><span class="flaticon-search-1"></span></div>
                    </div>

                    <!-- User Box -->
                    @if (Auth::check())
                        <li style="margin-top: -4px">
                            <a href="{{ route('profile.user') }}" class="fw-bold  me-3">{{ Auth::user()->name }}</a>
                        </li>
                    @else
                        <a class="user-box flaticon-user-3" href="{{ route('login') }}"></a>
                    @endif

                    <!-- Like Box -->
                    <div class="like-box">
                        <a class="user-box flaticon-heart" href="{{ route('show.favorite') }}"></a>
                        <span class="total-like">{{ $favouritecount }}</span>
                    </div>

                </div>

                <!-- Cart Box -->
                <div class="cart-box">
                    <div class="box-inner">
                        <a href="{{ route('listCart') }}" class="icon-box">
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
