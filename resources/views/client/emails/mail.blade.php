<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi biểu mẫu liên hệ</title>
    <style>
        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>Xin chào Elegant Home</h3>
            <p>Bạn nhận được 1 liên hệ mới từ website của bạn</p>
        </div>
        <table class="content">
            <p><span class="label">Tên:</span> {{ $formData['firstname'] }}</p>
            <p><span class="label">Họ:</span> {{ $formData['lastname'] }}</p>
            <p><span class="label">Số điện thoại:</span> {{ $formData['number'] }}</p>
            <p><span class="label">Email:</span> {{ $formData['email'] }}</p>
            <p><span class="label">Tin nhắn:</span></p>
            <p>{{ $formData['message'] }}</p>
        </table>
    </div>
</body>

</html>
