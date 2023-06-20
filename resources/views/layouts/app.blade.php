<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fav Icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('user/assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('user/assets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/responsive.css') }}" rel="stylesheet">
    @yield('css')
      <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">

        @include('layouts.navbar')

        @include('layouts.pageTitle')

        <!-- sidebar-page-container -->
        <section class="sidebar-page-container blog-details sec-pad-2">
            <div class="auto-container">
                <div class="row clearfix">

                    @include('layouts.aside')
                    @yield('user')

                </div>
            </div>
        </section>
        <!-- sidebar-page-container -->

        @include('layouts.footer')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('user/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('user/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/owl.js') }}"></script>
    <script src="{{ asset('user/assets/js/wow.js') }}"></script>
    <script src="{{ asset('user/assets/js/validation.js') }}"></script>
    <script src="{{ asset('user/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('user/assets/js/appear.js') }}"></script>
    <script src="{{ asset('user/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('user/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('user/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('user/assets/js/product-filter.js') }}"></script>

    <!-- main-js -->
    <script src="{{ asset('user/assets/js/script.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;

                default:
                    break;
            }
        @endif
    </script>
    @yield('js')
</body><!-- End of .page_wrapper -->

</html>
