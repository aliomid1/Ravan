<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پنل کاربر | @yield('title')
    </title>
    <!-- begin::global styles -->
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" type="text/css">
    @yield('style')
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{ asset('vendor/media/image/favicon.png') }}">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#ff7300" />
    <!-- end::theme color -->

</head>

<style>
    nav.navbar {
        background-color: #ff7300;
        z-index: 1001;
    }

    .entry-link {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .side-menu>.side-menu-body>ul li a,
    .side-menu>.container>.side-menu-body>ul li a,
    .side-menu>.container-fluid>.side-menu-body>ul li a {
        padding: 8px 21px;
    }

    .side-menu {
        width: 260px;
    }

    .modal .modal-dialog .modal-content .modal-header button.close {
        outline: none;
    }

    ::placeholder {
        opacity: 0.4 !important;
    }

</style>

<body>
    @include('components.messages.Alert')
    <!-- begin::page loader-->
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>


    <!-- begin::main content -->
    <main class="main-content">
        @yield('content')
    </main>
    <!-- end::main content -->


    <!-- begin::global scripts -->
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <!-- end::global scripts -->

    <!-- begin::custom scripts -->
    {{-- <script src="{{ asset('vendor/js/custom.js') }}"></script> --}}
    <script src="{{ asset('vendor/js/app.js') }}"></script>
    <script src="{{ asset('assets/lib/message.js') }}"></script>
    <script src="{{ asset('assets/lib/chat.js') }}"></script>

    <!-- end::custom scripts -->
    @yield('js')

</body>

</html>
