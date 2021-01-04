<!DOCTYPE html>
<html lang="fa">
@php
$settings = \App\Models\Settings::first();
@endphp

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ env('SiteBrand') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/Web/lib/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Web/lib/owlcarousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\Web\fonts\fontawesome-pro\css\all.min.css') }}">

    @yield('style')
    <style>
        #toast-container>.toast-warning {
            background: #F15524 !important;
            background-repeat: no-repeat;
            color: white;
        }

        #toast-container>.toast-success {
            background: #72C156 !important;
            color: white;
        }

        .entry-link {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/Web/lib/bootstrap_4.5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Web/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset($settings->logo) }}" type="image/x-icon">

</head>


@php
$ContactUs = App\Models\ContactUs::first();

$Footer = json_decode(App\Models\HomePage::first()->footer , true);

if (!isset($Footer['trust'])) {
$Footer['trust'] = [];
}

if (!isset($Footer['social_media'])) {
$Footer['social_media'] = [];
}
@endphp


<body>
    @include('components.messages.Alert')
    <!-- Navigation -->
    <header class="top-header shadow-sm" style="background:{{ $settings->colorPrimary }}!important;">
        <div class="container">
            <nav class="top-nav d-flex flex-wrap align-items-center">
                <div class="res-sidebar">
                    <div class="res-btn d-xl-none d-flex align-items-center">
                        <div class="btn">
                            <i class="fas fa-bars"></i>
                        </div>
                        <p class="mr-5">مشاوره آنلاین {{ env('SiteBrand') }} </p>
                    </div>
                    <ul class="abso-sidebar d-xl-none d-block">
                        <li><a href="{{ route('Web.index') }}">صفحه اصلی</a></li>
                        @if (Auth::user())
                            <li><a href="{{ route('Users.Dashboard') }}">داشبورد</a></li>
                        @endif
                        @if (Auth::guard('advisor')->user())
                            <li><a href="{{ route('Advisors.Dashboard') }}">داشبورد</a></li>
                        @endif
                        <li><a href="{{ route('Web.Blogs') }}">بلاگ</a></li>
                        <li><a href="#">دانلود اپلیکیشن</a></li>
                        <li><a href="{{ route('Web.Category') }}">دسته بندی های مشاوره</a></li>
                        <li><a href="{{ route('Web.auth.Login') }}">مشاوره آنلاین</a></li>
                        <li><a href="{{ route('Web.ConsultantList') }}">لیست مشاورین</a></li>
                        <li><a href="{{ route('Web.Anonymous') }}">ورود ناشناس</a></li>
                        <li><a href="{{ route('Web.Info') }}">درباره ما</a></li>
                        <li><a href="{{ route('Web.ContactUs') }}">تماس با ما</a></li>

                        @foreach (\App\Models\Page::where('statusmenu', 'on')->get() as $itemmenu)
                            <li><a href="{{ route('Web.Page', $itemmenu->slug) }}">{{ $itemmenu->titlemenu }}</a></li>
                        @endforeach
                    </ul>

                </div>
                <div class="logo d-xl-none mr-xl-0 mr-auto">
                    <img src="{{ asset($settings->logo) }}" alt="logo">
                </div>
                <ul class="d-none w-100 d-xl-flex flex-wrap items align-items-center">
                    <li class="logo">
                        <img src="{{ asset($settings->logo) }}" alt="logo">
                    </li>
                    <li><a href="{{ route('Web.index') }}">صفحه اصلی</a></li>
                    <li><a href="{{ route('Web.Blogs') }}">بلاگ</a></li>
                    <li><a href="#">دانلود اپلیکیشن</a></li>
                    <li><a href="{{ route('Web.Category') }}">دسته بندی های مشاوره</a></li>
                    <li><a href="{{ route('Web.auth.Login') }}">مشاوره آنلاین</a></li>
                    <li><a href="{{ route('Web.ConsultantList') }}">لیست مشاورین</a></li>
                    @if ($settings->type_signUp_users == 'on')
                        <li><a href="{{ route('Web.Anonymous') }}">ورود ناشناس</a></li>
                    @endif
                    <li><a href="{{ route('Web.Info') }}">درباره ما</a></li>
                    <li><a href="{{ route('Web.ContactUs') }}">تماس با ما</a></li>
                    @foreach (\App\Models\Page::where('statusmenu', 'on')->get() as $itemmenu)
                        <li><a href="{{ route('Web.Page', $itemmenu->slug) }}">{{ $itemmenu->titlemenu }}</a></li>
                    @endforeach
                    @if (Auth::guard('advisor')->user())
                    @php
                    $Advisor_id = Auth::guard('advisor')->User()->id;
                    $Advisor_Image = \App\Models\Image::where('item_id' , $Advisor_id)->where('type' ,
                    'profile_advisor')->first();
                    @endphp
                        <li class="nav-item dropdown mr-auto">
                            <a href="#" data-toggle="dropdown">
                                <figure style="width: 30px;height: 30px;" class="avatar avatar-sm avatar-state-success">
                                    <img class="rounded-circle advisor_profile"
                                    src="{{ $Advisor_Image ? asset($Advisor_Image->url) : asset('assets/avatar.jpg') }}"
                                    alt="...">
                                </figure>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right text-right">
                                <a style="color:#444!important;" class=" dropdown-item"  href="{{ route('Advisors.Dashboard') }}">داشبورد</a>
                                <a style="color:#444!important;" class=" dropdown-item"  href="{{ route('Advisors.Profile') }}">پروفایل</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('Logout') }}" class="text-danger dropdown-item">خروج</a>
                            </div>
                        </li>

                    @endif
                    @if (Auth::user())
                        <li class="nav-item dropdown mr-auto">
                            <a href="#" data-toggle="dropdown">
                                <figure style="width: 30px;height: 30px;" class="avatar avatar-sm avatar-state-success">
                                    <img class="rounded-circle" src="{{ asset(Auth::user()->Image?Auth::user()->Image->url:'assets/avatar.jpg') }}" alt="...">
                                </figure>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right text-right">
                                <a style="color:#444!important;" class=" dropdown-item" href="{{ route('Users.Dashboard') }}">داشبورد</a>
                                <a style="color:#444!important;" class=" dropdown-item" href="{{ route('Users.Profile')}}">پروفایل</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('Logout') }}" class="text-danger dropdown-item">خروج</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Navigation -->

    @yield('content')

    <!-- Start footer -->
    <div class="container">
        <div id="footer">
            <div id="top-footer">
                <div id="footer-child" class="row">
                    <div class="col-md-4" id="right-footer-top">
                        <img id="img-footer-top" style="max-width: 100%; height: 150px;"
                            src="{{ asset($settings->logo) }}" alt="logo">
                        <div id="parent-link">
                            <div id="one-link-groupe-footer-top">
                                <a href="{{ route('Web.auth.Login') }}">مشاوره آنلاین</a>
                                <a href="{{ route('Web.Category') }}">دسته بندی های مشاوره</a>
                                <a href="{{ route('Web.ConsultantList') }}">لیست مشاورین</a>

                            </div>

                            <div id="two-link-groupe-footer-top">
                                {{-- <a href="#">دانلود اپلیکیشن</a>
                                --}}
                                <a href="{{ route('Web.Blogs') }}">مجله روانشناسی</a>
                                <a href="{{ route('Web.Info') }}">درباره ما</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 pb-5" id="content-footer-top">
                        <div class="d-flex justify-content-center">
                            @forelse ($Footer['trust']['items'] as $item)
                                <a href="{{ isset($item['trust_link']) ? $item['trust_link'] : '#' }}">
                                    <img style="height: 115px;object-fit: contain; max-width: 100%;"
                                        src="{{ asset(isset($item['trust_image']) && !is_array($item['trust_image']) ? $item['trust_image'] : '') }}"
                                        alt="عکسی ثبت نشده است">
                                </a>
                            @empty
                                <h4> </h4>
                            @endforelse
                        </div>
                        <p id="footer-up-content-p">
                            {{ isset($Footer['trust']['detail']) ? $Footer['trust']['detail'] : '' }}
                        </p>
                    </div>

                    <div class="col-md-4" id="left-footer-top">
                        <p> {{ env('SiteBrand') }} را در شبکه های اجتماعی دنبال کنید:</p>
                        <div id="icons">
                            @forelse ($Footer['social_media'] as $item)
                                <a id="" href="{{ isset($item['social_media_link']) ? $item['social_media_link'] : '#' }}"
                                    style="margin:10px 20px; background-size: contain; background-image: url({{ asset(isset($item['social_media_image']) && !is_array($item['social_media_image']) ? $item['social_media_image'] : '') }});"
                                    alt="عکسی ثبت نشده است"></a>
                            @empty
                                <h4> </h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div id="content-footer">
                <span id="ContactUs" class="position-absolute"></span>
                <div id="email">
                    <p id="mail">آدرس ایمیل:</p>
                    <p>{{ $ContactUs->email }}</p>
                </div>
                <div id="number">
                    <p id="num">مشاوره تلفنی:</p>
                    <p>{{ $ContactUs->phone }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End footer -->
    <span id="jump_to_me" class="go-top">
        <i class='fas fa-caret-up 2x'></i>
        <p class="mb-0 "></p>
    </span>
    <!-- End page content -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/bootstrap_4.5/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/bootstrap_4.5/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/wow.js/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <script src="{{ asset('assets/Web/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/message.js') }}"></script>
    <script src="{{ asset('vendor/js/app.js') }}"></script>
    <script src="{{ asset('assets/Web/js/custom.js') }}" type="text/javascript"></script>

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
