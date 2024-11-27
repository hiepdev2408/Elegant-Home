@extends('client.layouts.master')
@section('title')
    Forgot password
@endsection
@section('content')
    <!-- Register Section -->
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
    </div>
@endsection
