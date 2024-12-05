import "./bootstrap";
window.Echo.channel("admin-notifications").listen(
    "NewMessageReceived",
    (event) => {
        alert(event.user_name + ":" + event.message);
    }
);
