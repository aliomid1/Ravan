@extends('layout.web.template')
@section('content')
<div class="topest-gap"></div>
<div class="container">
    <div class="row mt-5">


        <div class="col-md-8 col-sm-12 col-lg-9 content-single-page">
            <img class="img-top-single-page"
                src="{{ $Blog->Image ? asset($Blog->Image->url)  : asset('assets/Web/images/coronavirus_1.jpg') }}"
                alt="">
            <h3 class="text-top-single-pgae">{{ $Blog->title }}</h3>

            <div class="descreption-single-page">
                <p>{{ $Blog->short_desc }}</p>
            </div>
            {{-- <div class="img-between-div">
                <img src="{{ asset('assets/Web/images/male-nose-fold1.jpg') }}" alt="">
        </div> --}}
        <div class="div-text-box">
            {{-- <h4>{{ $Blog->title }}</h4> --}}
            <p>{!! $Blog->description !!}</p>
        </div>
        <div class="comment-single-page">
                @forelse($Blog->ConfirmedComments as $item)
                    <div class="item bg-white shadow-sm mb-4 rounded-lg part-padding-sm ">
                        <div class="d-flex align-items-center mb-2">
                            <img src="
                            @if ($item->User->Image)
                            {{ asset($item->User->Image->url) }}
                            @else
                            {{ asset('assets/Web/images/useravatar.svg') }}
                            @endif " alt="pik" class="ml-2" style="border-radius: 50%; width:42px; height:42px; ">
                            <p class=" font-light">
                                {{ $item->User ? $item->User->fullname : 'کاربر ناشناس' }}
                            </p>
                        </div>
                        <div>
                            <p>{{ $item->text }}</p>
                        </div>
                        <div>
                            <p class="text-left font-sm">
                                {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <h4></h4>
                @endforelse
            <h3 class="mt-5">پاسخی بگذارید</h3>
            <h6>جهت ثبت نظر باید وارد حساب کاربری شوید یا ثبت نام کنید.</h6>
            <form action="{{ route('Web.AddBlogComment', $Blog->id) }}" method="POST">
                @csrf
                <textarea class="form-control"  placeholder="متن دیدگاه..." name="text" id="" cols="30" rows="10"></textarea>
                <button type="submit" class="btn btn-success mt-3">ثبت نظر</button>
            </form>

        </div>
    </div>




    <div class="col-md-4 col-sm-12 col-lg-3 left-single-page">
        {{-- <h4>جستوجو</h4>
        <div class="box-search-single-page">
            <input class="form-control input-search-single-page " placeholder="جستوجو... " type="text ">
            <div class="btn-search-single-page ">
                <a href="# ">
                    <svg width="2em " height="2em " viewBox="0 0 16 16 " class="bi bi-search " fill="currentColor "
                        xmlns="http://www.w3.org/2000/svg ">
                        <path fill-rule="evenodd "
                            d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z " />
                        <path fill-rule="evenodd "
                            d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z " />
                    </svg>
                </a>
            </div>
        </div> --}}
        <div class="last-single-page ">
            <div class="items-last-single-page ">
                <p id="last-label">مطالب تصادفی</p>
                @forelse($RandomBlogs as $Blog)
                    <div class="item-last-single-page ">
                        <div class="img-last-item-single-page ">
                            <img src="{{ $Blog->Image ? asset($Blog->Image->url)  : asset('assets/Web/images/coronavirus_1.jpg') }} "
                                alt=" ">
                        </div>

                        <div class="texts-single-page ">
                            <p>{{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
                            </p>
                            <a
                                href="{{ route('Web.Blog' , $Blog->id) }}">{{ $Blog->title }}</a>
                        </div>
                    </div>
                @empty
                    <h6 class="text-center">موردی یافت نشد.</h6>
                @endforelse
            </div>
        </div>

        <div class="groups-single-page ">
            <h3>دسته بندی</h3>
            <div class="mb-4">
                <div class="card ">
                    <div class="card-header " id="headingOne ">
                        <h2 class="mb-0 d-flex">
                            @forelse($SelectedCat as $item)
                                <a href="{{ route('Web.Category.Blogs' , $item) }}" class="btn btn-link text-right " type="button " data-toggle="collapse "
                                    data-target="#collapseOne " aria-expanded="true " aria-controls="collapseOne ">
                                    {{ $item }}
                                </a>
                            @empty
                                <p class="text-center">موردی یافت نشد</p>
                            @endforelse
                        </h2>
                    </div>
                </div>
            </div>
            <h3>کلمات کلیدی</h3>
            <div class="seo-key-word-single-page p-2 ">
                <div class="items-key-word-seo-single-page ">
                    @forelse($Keywords as $item)
                        <div class="item-key-word-seo-single-page ">
                            <P>{{ $item }}</P>
                        </div>
                    @empty
                        <p class="text-center">موردی یافت نشد</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
