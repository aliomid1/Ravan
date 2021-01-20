@extends('layout.web.template')
@section('title','دسته بندی های مشاوره')




@section('style')

@endsection




@section('content')
<div class="container">
        <div>
            <div id="top-site-menu-two">
                <div>
                    <a href="home.html">صفحه اصلی</a>
                </div>

                <div>
                    <i class="far fa-chevron-left"></i>
                    <a class="btn py-0 disabled d-inline" href="#">دسته بندی</a>
                </div>
            </div>
        </div>

        <div id="row-groups" class="row justify-content-center">
            @forelse ($Category as $item)
   
                <div class=" col-lg-5 ">
                    <div id="one-item-group" class="the-item-group" style="background-image: url({{ asset($item->Image ? $item->Image->url : 'assets/Web/images/icon_psychology-colsulting.png') }}); backgrount-position:center; background-size:cover;">
                        <a style="z-index: 1;position: absolute;width: 100%;height: 100%;" href="{{ route('Web.CategoryList' , $item->id) }}"></a>
                        <div id="top-color-item" class="top-color-item">
                            <img src="{{ asset('assets/Web/images/icon_psychology-colsulting.png') }}" alt="">
                            <p class="group-witch text-white">
                                دسته بندی های
                            </p>
                            <p class="text-white">
                                {{ $item->title }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <h3>موردی ثبت نشده است.</h3>
            @endforelse
        </div>
</div>
@endsection




@section('js')

@endsection
