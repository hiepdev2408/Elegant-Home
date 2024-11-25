<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach((item) => {
            item.addEventListener("click", () => {
                const currentActive = document.querySelector(".menu-item.active");

                // Xóa trạng thái active trước đó
                if (currentActive) {
                    currentActive.classList.remove("active");
                }

                // Thêm trạng thái active vào mục mới được chọn
                item.classList.add("active");
            });
        });
    });
</script>
<script>
    document.getElementById('logout-link').addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định
        // Hiển thị SweetAlert2
        Swal.fire({
            title: 'Đăng Xuất?',
            text: "Bạn sắp thoát khỏi tài khoản!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Thoát',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Kiểm tra nếu có thông báo success
    @if (session('success'))
        // Đặt thời gian chờ 3 giây (3000ms)
        setTimeout(function() {
            // Tìm và tự động đóng thông báo
            var alert = document.getElementById('success-alert');
            if (alert) {
                var closeButton = alert.querySelector('.btn-close');
                closeButton.click(); // Kích hoạt sự kiện đóng
            }
        }, 3000); // Thời gian 3 giây
    @endif
</script>
