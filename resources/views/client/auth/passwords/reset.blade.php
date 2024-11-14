@extends('client.layouts.master')
@section('content')
    <section class="page-title">
        <div class="auto-container">
            <h2>Login Page</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>EmailReset</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Register Section -->
    <div class="register-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <div class="column col-lg-6 col-md-12 col-sm-12">
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
                        <div class="styled-form">
                            <h4>Email</h4>
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ request('email') }}" placeholder="Enter your email" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter Password" required>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one">Send</button>
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
