import "./bootstrap";
Echo.channel("admin-dashboard").listen("OrderCount", (data) => {
    // Cập nhật số lượng đơn hàng trên giao diện
    document.getElementById("order-count").innerText = data.orderCount;
});
