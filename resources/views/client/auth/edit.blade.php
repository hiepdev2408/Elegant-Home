@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 20px
        }
        .form-control-file {
            margin-top: 10px; /* Khoảng cách cho file input */
        }.form-group{
            font-size: 35px;
        }.form-group input{
            font-size: 20px;
        }.lol button{
            font-size: 15px;
        }.lol a{
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4">Sửa Thông Tin Người Dùng</h1>

            @if(session('success'))
                <div class="alert alert-success h2">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name" class="h2">Tên:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="h2">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone" class="h2">Số Điện Thoại:</label>
                    <input type="text" class="form-control " id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="form-group">
                    <label for="address" class="h2" >Địa Chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                </div>  
                <div class="form-group">
                    <label for="avatar">Ảnh Đại Diện:</label>
                    <input type="file" name="avatar" class="form-control-file" id="avatar">
                </div>
                </div>
                <div class="lol">
                <button type="submit" class="btn btn-primary ">Cập nhật</button>
                <a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary">Quay lại</a>
            </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

@endsection
