@extends('layout.web.template')
@section('title','مقالات')
@section('content')
<div class="container">
    <div class="row pt-5">


        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12" id="content">
            <div>
                <div id="top-site-menu-two" class="mb-0">
                    <div>
                        <a href="{{ route('Web.index') }}">صفحه اصلی</a>
                    </div>
                    <div class="">
                        <i class="far fa-chevron-left"></i>
                        <a class="btn py-0 disabled d-inline" href="#">دسته بندی : {{ $title }}</a>
                    </div>
                </div>
            </div>
            <div id="items" class="mt-0">
                <div class="row">
                    @forelse($CategoryBlogs as $Blog)
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                            <div class="item">
                                <a class="p-0" href="{{ route('Web.Blog' , $Blog->id) }}">
                                    <img src="{{ $Blog->Image ? asset($Blog->Image->url)  : asset('assets/Web/images/coronavirus_1.jpg') }}"
                                        alt="">
                                </a>
                                <h5 class="mb-0 pb-0">
                                    <a
                                        href="{{ route('Web.Blog' , $Blog->id) }}"
                                        class="p-0 text-right text-content"> {{ $Blog->title }}
                                    </a>
                                </h5>
                                <a href="{{ route('Web.Blog' , $Blog->id) }}"
                                    class="">{{ $Blog->short_desc }}
                                </a>
                                <p class="date-content">
                                    {{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <h5 class="text-center w-100">موردی یافت نشد</h5>
                    @endforelse
                </div>

            </div>
        </div>



        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 " id="left-site">
            <div id="last-news">
                <p id="last-label">مطالب تصادفی</p>
                <ul id="last-items">

                    @forelse($RandomBlogs as $Blog)
                        <li class="item-last">
                            <img class=""
                                src="{{ $Blog->Image ? asset($Blog->Image->url)  : asset('assets/Web/images/coronavirus_1.jpg') }}"
                                alt="">
                            <div>
                                <p class="date-last">
                                    {{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
                                </p>
                                <a
                                    href="{{ route('Web.Blog' , $Blog->id) }}">{{ $Blog->title }}</a>
                            </div>
                        </li class="item-last">
                    @empty
                        <p class="text-center">موردی یافت نشد</p>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

</div>
@endsection
