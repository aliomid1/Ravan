@php
    $admin=\App\Models\Admin::find(1);
    $settings = \App\Models\Settings::first();
@endphp


    <!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ env('SiteBrand') }} | پنل ادمين |
        @yield('title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- begin::global styles -->
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <!-- end::global styles -->


    <!-- begin::custom styles -->
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{asset($settings->logo)}}" type="image/x-icon">
    <!-- end::favicon -->
@yield('style')
<!-- begin::theme color -->
    <meta name="theme-color" content="#ff7300"/>
    <!-- end::theme color -->

</head>

<style>
    nav.navbar {
        background-color: #ff7300;
        z-index: 1001;
    }

    @media (max-width: 576px) {
        .p-50 {
            padding: 19px !important;
        }
    }

</style>

<body>
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
@include('components.messages.Alert')



<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>
            <li><a href="{{ route('Admins.Dashboard') }}"><i class="icon ti-home"></i> <span>داشبورد</span> </a>
            </li>
            <li><a href="{{ route('Admins.UsersList') }}"><i class="icon ti-user"></i> <span>لیست
                            کاربران</span>
                </a></li>
            <li><a><i class="icon ti-user"></i> <span>
                            مشاورین</span></a>
                <ul>
                    <li><a href="{{ route('Admins.AdvisorsList') }}">لیست</a></li>
                    <li><a href="{{ route('Admins.AddAdvisor') }}">ایجاد</a></li>
                    <li><a href="{{ route('Admins.AdvisorsRequestList') }}">فرم های همکاری</a></li>

                </ul>
            </li>
            <li><a><i class="icon ti-list"></i>
                    <span>موضوع ها</span></a>
                <ul>
                    <li><a href="{{ route('Admins.SubjectCategory') }}">لیست دسته بندی</a></li>
                    <li><a href="{{ route('Admins.SubjectCategories.create') }}">ایجاد دسته بندی</a></li>
                    <li><a href="{{ route('Admins.Subjects') }}">موضوع ها</a></li>
                    <li><a href="{{ route('Admins.Subject.create') }}">ایجاد موضوع</a></li>

                </ul>
            </li>
            <li><a><i class="icon ti-agenda"></i>
                    <span>مقالات</span></a>
                <ul>
                    <li><a href="{{ route('Admins.Blogs.index') }}">لیست مقالات</a></li>
                    <li><a href="{{ route('Admins.Blogs.create') }}">ایجاد مقاله</a></li>
                    <li><a href="{{ route('Admins.BlogsCategory') }}">لیست دسته بندی</a></li>
                    <li><a href="{{ route('Admins.BlogsCategories.create') }}">ایجاد دسته بندی</a></li>
                </ul>
            </li>
            <li><a href="{{ route('Admins.DepositToAdvisorsAccount') }}"><i class="icon ti-wallet"></i> <span>واریزی
                            ها برای مشاوران</span> </a>
            </li>
            <li><a href="{{ route('Admins.PlansManager') }}"><i class="icon ti-package"></i> <span>مدیریت پلن ها</span>
                </a>
            </li>
            <li><a href="{{ route('Admins.Support') }}"><i class="icon ti-comment"></i> <span>پشتیبانی </span> </a>
            </li>
            <li><a href="#"><i class="icon ti-layers"></i> <span>صفحات</span> </a>
                <ul>
                    <li><a href="{{ route('Admins.PagesManager') }}">مدیریت صفحات</a></li>
                    <li><a href="{{ route('Admins.Questions') }}">ویرایش سوالات متداول</a></li>
                    <li><a href="{{ route('Admins.HomePage.edit') }}">ویرایش صفحه ی اصلی</a></li>
                    <li><a href="{{ route('Admins.AboutUs.edit') }}">ویرایش درباره ما</a></li>
                    <li><a href="{{ route('Admins.ContactUs.edit') }}">ویرایش تماس با ما</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icon ti-settings"></i> <span>تنظیمات</span> </a>
                <ul>
                    <li><a href="{{ route('Admins.Settings.General') }}">کلی</a></li>
                    <li><a href="{{ route('Admins.Settings.App') }}">مدیریت برنامه</a></li>
                </ul>
            </li>
            <li><a href="{{ route('Logout') }}"><i class="icon ti-power-off"></i> <span>خروج</span> </a></li>
        </ul>
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

            <ul class="navbar-nav">


                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown">
                        <figure class="avatar avatar-sm avatar-state-success">
                            <img class="rounded-circle" src="{{ asset($admin->profile) }}" alt="...">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('Admins.AdvisorsList') }}" class="dropdown-item">پروفایل</a>
                        <a href="{{ route('Admins.Settings.General') }}" data-sidebar-target="#settings" class="sidebar-open dropdown-item">تنظیمات</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('Logout')}}" class="text-danger dropdown-item">خروج</a>
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
<!-- end::custom scripts -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
@yield('js')

</body>

</html>
