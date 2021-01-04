@extends('layout.web.template')
@section('title', $CurrentCategory->title )
@section('content')
<div class="container pt-5">
    <div class="mt-5">
        <div class="mt-5 pt-5" id="top-site-menu-two">
            <div>
                <a href="{{ route('Web.index') }}">صفحه اصلی</a>
            </div>
            <div>
                <i class="far fa-chevron-left"></i>
                <a class="" href="{{ route('Web.Category') }}">دسته بندی</a>
            </div>
            <div>
                <i class="far fa-chevron-left"></i>
                <a class="btn py-0 disabled d-inline" href="#">{{ $CurrentCategory->title }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-sm-12 col-xs-12   " id="content">
            <div id="items" class="mt-0">
                <div class="row">
                    @forelse ($Subjects as $item)
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <div class="item">
                                <img src="{{ asset( $item->Image ? $item->Image->url : 'assets/Web/images/coronavirus_1.jpg') }}" alt="">
                                <a href="{{ route('Web.SubjectOfCategory' , [$CurrentCategory->id , $item->id]) }}" class="text-content">{{ $item->title }}</a>
                                <p class="date-content">{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>

            </div>
        </div>

        <div class="col-xl-4 col-sm-12 col-xs-12 mt-0 " id="left-site">

            <div id="last-news">
                <p id="last-label">اخرین مطالب </p>
                <ul id="last-items">
                @forelse ($RandomSubjects as $item)
                    <li class="item-last">
                        <img src="{{ asset($item->Image ? $item->Image->url : 'assets/Web/images/1.png') }}" alt="">
                        <div>
                            <p class="date-last">{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d') }}</p>
                            <a href="{{ route('Web.SubjectOfCategory' , [$CurrentCategory->id , $item->id]) }}">{{ $item->title }}</a>
                        </div>
                    </li class="item-last">
                @empty
                    <h4>3 مورد تصادفی یافت نشد</h4>
                @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
