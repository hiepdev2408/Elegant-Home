@extends('client.layouts.master')
@section('title')
    Liên Hệ
@endsection
@section('content')
    <!-- End contact section -->

    <!-- Start contact map area -->
    <section class="page-title">
        <div class="auto-container">
            <h2>Contact Us</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Contact Page Section -->
    <div class="contact-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">

                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="box-inner d-flex align-items-center">
                                <div class="icon flaticon-email-1"></div>
                                <div class="content">
                                    <strong>Mail address</strong>
                                    <a href="mailto:prinox@gmail.com">ElegantHome@gmail.com</a><br>
                                    <a href="tel:+998757478492">+0368309192</a>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="box-inner d-flex align-items-center">
                                <div class="icon flaticon-map"></div>
                                <div class="content">
                                    <strong>Office address</strong>
                                    <div class="text">Bắc Từ Liêm,Hà Nội</div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="box-inner d-flex align-items-center">
                                <div class="icon flaticon-call"></div>
                                <div class="content">
                                    <strong>Phone Number</strong>
                                    <a href="tel:+880-123-456-789">+0368309192</a><br>
                                    <a href="tel:+9987574">+096830999</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Map Column -->
                <div class="map-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!--Map Outer-->
                        <div class="map-outer">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14896.072099727793!2d105.75039533952248!3d21.03196476820802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c7521d2d91%3A0xba6cdc3e1406ddfe!2zQ2F1IERpZW4sIFThu6sgTGnDqm0sIEhhbm9pLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1730811182044!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Boxed -->
            <div class="contact-boxed">
                <!-- Title Box -->
                <div class="title-box">
                    <h3>Drop Us a Line</h3>
                    <div class="text">Your email address will not be published. Required fields are marked *</div>
                </div>
                <div class="col-lg-7">
                    <style>
                        .alert {
                            padding: 15px;
                            margin: 20px 0;
                            border: 1px solid transparent;
                            border-radius: 4px;
                        }

                        .alert-success {
                            color: #155724;
                            background-color: #d4edda;
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

                    @if (session()->has('success'))
                        <div class="alert alert-success fw-bold">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <!-- Contact Form -->
                    <div class="contact-form">
                        <form method="post" action="{{ route('contact.submit') }}" method="POST" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input class="contact__form--input" name="first_name" id="input1"
                                        placeholder="Tên của bạn *" type="text">
                                    @if ($errors->has('first_name'))
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input class="contact__form--input" name="last_name" id="input2"
                                        placeholder="Họ của bạn *" type="text">
                                    @if ($errors->has('last_name'))
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    @endif
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">

                                    <input class="contact__form--input" name="phone_number" id="input3"
                                        placeholder="Số điện thoại" type="text">
                                    @if ($errors->has('phone_number'))
                                        <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input class="contact__form--input" name="email" id="input4" placeholder="Email *"
                                        type="email">
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea class="contact__form--textarea" name="message" id="input5" placeholder="Viết tin nhắn của bạn *"></textarea>
                                    @if ($errors->has('message'))
                                        <small class="text-danger">{{ $errors->first('message') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="buttons-box">
                                        <button class="theme-btn btn-style-one" type="submit">
                                            Gửi Tin Nhắn
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- End Contact Form -->

                </div>
                <!-- End Contact Boxed -->

            </div>
        </div>
        <!-- End Contact Page Section -->

        <!-- Gallery Section -->
        <section class="gallery-section">
            <div class="outer-container">
                <div class="instagram-carousel owl-carousel owl-theme">

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/1.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/2.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/3.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/3.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/4.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/4.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/5.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/5.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <!-- Insta Gallery -->
                    <div class="insta-gallery">
                        <img src="images/gallery/6.jpg" alt="" />
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <a class="lightbox-image icon flaticon-instagram" href="images/gallery/6.jpg"></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endsection
