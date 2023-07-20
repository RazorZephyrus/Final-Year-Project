<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{config('app.name')}}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/default/langsa/logo-dark.png') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    {{-- Custom CSS Already --}}
    {{-- <style>
        .text-primary {
            color: #f00000 !important;
        }

        .bg-label-primary {
            background-color: #fb0101 !important;
            color: #ffffff !important;
        }

        a {
            color: #ff6969;
        }

        .bg-menu-theme .menu-inner>.menu-item.active>.menu-link {
            color: #ffffff;
            background-color: rgb(242 7 7 / 79%) !important;
        }

        .bg-menu-theme .menu-inner>.menu-item.active:before {
            background: #fb0201;
        }

        .btn-primary {
            color: #fff;
            background-color: #f00000;
            border-color: #f00000;
            box-shadow: 0 0.125rem 0.25rem 0 rgb(105 108 255 / 40%);
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #ff6969;
            border-color: #ff6969;
            box-shadow: 0 0.125rem 0.25rem 0 rgb(105 108 255 / 40%);
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #f00000;
            color: #fff;
            box-shadow: 0 2px 4px 0 rgb(105 108 255 / 40%);
        }

        .page-item.active .page-link,
        .page-item.active .page-link:hover,
        .page-item.active .page-link:focus,
        .pagination li.active>a:not(.page-link),
        .pagination li.active>a:not(.page-link):hover,
        .pagination li.active>a:not(.page-link):focus {
            border-color: #f00000;
            background-color: #f00000;
            color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgb(105 108 255 / 40%);
        }

        .bg-menu-theme .menu-sub>.menu-item.active>.menu-link:not(.menu-toggle):before {
            background-color: #f00000 !important;
            border: 3px solid #e7e7ff !important;
        }
    </style> --}}

    @yield('style')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <script type="text/javascript">
        function callbackThen(response){
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data){
                console.log(data);
            });
        }
        function callbackCatch(error){
            console.error('Error:', error)
        }
    </script>

    {{-- {!! htmlScriptTagJsApi([
        'action' => 'homepage',
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
    ]) !!} --}}

</head>
