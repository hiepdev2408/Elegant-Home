import "./bootstrap";
window.Echo.channel("admin-notifications").listen(
    "NewMessageReceived",
    (event) => {
        alert("Bạn có một tin nhắn mới từ :" + event.user_name);
    }
);
