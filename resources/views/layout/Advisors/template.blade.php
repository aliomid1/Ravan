<!DOCTYPE html>
<html lang="fa">
    @php
    $settings = \App\Models\Settings::first();
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ env('SiteBrand') }} | پنل مشاور | @yield('title')
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
    <link rel="shortcut icon" href="{{asset($settings->logo)}}" type="image/x-icon">
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

    ::placeholder {
        opacity: 0.4 !important;
    }

    @media (max-width: 576px) {
        .p-50 {
            padding: 19px !important;
        }
    }

    #toast-container>.toast-warning {
        background: #ffd828 !important;
        background-repeat: no-repeat;
        color: black;
    }

    #toast-container>.toast-success {
        background: #00c241 !important;
        color: rgb(255, 255, 255);
    }

    .entry-link {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

</style>


<body>
    @include('components.messages.Alert')
    <!-- begin::page loader-->
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>
    <!-- end::page loader -->

    <!-- begin::sidebar -->
    <div class="sidebar">
        <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">

        </ul>
        <div class="tab-content" id="pills-tabContent">
        </div>
    </div>
    <!-- end::sidebar -->


    <!-- begin::side menu -->
    <div class="side-menu">
        <div class="side-menu-body">
            <ul>
                <li class="side-menu-divider">فهرست</li>
                <li><a href="{{ route('Advisors.Dashboard') }}"><i class="icon ti-home"></i> <span>داشبورد</span> </a>
                </li>
                <li><a href="{{ route('Advisors.Profile') }}"><i class="icon ti-user"></i> <span>پروفایل</span> </a>
                </li>
                <li><a href="{{ route('Advisors.SetAdvisesTime') }}"><i class="icon ti-timer"></i> <span>زمان های شما
                            برای مشاوره</span> </a></li>
                <li><a href="{{ route('Advisors.NowAdviced') }}"><i class="icon ti-clipboard"></i> <span>تاریخچه مشاوره
                            ها</span> </a></li>
                <li><a href="{{ route('Advisors.FuturistAdvice') }}"><i class="icon ti-clipboard"></i> <span>نوبت های
                            رزرو شده</span> </a></li>
                <li><a href="{{ route('Advisors.Chats') }}"><i class="icon ti-rocket"></i> <span>مشاور های انلاین</span>
                    </a></li>
                <li><a href="{{ route('Advisors.Transactions') }}"><i class="icon ti-wallet"></i> <span>اطلاعات
                            مالی</span> </a></li>
                <li><a href="{{ route('Advisors.BuyPlan') }}"><i class="icon ti-crown"></i> <span>پلن های VIP</span>
                    </a></li>
                <li><a href="{{ route('Advisors.Support') }}"><i class="icon ti-comment"></i> <span>تماس با
                            پشتیبانی</span> </a></li>
                <li><a href="{{ route('Logout') }}"><i class="icon ti-power-off"></i> <span>خروج</span> </a></li>
        </div>
    </div>
    <!-- end::side menu -->


    <!-- begin::navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="header-logo">
                <a href="{{ route('Web.index') }}">
                    <img src="{{asset($settings->logo)}}" alt="...">
                    <span class="logo-text d-none d-lg-block"> {{ env('SiteBrand') }} </span>
                </a>
            </div>
            <div class="header-body" style="justify-content: flex-end">

                <form method="post">
                    @csrf
                    <ul class="navbar-nav">

                        <li class="nav-item ">
                            <p data-url="{{ route('Advisors.UnsetOnline') }}"
                                class="ml-3 mb-0 rounded-lg btn Online {{ Auth::guard('advisor')->user()->status == '0' ? 'btn-success' : 'btn-warning' }} ">
                                در حال استراحت هستم
                            </p>
                        </li>
                        <li class="nav-item ">
                            <p data-url="{{ route('Advisors.SetOnline') }}"
                                class="ml-3 mb-0 rounded-lg btn Online {{ Auth::guard('advisor')->user()->status == '0' ? 'btn-warning' : 'btn-success' }} ">
                                آنلاین هستم
                            </p>
                        </li>
                        @php
                        $Advisor_id = Auth::guard('advisor')->User()->id;
                        $Advisor_Image = \App\Models\Image::where('item_id' , $Advisor_id)->where('type' ,
                        'profile_advisor')->first();
                        @endphp
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown">
                                <figure
                                    class="avatar avatar-sm {{ Auth::guard('advisor')->user()->status == '1' ? 'avatar-state-success' : '' }}">
                                    <img class="rounded-circle advisor_profile"
                                        src="{{ $Advisor_Image ? asset($Advisor_Image->url) : asset('assets/avatar.jpg') }}"
                                        alt="...">
                                </figure>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('Advisors.Profile') }}" class="dropdown-item">پروفایل</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('Logout') }}" class="text-danger dropdown-item">خروج</a>
                            </div>
                        </li>
                        <li class="nav-item d-lg-none d-sm-block">
                            <a href="#" class="nav-link side-menu-open">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                    </ul>
                </form>
            </div>

        </div>
    </nav>
    <!-- end::navbar -->


    <!-- begin::main content -->
    <main class="main-content">
        @yield('content')
    </main>
    <!-- end::main content -->


    <!-- begin::global scripts -->
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <!-- end::global scripts -->

    <!-- begin::custom scripts -->
    {{-- <script src="{{ asset('vendor/js/custom.js') }}"></script>
    --}}
    <script src="{{ asset('vendor/js/app.js') }}"></script>
    <script src="{{ asset('assets/lib/message.js') }}"></script>
    <script src="{{ asset('assets/Web/js/custom.js') }}"></script>
    <!-- end::custom scripts -->
    @yield('js')

</body>

</html>
