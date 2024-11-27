@extends('client.layouts.master')
@section('title')
    Reset password
@endsection
@section('content')
    <!-- Register Section -->
    <div class="register-section mt-5">
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
                        <div class="text-center mb-0">
                            <img src="https://account.cellphones.com.vn/_nuxt/img/Shipper_CPS3.77d4065.png" width="150px">
                        </div>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('password.update') }}" method="POST" class="w-50 mt-3">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ request('email') }}" placeholder="Enter your email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Password" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Send</button>
                                </div>
                            </form>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
