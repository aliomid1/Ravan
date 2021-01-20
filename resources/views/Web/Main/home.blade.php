@extends('layout.web.template')
@php
$settings = \App\Models\Settings::first();
@endphp
@section('keywords',$settings->keywords)
@section('description',$settings->description)
@section('title','صفحه اصلی')

@section('content')
<div class="topest-gap"></div>
<section class="landing-section">
    <div class="row px-3 px-xl-0">
        <div class="col-xl-6 col-md-8 alternates pl-md-5 order-last order-md-first ">
            <div class="col-xl-8 col-md-9 mr-xl-auto px-0">
                <p class="text-black1 mb-3">خدمت مورد نظر خود را انتخاب کنید</p>
                <ul class="items">
                    @forelse ($Services as $item)
                        <li class=" position-relative">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <div class="img d-flex justify-content-center align-items-center">
                                <span></span></div>
                            <div class="text" class="text">
                                <h1 class="text-black1">{{ isset($item['title']) ? $item['title'] : '' }}</h1>
                                <h2 class="text-light1">{{ isset($item['short_desc']) ? $item['short_desc'] : '' }}</h2>
                            </div>
                            <a href="{{ isset($item['link']) ? asset($item['link']) : '#' }}" class="entry-link"></a>
                        </li>
                    @empty
                        <h5> </h5>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="bg-img order-first order-md-last d-flex align-items-end"
            style="background: url('{{ asset( $MainImage ? $MainImage->url :'assets/Web/images/home-header-background.jpg') }}') top left; background-size: cover;">
            <div
                class="numbers d-flex align-items-center bg-white shadow-sm d-flex justify-content-center col-xl-5 col-lg-6 col-md-7 col-sm-5 col-8 mx-auto">
                <span>
                    <h3 class="mb-0 ml-2 ">{{ $Users->count() }}</h3>
                </span><span>
                    <h6 class="mb-0 ">کاربر</h6>
                </span>
            </div>
        </div>
</section>

<section class="advantages-section padding-y-section">
    <div class="container">
        <header class="header gap-lg">
            <h1>چرا  {{ env('SiteBrand') }} </h1>
            <h2>ویژگی ها و مزیت های مشاوره آنلاینِ  {{ env('SiteBrand') }} </h2>
        </header>
        <div class="row justify-content-center ">
            @forelse ($Advantages as $item)
                 <div class="col-xl-3 col-md-4 col-6 d-flex flex-column justify-content-center text-center mb-3">
                    <p class="font-weight-bold gap-inner">{{ $item['title'] }}</p>
                    <p>{{ $item['short_desc'] }}</p>
                </div>
            @empty
                <h2> </h2>
            @endforelse
        </div>
    </div>
</section>

<section class="comments-section padding-y-section  bg-color2">
    <div class="container text-center">
        <header class="header ">
            <h1>نظرات کاربران</h1>
            <h2>نظرات افرادی که از مشاوران آنلاینِ  {{ env('SiteBrand') }}  استفاده کرده اند</h2>
        </header>
        <div class="comments-s owl-carousel owl-theme main-img col-sm-9 mx-auto">
            @forelse ($SelectedComments as $item)
             @if ($item->User)
                <div class="item part-padding bg-white shadow-sm">
                    <div class="">
                    </div>
                    @if ($item->User->Image)
                    <img class="mb-2 rounded-circle mx-auto"
                        src="{{asset($item->User->Image->url)}}" alt="person">
                    @endif
                    <h6>{{ $item->User->fullname }}</h6>
                    <p class="mb-3">{{ $item->text }}</p>
                </div>
             @endif
            @empty

            @endforelse
        </div>
    </div>
</section>

<section class="articles-section padding-y-section gap-lg">
    <div class="container">
        <header
            class="header d-flex flex-sm-row flex-column gap-lg justify-content-between align-items-sm-end align-items-start">
            <h1>مجله سلامت  {{ env('SiteBrand') }} </h1>
            <a href="{{route('Web.Blogs')}}">
                <h6>مشاهده تمامی مطالب مجله سلامت <i class="fas fa-chevron-left mr-2"></i></h6>
            </a>
        </header>
        <div class="row articles align-items-stretch">
            @forelse ($Blogs as $item)
            <div class="col-xl-3 col-lg-4 col-sm-6 item  ">
                <div class="rounded-lg overflow-hidden position-relative inner shadow-sm">
                    <a href="{{route('Web.Blog' , $item->id)}}" class="entry-link"></a>
                    <div class="img gap-xs">
                        <img src="{{ asset($item->Image->url) }}"
                            alt="article-pic" class=" w-100">
                    </div>
                    <div class="text">
                        <p class="gap-xs">{{ $item->title }}</p>
                        <div class="d-flex justify-content-between">
                            <span class="rounded-lg border border-primary font-xs text-primary p-1">{{$item->short_desc}}</span>
                            <span class="font-sm text-light1">{{ $item->crated_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h2> </h2>
            @endforelse

        </div>
    </div>
</section>

<section class="p-questions">
    <div class="container">
        <div class="accordion" id="accordionExample">
            @forelse ($Guidences as $key => $item)
                <div class="card">
                    <div class="card-header" id="heading{{ $loop->iteration }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"
                                aria-expanded="{{ $loop->iteration == '1' ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->iteration }}">
                                {{ isset($item['title']) ? $item['title'] : '' }}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $loop->iteration }}" class="collapse {{ $loop->iteration == '1' ? 'show' : '' }} " aria-labelledby="heading{{ $loop->iteration }}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            {{ isset($item['description']) ? $item['description'] : '' }}
                        </div>
                    </div>
                </div>
            @empty
              <h2> </h2>
            @endforelse

        </div>
    </div>
</section>
@endsection
