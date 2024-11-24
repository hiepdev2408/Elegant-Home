import "./bootstrap";

//láng nghe sự kiện khi user vào chat
window.Echo.channel("admin-chat").listen("RoomJoinedEvent", (data) => {
    const roomId = data.roomId;
    const roomElement = document.querySelector(`[data-room-id="${roomId}"]`);
    if (roomElement) {
        const badge = roomElement.querySelector(".badge");
        badge.classList.remove("bg-danger");
        badge.classList.add("bg-success");
        badge.textContent = "Joined";
    }
});
