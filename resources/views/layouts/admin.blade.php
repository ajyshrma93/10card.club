<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="allprice">
    <meta name="keywords" content="allprice">
    <meta name="author" content="allprice">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/admin/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.png')}}" type="image/x-icon">
    <title>10Card</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/fontawesome.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/flag-icons-main/css/flag-icons.min.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/datatables.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/lightbox.min.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/admin/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/scss/components/_print.scss')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/custom.css')}}">
    <style>
        .page-wrapper .page-body-wrapper .page-title {
            padding: 15px 30px;
            margin: 0 -27px 30px;
            background-color: #fff;
            border-bottom: 1px solid #D9D9E1;
            -webkit-box-shadow: 0px 4px 40px rgb(0 0 0 / 7%);
            box-shadow: 0px 4px 40px rgb(0 0 0 / 7%);
        }
    </style>
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.partials.admin-header')
        <!-- Page Header Ends -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.partials.admin-sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">

                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2022 © allprice </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>


    <script src="{{asset('assets/admin/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/admin/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/admin/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('assets/admin/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('assets/admin/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/admin/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/admin/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/admin/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/admin/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/sweet-alert/app.js')}}"></script>
    <script src="{{asset('assets/admin/js/lightbox.min.js')}}"></script>
    <!-- <script src="{{asset('assets/admin/js/tooltip-init.js')}}"></script> -->

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/admin/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    @yield('scripts')
    <form id="logout-form" action="{{ route('user_logout') }}" method="GET" class="d-none">
        @csrf
    </form>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
