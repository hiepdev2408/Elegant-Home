<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Elegant Home | @yield('title')</title>
    <!-- Stylesheets -->

    @include('client.layouts.partials.style')
    @include('client.layouts.partials.fonts.font')
    <link rel="shortcut icon" href="{{ asset('themes') }}/clients/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('themes') }}/clients/images/favicon.png" type="image/x-icon">

    @yield('style')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>

    <div class="page-wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @include('client.layouts.partials.header')
        </header>
        <!-- End Main Header -->

        <!-- Sidebar Cart Item -->
        @include('client.layouts.partials.extra')
        <!-- END sidebar widget item -->

        @yield('content')

        <!-- Main Footer -->
        @include('client.layouts.partials.footer')

        <!-- End Main Footer -->

    </div>
    <!-- End PageWrapper -->

    <!-- Search Popup -->
    <div class="search-popup">
        <div class="color-layer"></div>
        <button class="close-search"><span class="fa fa-arrow-up"></span></button>
        <form method="post" action="https://html.themexriver.com/bloxic/blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Search Popup -->

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

    @include('client.layouts.partials.script')
    @yield('script')
</body>

</html>
