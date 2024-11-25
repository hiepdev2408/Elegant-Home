<aside class="sidebar col-4">
    <ul class="menu-list">
        <li class="menu-item @yield('home')">
            <a href="{{ route('profile.user') }}"><i class="fas fa-home"></i> Trang chủ
            </a>
        </li>
        <li class="menu-item @yield('order')">
            <a href="{{ route('profile.order') }}"> <i class="fas fa-history"></i> Lịch sử mua hàng</a>
        </li>
        <li class="menu-item">
            <i class="fas fa-gift"></i> Ưu đãi của bạn
        </li>
        <li class="menu-item">
            <i class="fas fa-medal"></i> Hạng thành viên
        </li>
        <li class="menu-item">
            <i class="fas fa-user-circle"></i> Tài khoản của bạn
        </li>
        <li class="menu-item">
            <i class="fas fa-headset"></i> Hỗ trợ
        </li>
        <li class="menu-item">
            <i class="fas fa-comment-dots"></i> Góp ý - Phản hồi
        </li>
        <li class="menu-item">
            <i class="fas fa-sign-out-alt"></i> Thoát tài khoản
        </li>
    </ul>
</aside>
@include('client.auth.layouts.partials.style')
@include('client.auth.layouts.partials.script')
