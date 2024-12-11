@extends('client.layouts.master')
@section('title')
    Quên mật khẩu
@endsection
@section('content')
    <div class="limiter">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container-login90">

            <div class="wrap-login100s">
                <div class="login100-pic d-flex justify-items-center align-items-center">
                    <div>
                        <img src="{{ asset('themes') }}/clients/images/auth/team.jpg">
                    </div>
                </div>
                <form action="{{ route('password.email') }}" method="post" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title">
                        <b>QUÊN MẬT KHẨU</b>
                    </span>
                    <form action="#">
                        <div class="wrap-input100 validate-input mt-3">
                            <input class="input100" type="email" name="email" id="email" placeholder="Email"
                                value="{{ old('email') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-envelope'></i>
                            </span>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="container-login100-form-btn">
                            <input type="submit" value="Gửi">
                        </div>
                    </form>
                    <div class="text-center p-t-70 txt2 mt-3">
                        Phần mềm quản lý bán hàng <i class="fa fa-copyright" aria-hidden="true"></i>
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script> code bởi Elegant
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <!-- Register Section -->
    <div class="register-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <div class="column col-lg-12 col-md-12 col-sm-12">
                        <style>
                            .alert {
                                padding: 15px;
                                margin: 20px 0;
                                border: 1px solid transparent;
                                border-radius: 4px;
                            }

                            .alert-red {
                                color: #cd2228;
                                background-color: #e1aeb9;
                                border-color: #c3e6cb;
                            }

                            .fw-bold {
                                font-weight: bold;
                            }

                            .text-danger {
                                color: red;
                                font-weight: bold;
                            }
                        </style>
                        <!-- Login Form -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center mb-3">
                            <img src="https://account.cellphones.com.vn/_nuxt/img/Shipper_CPS3.77d4065.png" width="150px">
                        </div>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('password.email') }}" method="POST" class="w-50 mb-5">
                                @csrf
                                <div class="mb-3">
                                    <label>Email address</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter Email Address" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('style-libs')
    <link rel="stylesheet" href="{{ asset('themes') }}/clients/css/auth.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
@endsection
@section('script-libs')
    <script src="{{ asset('themes') }}/clients/js/auth.js"></script>
@endsection
