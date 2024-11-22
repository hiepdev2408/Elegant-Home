@extends('client.layouts.master')
@section('title')
    Order
@endsection
@section('content')
<section class="page-title">
    <div class="auto-container">
        <h2>Shop Page</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li>Pages</li>
            <li>Checkout</li>
        </ul>
    </div>
</section>
<!-- Checkout Section -->
<section class="checkout-section">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Form Column -->
            <div class="form-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h4>Delivery Information</h4>
                    <!-- Shipping Form -->
                    <div class="shipping-form">
                        <form method="post" action="{{ route('checkout') }}">
                            @csrf
                            <div class="row clearfix">
                                @if (Auth::check())
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name_person" value="{{ Auth::user()->name}}" required="" readonly>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email_person" value="{{ Auth::user()->email}}" required="" readonly>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone"  required="" value="{{ Auth::user()->phone}}" readonly>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address_person"  required="" value="{{ Auth::user()->address}}" readonly>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="">Current Address</label>
                                    <input type="text" name="current_address" required placeholder="Nhập địa chỉ cụ thể của bạn" value="{{ old('current_address') }}">
                                </div>
                                @else
                                <p>Vui lòng đăng nhập để tiếp tục.</p>
                                @endif
                               
                                
                               
                                
                            </div>
                        </form>
                    </div>
                    <!-- End Shipping Form -->
                    
                </div>
            </div>
            
            <!-- Order Column -->
            <div class="order-column col-lg-4 col-md-12 col-sm-12">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="inner-column">
                    <h4>Order Summery</h4>
                    <!-- Order Box -->
                    <div class="order-box">
                        <ul class="order-totals">                       
                            <li>Subtotal<span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span></li>                         
                            <li>Shipping Fee<span>0VNĐ</span></li>
                        </ul>
                        
                        <!-- Voucher Box -->
                        <div class="voucher-box">
                            <form method="post" action="{{ route('order.applyVoucher') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="voucher_code" value="" placeholder="Enter voucher Code" required>
                                    <button type="submit" class="theme-btn apply-btn">Apply code</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Order Total -->
                        <div class="order-total">Total  
                            <span>{{ number_format(session('totalAmount', $totalAmount), 0, ',', '.') }} VNĐ</span>
                            </div>
                        
                            <div class="button-box">
                                <form method="post" action="{{ route('checkout') }}">
                                    @csrf
                                    <input type="hidden" name="current_address" value="{{ old('current_address') }}">
                                    <button type="submit" class="theme-btn pay-btn">Proceed to pay</button>
                                </form>
                            </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- End Checkout Section -->

@endsection
@section('script-libs')
    <script>
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            if (replyForm.style.display === "none") {
                replyForm.style.display = "block";
            } else {
                replyForm.style.display = "none";
            }
        }
    </script>
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    <script src="{{ asset('themes/client/assets/js/plugins/swiper-bundle.min.js') }}" defer="defer"></script>
    <script src="{{ asset('themes/client/assets/js/plugins/glightbox.min.js') }}" defer="defer"></script>

    <!-- Customscript js -->
    <script src="{{ asset('themes/client/assets/js/script.js') }}" defer="defer"></script>
@endsection
