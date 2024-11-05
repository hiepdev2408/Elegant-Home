<!DOCTYPE html>
<html>

<!-- Mirrored from html.themexriver.com/bloxic/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 16:37:55 GMT -->

<head>
    <meta charset="utf-8">
    <title>Elegant Home | @yield('title')</title>
    <!-- Stylesheets -->
    @include('client.layouts.partials.style')

    @yield('style-libs')
    @yield('style')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>

    <div class="page-wrapper">
        <header class="main-header">
            @include('client.layouts.partials.header')
        </header>

        @include('client.layouts.partials.extra')

        <div class="container-fluid">
            @yield('content')
        </div>

        @include('client.layouts.partials.footer')

    </div>
    <!-- End PageWrapper -->

    <!-- Search Popup -->
    <div class="search-popup">
        <div class="color-layer"></div>
        <button class="close-search"><span class="fa fa-arrow-up"></span></button>
        <form method="post" action="https://html.themexriver.com/bloxic/blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here"
                    required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Search Popup -->

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

    @include('client.layouts.partials.script')

    @yield('script-libs')
    @yield('script')
</body>

<!-- Mirrored from html.themexriver.com/bloxic/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 16:38:06 GMT -->

</html>
