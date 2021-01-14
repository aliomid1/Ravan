<!DOCTYPE html>
<html lang="fa">
@php
$settings = \App\Models\Settings::first();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('SiteBrand') }} | پنل کاربر | @yield('title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" type="text/css">
    @yield('style')
    <link rel="shortcut icon" href="{{ asset($settings->logo) }}" type="image/x-icon">
    <meta name="theme-color" content="#ff7300" />
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
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>

    <div class="sidebar">
        <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">

        </ul>
        <div class="tab-content" id="pills-tabContent">

        </div>
    </div>
    <div class="side-menu">
        <div class="side-menu-body">
            <ul>
                <li class="side-menu-divider">فهرست</li>
                <li><a href="{{ route('Users.Dashboard') }}"><i class="icon ti-home"></i> <span>داشبورد</span> </a></li>
                <li><a href="{{ route('Users.Profile') }}"><i class="icon ti-bookmark-alt"></i> <span>پروفایل</span>
                    </a></li>
                <li><a href="{{ route('Users.Share') }}" data-toggle="modal" data-target="#ShareModal"><i
                            class="icon ti-heart"></i>
                        <span>دریافت اعتبار با دعوت از دوستان</span> </a></li>
                <li><a href="{{ route('Users.NowAdviced') }}"><i class="icon ti-clipboard"></i> <span>تاریخچه مشاوره
                            ها</span> </a></li>
                <li><a href="{{ route('Users.FuturistAdvice') }}"><i class="icon ti-clipboard"></i> <span>نوبت های رزرو
                            شده</span> </a></li>
                <li><a href="{{ route('Users.Chats') }}"><i class="icon ti-comment"></i> <span>گفتگو های انلاین</span>
                    </a></li>
                <li><a href="{{ route('Users.Transactions') }}"><i class="icon ti-wallet"></i> <span>اطلاعات مالی</span>
                    </a></li>
                <li><a href="{{ route('Users.Support') }}"><i class="icon ti-support"></i> <span>تماس با پشتیبانی</span>
                    </a></li>
                <li><a href="#" data-toggle="modal" data-target="#QuestionModal"><i class="icon ti-help"></i>
                        <span>چطور از {{ env('SiteBrand') }} استفاده کنم؟</span> </a></li>
                <li><a href="#" data-toggle="modal" data-target="#Question1Modal"><i class="icon ti-info"></i>
                        <span>چرا به {{ env('SiteBrand') }} اعتماد کنم؟</span> </a></li>
                <li><a href="{{ route('Web.ConsultantList') }}"><i class="icon ti-clipboard"></i> <span>ليست
                            مشاوران</span> </a></li>
                <li><a href="{{ route('Logout') }}"><i class="icon ti-power-off"></i> <span>خروج</span> </a></li>
        </div>
    </div>
    <div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">دعوت از دوستان</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"> {{ env('SiteBrand') }} را به هر یک از دوستان خود معرفی کنید، با ورود هر
                        یک از دوستان تان، از {{ $settings->gift_default }} تومان اعتبار رایگان استفاده کنید.
                    </h5>
                </div>
                <form class="col" action="{{ route('Users.Share') }}" method="POST">
                    @csrf
                    <h6 class="text-center">لطفا شماره موبایل شخصی که میخواهید « {{ env('SiteBrand') }} » ر ابه او معرفی
                        کنید، وارد نمایید (این پیام برای شما هیچ هزینه ای ندارد)
                    </h6>
                    <input type="text" name="mobile" class="form-group form-control col-sm-8 mx-auto">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                        </button>
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="QuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">چطور از {{ env('SiteBrand') }} استفاده کنم؟
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-success custom-accordion">
                                @forelse (App\Models\Question::where('type' , 'how')->get() as $item)
                                    <div class="accordion-row">
                                        <a href="#" class="accordion-header">
                                            <span>{{ $item->title }}</span>
                                            <i class="accordion-status-icon close fa fa-plus"></i>
                                            <i class="accordion-status-icon open fa fa-close"></i>
                                        </a>
                                        <div class="accordion-body">
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center"></p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Question1Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">چرا به {{ env('SiteBrand') }} اعتماد کنم؟</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        @forelse (App\Models\Question::where('type' , 'why')->get() as $item)
                            <div class="form-group">
                                <h6 class="text-success">{{ $item->title }}</h6>
                                <p>{{ $item->description }}</p>
                            </div>
                        @empty
                            <p class="text-center"></p>
                        @endforelse
                    </div>
                    <div class="d-flex flex-wrap">
                        @forelse (App\Models\Image::where('type' , 'certification_image')->get() as $item)
                            <img src="{{ asset($item->url) }}" alt="" style="width: 70px; height: 70px; margin:5px 10px;">
                        @empty
                            <p class="text-center"></p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                    </button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">

            <div class="header-logo">
                <a href="{{ route('Web.index') }}">
                    <img src="{{ asset($settings->logo) }}" alt="...">
                    <span class="logo-text d-none d-lg-block"> {{ env('SiteBrand') }} </span>
                </a>
            </div>

            <div class="header-body" style="justify-content: flex-end">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown">
                            <figure class="avatar avatar-sm avatar-state-success">
                                <img class="rounded-circle advisor_profile" src="{{ asset(Auth::guard('web')->user()->Image?Auth::guard('web')->user()->Image->url:'assets/avatar.jpg') }}" alt="...">

                            </figure>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('Users.Profile') }}" style="color:#444!important;"
                                class="dropdown-item ">پروفایل</a>
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
            </div>

        </div>
    </nav>
    <main class="main-content">
        @yield('content')
    </main>
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <script src="{{ asset('vendor/js/app.js') }}"></script>
    <script src="{{ asset('assets/lib/message.js') }}"></script>
    <script src="{{ asset('assets/lib/ajax.js') }}"></script>
    @yield('js')

</body>

</html>
