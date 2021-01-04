@extends('layout.web.template')
@section('title', $CurrentSubject->title.' | '.$MainCat->title)
@section('content')
    <div class="profile-moshaver-list mt-5 pt-5">
        <div class="container mt-5">
            <div>
                <div id="top-site-menu-two">
                    <div>
                        <a href="{{ route('Web.index') }}">صفحه اصلی</a>
                    </div>


                    <div>
                        <i class="far fa-chevron-left"></i>
                        <a href="{{ route('Web.Category') }}">دسته بندی</a>
                    </div>


                    <div>
                        <i class="far fa-chevron-left"></i>
                        <a href="{{ route('Web.CategoryList', $MainCat->id) }}">{{ $MainCat->title }}</a>
                    </div>


                    <div>
                        <i class="far fa-chevron-left"></i>
                        <a class="btn disabled p-0" href="#">{{ $CurrentSubject->title }}</a>

                    </div>
                </div>
            </div>


            <div class="">
                <div class="row">
                    <div class="right-profile  col-md-6">
                        <h2 class="name-moshaver-profile">{{ $CurrentSubject->title }}</h2>
                        <div class="prop-moshaver-single">
                            <p>{{ $CurrentSubject->description }}</p>
                        </div>

                    </div>

                    <div id="left-profile-moshaver" class="col-md-6 align-items-center justify-content-center pb-5">
                        <div id="img-discription-left-single-profile " class="">
                            <div id="img-disc">
                                <img class="w-100"
                                     src="{{ asset($CurrentSubject->Image ? $CurrentSubject->Image->url : 'assets/Web/images/depression_consulting.jpg') }}"
                                     alt="">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-4">

        <div class="row">
            <div class="col-md-9 mx-auto">

                <div id="search-list" class="d-flex align-items-center">
                    <i class="fal fa-search"></i>
                    <input placeholder="جستوجوی نام مشاور" type="text" name=""
                        data-url="{{ route('Web.ConsultantListSearch') }}" id="ConsultantSearch">
                </div>
            </div>
        </div>

        <div id="items-list">
            @forelse($advisor as $item)
                <div class="item-list">
                    <div id="child-list" class="flex-column flex-lg-row px-3">
                        <div class="status">
                            <i class={{ $item->status == 1 ? 'on' : 'off' }}></i>
                            <img class="image-list"
                                src="{{ asset($item->Profile ? $item->Profile->url : 'assets/Web/images/doctor.jpg') }}" alt="">
                        </div>
                        <div id="prop-moshaver" class=" w-100 px-1 ">
                            <p id="name-moshaver">{{ $item->name }}</p>
                            <p id="short-discription-moshaver">{{ $item->bio }}</p>
                            <div id="down-item-list"
                                class="align-items-center justify-content-between flex-column flex-lg-row flex-wrap  w-100">
                                <div class="right-down-item-moshaver d-flex felx-wrap">
                                    <div class="d-flex flex-column align-items-center flex-lg-row mr-2">
                                        <h4 class="mr-0">میانگین رتبه مشاور:</h4>
                                        <div class="my-2 mx-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= ($item->Comment ? $item->Comment->avg('score') : ''))
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="fas fa-star text-black-50"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <div>
                                            <h4> از
                                                {{ $item->Conversation ? $item->Conversation->sum('time') : '' }}
                                                دقیقه مشاوره
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="mr-lg-auto ml-lg-0 mx-auto">
                                    <a href="{{ route('Web.ProfileMoshaver', $item->id) }}"
                                        class="show-profile-moshaver d-inline-block">مشاهده
                                        پروفایل
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">موردی یافت نشد</div>
            @endforelse

        </div>
    </div>
    <section class="magazine-ads bg-success1 text-white d-flex align-items-center">
        <div class="container">
            <div class="container">
                <div class=" d-flex flex-wrap  justify-content-between align-items-center col-sm-10">
                    <h3 class="font-normal">مجله اینترنتی {{ env('SiteBrand') }} </h3>
                    <a href="{{ route('Web.Blogs') }}" class="d-flex align-items-center justify-contnt-center font-md ">همه
                        مطالب <i class="far fa-chevron-left mr-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-y-section popular-comments bg-color3">
        <div class="container">
            <header class="header text-center gap-lg">
                <img class="mb-3" src="{{ asset('assets/Web/images/comment.svg') }}" alt="pik">
                <h4 class="font-normal">نظرات کاربران</h4>
            </header>
            <div class="items col-sm-7 mx-auto">
                @forelse($CurrentSubject->ConfirmedComments as $item)
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
                <form action="{{ route('Web.AddSubjectOfCategoryComment', $CurrentSubject->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>افزودن نظر</label>

                            <textarea name="text" rows="5" class="form-control"></textarea>
                       
                    </div>
                    <button type="submit" class="btn btn-success1 add-comment form-group">
                        <img src="{{ asset('assets/Web/images/addcomment.svg') }}" class="ml-2 " alt="">
                        افزودن نظر
                    </button>
                </form>
            </div>
        </div>
    </section>
    <!-- End comments -->
@endsection
@section('style')
<style>
    #search-list {
        margin-top: 52px;
        border: none !important;
        padding: 20px;
        background: #fff;
        box-shadow: 5px 5px 25px 0 rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }

    #search-list .fa-search {
        font-size: 20px;
        color: #555;
        margin: 0 10px;
    }

    .show-profile-moshaver {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #2db354;
        color: white;
        border-radius: 40px !important;
        font-size: 18px;
        width: unset !important;
        border: 1px solid white;
        height: unset !important;
        margin: 20px !important;
        padding: 10px 25px !important;

    }

    .status i {
        width: 15px !important;
        height: 15px !important;
    }

    .off {
        background-color: #fc6655 !important;
    }

    #search-list input {
        width: 100%;
        outline: none !important;
        font-size: 18px;
        border: none !important;
    }

</style>
@endsection
