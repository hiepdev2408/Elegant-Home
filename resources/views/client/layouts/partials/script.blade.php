<script src="{{ asset('themes') }}/clients/js/jquery.js"></script>
<script src="{{ asset('themes') }}/clients/js/popper.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/bootstrap.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/magnific-popup.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/appear.js"></script>
<script src="{{ asset('themes') }}/clients/js/parallax.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/tilt.jquery.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/jquery.paroller.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/owl.js"></script>
<script src="{{ asset('themes') }}/clients/js/wow.js"></script>
<script src="{{ asset('themes') }}/clients/js/swiper.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/touchspin.js"></script>
<script src="{{ asset('themes') }}/clients/js/odometer.js"></script>
<script src="{{ asset('themes') }}/clients/js/mixitup.js"></script>
<script src="{{ asset('themes') }}/clients/js/backToTop.js"></script>
<script src="{{ asset('themes') }}/clients/js/jquery.marquee.min.js"></script>
<script src="{{ asset('themes') }}/clients/js/nav-tool.js"></script>
<script src="{{ asset('themes') }}/clients/js/jquery-ui.js"></script>
<script src="{{ asset('themes') }}/clients/js/script.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top'
            },
            ripple: true,
        });

        @if (session('success'))
            notyf.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            notyf.error('{{ session('error') }}');
        @endif
    });
</script>
