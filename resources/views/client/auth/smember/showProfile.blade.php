@extends('client.layouts.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg p-4">
                <h4 class="text-center text-primary fw-bold mb-4">Cập nhật thông tin khách hàng</h4>
                <form action="{{ route('profile.info.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Địa chỉ Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    @csrf
                    <!-- Các trường thông tin khác -->
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Ảnh cá nhân</label>
                        <input type="file" id="avatar" name="avatar" class="form-control">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" width="150px" alt="">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Tỉnh/Thành phố</label>
                        <select name="province_id" id="province" class="form-select">
                            <option value="">Chọn Tỉnh/Thành phố</option>
                            @foreach ($provinces as $code => $name)
                                <option @selected($user->province && $user->province->code == $code) value="{{ $code }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">Quận/Huyện</label>
                        <select name="district_id" id="district" class="form-select" @if (!$user->district) disabled @endif>
                            <option value="">Chọn Quận/Huyện</option>
                            @if ($districts)
                                @foreach ($districts as $id => $name)
                                    <option @selected($user->district && $user->district->id == $id) value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ward" class="form-label">Xã/Phường</label>
                        <select name="ward_id" id="ward" class="form-select" @if (!$user->ward) disabled @endif>
                            <option value="">Chọn Xã/Phường</option>
                            @if ($wards)
                                @foreach ($wards as $code => $name)
                                    <option value="{{ $code }}" @selected($user->ward?->code == $code)>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="text-end"><button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load Districts on Province Change
            $('#province').on('change', function() {
                let provinceCode = $(this).val();
                if (provinceCode) {
                    $.ajax({
                        url: '/districts/' + provinceCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district').empty().append('<option value="">Chọn Quận/Huyện</option>');
                            $.each(data, function(code, name) {
                                $('#district').append('<option value="' + code + '">' + name + '</option>');
                            });
                            $('#district').prop('disabled', false);
                            $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>').prop('disabled', true);
                        }
                    });
                } else {
                    $('#district').empty().append('<option value="">Chọn Quận/Huyện</option>').prop('disabled', true);
                    $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>').prop('disabled', true);
                }
            });

            // Load Wards on District Change
            $('#district').on('change', function() {
                let districtCode = $(this).val();
                if (districtCode) {
                    $.ajax({
                        url: '/wards/' + districtCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>');
                            $.each(data, function(code, name) {
                                $('#ward').append('<option value="' + code + '">' + name + '</option>');
                            });
                            $('#ward').prop('disabled', false);
                        }
                    });
                } else {
                    $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>').prop('disabled', true);
                }
            });
        });
    </script>
@endsection

@section('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            background-color: #ffffff;
        }

        .form-label {
            font-weight: bold;
            color: #343a40;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
