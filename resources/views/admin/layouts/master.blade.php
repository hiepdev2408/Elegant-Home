<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-bordered" data-assets-path="{{ asset('themes') }}/admin/"
    data-template="vertical-menu-template-bordered">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Elegant Home | @yield('title')
    </title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords"
        content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('themes') }}/admin/img/logo/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/css/rtl/theme-bordered.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    @yield('style-libs')
    <style>
        .swal2-container {
            z-index: 9999 !important;
        }
    </style>
    <!-- Helpers -->
    <script src="{{ asset('themes') }}/admin/vendor/js/helpers.js"></script>
    <script src="{{ asset('themes') }}/admin/js/config.js"></script>


</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            @include('admin.layouts.partials.menu')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->

                @include('admin.layouts.partials.navBar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    @yield('content')

                    <!-- / Content -->

                    <!-- Footer -->

                    @include('admin.layouts.partials.footer')

                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('themes') }}/admin/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('themes') }}/admin/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('themes') }}/admin/js/main.js"></script>


    <!-- Page JS -->

    @yield('script-libs') <!-- CÁC JS CÁC TRANG -->
    

</body>

</html>
