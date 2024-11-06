@extends('client.layouts.master')
@section('content')
    <div class="page-wrapper">



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
                                        <strong>Địa chỉ Email</strong>
                                        <a href="mailto:prinox@gmail.com">elegant-home@gmail.com</a><br>
                                        <a href="0392815392">0392815392</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="info-box">
                                <div class="box-inner d-flex align-items-center">
                                    <div class="icon flaticon-map"></div>
                                    <div class="content">
                                        <strong>Địa chỉ</strong>
                                        <div class="text">Cao đẳng FPT</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="info-box">
                                <div class="box-inner d-flex align-items-center">
                                    <div class="icon flaticon-call"></div>
                                    <div class="content">
                                        <strong>Số điện thoại</strong>
                                        <a href="tel:+880-123-456-789">0392815392</a><br>
                                        <a href="tel:+9987574">1131545151</a>
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
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639311820666!2d105.74468687503176!3d21.03812978061353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1730813929997!5m2!1svi!2s"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Boxed -->
                <div class="contact-boxed">
                    <!-- Title Box -->
                    <div class="title-box">
                        <h3>Liên hệ</h3>
                        <div class="text">Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu*
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form">
                        <form method="post"action="{{ route('contact.submit') }}" id="contact-form">
                            @csrf
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="first_name" placeholder="Tên của bạn" required="">
                                    @if ($errors->has('first_name'))
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="last_name" placeholder="Họ của bạn" required="">
                                    @if ($errors->has('last_name'))
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="email" placeholder="Email của bản*" required="">
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="phone_number" placeholder="Số điện thoại của bạn"
                                        required="">
                                    @if ($errors->has('phone_number'))
                                        <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea class="" name="message" placeholder="Viết tin nhắn..."></textarea>
                                    @if ($errors->has('message'))
                                        <small class="text-danger">{{ $errors->first('message') }}</small>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="buttons-box">
                                        <button class="theme-btn btn-style-one">
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
        <!-- End Gallery Section -->



    </div>
    <!-- End PageWrapper -->
@endsection
