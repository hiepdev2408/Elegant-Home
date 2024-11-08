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

            <h3>Hi:{{$account->name}}</h3>
           <a href="{{route('veryfy',$account->email)}}">Nhấn vào đây để xác nhận tài khoản</a>
        </div>
    </div>
</body>

</html>
