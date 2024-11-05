@extends('client.layouts.master')
@section('content')
<section class="page-title">
    <div class="auto-container">
        <h2>Login Page</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li>Pages</li>
            <li>Register</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Register Section -->
<div class="register-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <!-- Column -->
                {{-- <div class="column col-lg-6 col-md-12 col-sm-12">
                    <!-- Login Form -->
                    <div class="styled-form">
                        <h4>Sign Up</h4>
                        <form method="post" action="https://html.themexriver.com/bloxic/index.html">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" name="username" value="" placeholder="Enter your name*" required>
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="emaill" value="" placeholder="Enter Email Adress" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" value="" placeholder="Create password" required>
                            </div>
                            <div class="form-group">
                                <div class="check-box">
                                    <input type="checkbox" name="remember-password" id="type-1">
                                    <label for="type-1">I agree to al <a href="#">Terms</a> & <a href="#">Condition</a> and Feeds</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="theme-btn btn-style-one">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">
                    <!-- Login Form -->
                    <div class="styled-form">
                        <h4>Login here</h4>
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Adress">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" value="" placeholder="Create password">
                            </div>
                            <div class="form-group">
                                <div class="check-box">
                                    <input type="checkbox" name="remember-password" id="type-2">
                                    <label for="type-2">Remember Me?</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-style-one">
                                    Login here
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
