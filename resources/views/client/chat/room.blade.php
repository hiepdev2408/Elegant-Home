<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div id="app">
        <div class="container mt-5">
            <div class="bg-primary text-white p-3">
                <h5 class="mb-0">Chat</h5>
            </div>

            <!-- Hiển thị trạng thái người dùng -->
            <div class="status" >
                Trạng thái: <span id="user-status">Đang kiểm tra...</span>
            </div>

            <!-- Khung hiển thị tin nhắn -->
            <div id="message-box" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                <!-- Tin nhắn sẽ được đẩy vào đây -->
            </div>

            <!-- Form gửi tin nhắn -->
            <div class="input-box">
                <textarea class="form-control" id="message-input" placeholder="Nhập tin nhắn..." rows="3"></textarea>
                <button class="btn btn-primary" id="send-message-btn">Gửi</button>
            </div>
        </div>
    </div>
    <script>
        let userId = {{ auth()->id() }};
        let receiverId = {{ $receiverId }};
        let roomId = {{ $roomId }};
        let roleId= {{ auth()->user()->role_id}};
        // console.log(roleId)
    </script>
    @vite('resources/js/present.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
