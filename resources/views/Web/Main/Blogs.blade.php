@extends('layout.web.template')
@section('title', 'مقالات')
@section('content')
    <div class="container pt-5">
        <div class="row pt-5 pb-4">
            <div class="col-lg-8 col-12 mt-5">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <div id="top-site-menu-two" class="mb-0">
                            <div>
                                <a href="{{ route('Web.index') }}">صفحه اصلی</a>
                            </div>
                            <div class="">
                                <i class="far fa-chevron-left"></i>
                                <a class="btn py-0 disabled d-inline" href="#">بلاگ</a>
                            </div>
                        </div>
                    </div>
                    <div id="search" class="col-md-8">
                        {{-- <p id="search-label">جستوجو</p> --}}
                        <input class="search-input" data-url="{{ route('Web.BlogSearch') }}" type="text"
                            placeholder="جستجو..." />
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col-lg-8 col-sm-12 col-xs-12" id="content">
                <div id="items" class="mt-0">
                    <div class="row">
                        @forelse($Blogs as $Blog)
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 outer">
                                <div class="item">
                                    <a class="p-0" href="{{ route('Web.Blog', $Blog->id) }}">
                                        <img src="{{ $Blog->Image ? asset($Blog->Image->url) : asset('assets/Web/images/coronavirus_1.jpg') }}"
                                            alt="">
                                    </a>
                                    <h5 class="mb-0 pb-0">
                                        <a href="{{ route('Web.Blog', $Blog->id) }}" class="p-0 text-right text-content">
                                            {{ $Blog->title }}
                                        </a>
                                    </h5>
                                    <a href="{{ route('Web.Blog', $Blog->id) }}" class="">{{ $Blog->short_desc }}
                                    </a>
                                    <p class="date-content">
                                        {{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-center w-100 mt-5">موردی یافت نشد</h5>
                        @endforelse
                    </div>

                </div>
            </div>
            <div class=" col-lg-4 col-sm-12 col-xs-12  pt-4">
                <div class="card">
                    <p class="px-4 py-4">دسته بندی ها</p>
                    <ul>
                        @forelse(\App\Models\BlogsCategory::get() as $cat)
                            <li class="d-block py-2 px-3">
                                <a href="{{ route('Web.Blogs', ['title' => $cat->title]) }}"
                                    class="d-flex justify-content-between">
                                    <p>{{ $cat->title }}</p>
                                    <p>{{ $cat->GetSubjects($cat->title) ? $cat->GetSubjects($cat->title)->count() : '-' }}</p>
                                </a>
                            </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
                <div id="last-news">
                    <p id="last-label">مطالب تصادفی</p>
                    <ul id="last-items">
                        @forelse($RandomBlogs as $Blog)
                            <li class="item-last">
                                <img class=""
                                    src="{{ $Blog->Image ? asset($Blog->Image->url) : asset('assets/Web/images/coronavirus_1.jpg') }}"
                                    alt="">
                                <div>
                                    <p class="date-last">
                                        {{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
                                    </p>
                                    <a href="{{ route('Web.Blog', $Blog->id) }}">{{ $Blog->title }}</a>
                                </div>
                            </li>
                        @empty
                            <p class="text-center">موردی یافت نشد</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
