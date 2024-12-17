@extends('client.layouts.master')
@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Left Section: Profile Image and Basic Info -->
             <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <div class="text-center">
                    @if (Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="User Avatar"
                             class="rounded-circle mb-3 profile-img">
                    @else
                        <img src="{{ asset('themes/image/logo.jpg') }}" alt="Default Logo"
                             class="rounded-circle mb-3 profile-img">
                    @endif
                    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->role->name ?? 'Member' }}</p>
                </div>
                <hr>
                <ul class="list-unstyled">
                    <li><strong>Số điện thoại:</strong> {{ Auth::user()->phone ?? 'N/A' }}</li>
                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li><strong>Ngày gia nhập:</strong> {{ Auth::user()->created_at->format('d M Y') }}</li>
                </ul>
            </div>
        </div>
           

            <!-- Right Section: Detailed Data -->
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-4">Thông tin cá nhân</h4>
                   
                    <div class="mb-3">
                        <label for="email" class="form-label">Địa chỉ email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="Address_all">Địa chỉ chi tiết</label>
                        @if (Auth::user()->ward && Auth::user()->district && Auth::user()->province)
                            <input type="text" class="form-control"
                                value="{{ Auth::user()->ward->name . ', ' . Auth::user()->district->name . ', ' . Auth::user()->province->name }}"
                                disabled>
                        @else
                            <input type="text" class="form-control" placeholder="Thông tin chi tiết" disabled>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control"
                            value="{{ Auth::user()->address ?? '' }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="{{ Auth::user()->phone ?? '' }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter new password" value="{{ Auth::user()->password }}" disabled>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('profile.info.showProfile', Auth::user()->id) }}" class="btn btn-outline-primary">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        /* Profile Image */
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            background-color: #ffffff;
        }

        /* Left Section: Info List */
        .card ul li {
            margin-bottom: 10px;
            font-size: 0.95rem;
            color: #555;
        }

        /* Form Labels and Inputs */
        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Buttons */
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
