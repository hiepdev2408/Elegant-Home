import "./bootstrap";

// Gắn ID người nhận vào giao diện
// document.getElementById('chat-with').textContent = 'User ' + receiverId;

// Kết nối đến Presence Channel với Laravel Echo
window.Echo.join(`chat.${roomId}`)
    .here((users) => {
        console.log("==============here============");
        console.table(users);

        if (users.length > 1) {
            document.getElementById("user-status").textContent = "Online";
        } else {
            document.getElementById("user-status").textContent = "Offline";
        }
    })
    .joining((user) => {
        console.log("==============joining============");
        console.table(user);
        document.getElementById("user-status").textContent = "Online";
    })
    .leaving((user) => {
        console.log("==============leaving============");
        console.table(user);
        document.getElementById("user-status").textContent = "Offline";
    })
    .listen("MessageSent", (event) => {
        console.log(event.message);
        appendMessage(event.message, event.user_id);
    });

// Gửi tin nhắn
document
    .getElementById("send-message-btn")
    .addEventListener("click", function () {
        const messageInput = document.getElementById("message-input");
        const message = messageInput.value.trim();

        if (message === "") {
            alert("Vui lòng nhập tin nhắn");
            return;
        }

        // Gửi tin nhắn qua Link
        axios
            .post("/messages/send", {
                message: message,
                receiver_id: receiverId,
                room_id: roomId,
            })
            .then((response) => {
                // Sau khi gửi, thêm tin nhắn vào khung hiển thị
                appendMessage(message, userId);
                messageInput.value = ""; // Xóa nội dung sau khi gửi
            })
            .catch((error) => {
                console.error("Error sending message:", error);
            });
    });

// Hàm thêm tin nhắn vào khung hiển thị
function appendMessage(message, senderId) {
    const messageBox = document.getElementById("message-box");
    const messageElement = document.createElement("div");
    if (roleId == 1 || roleId == 2) {
        messageElement.classList.add("message");
        messageElement.textContent =
            (senderId === userId ? "Bạn: " : "Khách hàng: ") + message;
    }
    if (roleId == 3) {
        messageElement.classList.add("message");
        messageElement.textContent =
            (senderId === userId ? "Bạn: " : "Quản trị viên: ") + message;
    }

    messageBox.appendChild(messageElement);

    // Cuộn xuống cuối cùng để thấy tin nhắn mới
    messageBox.scrollTop = messageBox.scrollHeight;
}
