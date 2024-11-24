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
