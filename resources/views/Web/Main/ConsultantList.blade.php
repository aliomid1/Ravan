@extends('layout.web.template')
@section('title', 'لیست مشاوران')
@section('content')
    <div>
        <div id="top-site-menu-two">
            <div>
                <a href="{{ route('Web.index') }}">صفحه اصلی</a>
            </div>

            <div class="">
                <i class="far fa-chevron-left"></i>
                <a class="disabled btn py-0 d-inlene" href="#">لیست مشاورین</a>

            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-9 mx-auto">

                <div id="search-list" class="d-flex align-items-center">
                    <i class="fal fa-search"></i>
                    <input placeholder="جستوجوی نام , دسته بندی  یا  تخصص" type="text" name=""
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
