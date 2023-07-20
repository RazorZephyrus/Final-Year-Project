<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

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
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

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
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                {{-- <span class="app-brand-text demo text-body fw-bolder">CMS</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Selamat Datang, <br/><a href="{{ url('/') }}">Book It! 👋</a></h4>

                        @include('components.alert.error', ['error' => $errors])
                        {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    {{-- <a href="#">
                                        <small>Forgot Password?</small>
                                    </a> --}}
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                            <hr>
                            <small>Belum memiliki akun ? <a href="{{ route('register') }}">Register</a></small>
                        </form>

                        {{-- @error($error_field ?? $field)
                            <span class="app-invalid-feedback invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}

                        {{-- <p class="text-center">
                            <a href="{{ route('login_staf') }}">
                                <span>Login Staff</span>
                            </a>
                        </p> --}}
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

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

</body>

</html>
