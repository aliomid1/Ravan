@extends('layout.web.template')
@section('title', 'پروفایل ' . $advisor->name)



@section('style')
    <style>
        .nav-pills .nav-link,
        .nav-pills .show > .nav-link {
            color: #444 !important;
            background: unset !important;
            border-bottom: 2px solid #5ad2a0;
            border-radius: 0px !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show > .nav-link {
            color: #444 !important;
            background: unset !important;
            border-bottom: 2px solid #ff7300;
            border-radius: 0px;
        }

        .cardd-header {
            cursor: pointer;
        }

        .nav-tabs .nav-link.active {
            color: #ffffff !important;
            background-color: #f8764b !important;
            border: none !important;
        }
    </style>

@endsection



@section('content')
    <div class="container-fluid">
        <div>
            <div id="top-site-menu-two" class="d-sm-flex d-none">
                <div>
                    <a href="{{ route('Web.index') }}">صفحه اصلی</a>
                </div>
                <div>
                    <i class="far fa-chevron-left"></i>
                    <a href="{{ route('Web.ConsultantList') }}">لیست مشاورین</a>
                </div>
                <div>
                    <i class="far fa-chevron-left"></i>
                    <a class="btn disabled d-inline" href="#">صفحه جزییات {{ $advisor->name }}</a>
                </div>
            </div>
        </div>
        <div class="profile-moshaver-list row">
            <div
                class="right-profile  col-xl-9 row justify-content-center justify-content-xl-start order-last order-xl-first">
                <div class="card-body pt-0  ">
                    <h2 class="name-moshaver-profile mb-3"> {{ $advisor->name }}</h2>
                    <div class="">
                        <ul class="nav nav-pills mb-3 d-flex flex-xl-nowrap align-items-stretch" id="pills-tab2"
                            role="tablist">
                            <li class="nav-item pl-1 w-50 text-center">
                                <a class="nav-link h-100 d-flex align-items-center justify-content-center show active"
                                   id="pills-bio-tab" data-toggle="pill" href="#pills-bio" role="tab"
                                   aria-controls="pills-bio" aria-selected="true">بیوگرافی</a>
                            </li>
                            <li class="nav-item pl-1 w-50 text-center">
                                <a class="nav-link h-100 d-flex align-items-center justify-content-center "
                                   id="pills-education-tab" data-toggle="pill" href="#pills-education" role="tab"
                                   aria-controls="pills-education" aria-selected="false">تحصیلات</a>
                            </li>
                            <li class="nav-item pl-1 w-50 text-center">
                                <a class="nav-link h-100 d-flex align-items-center justify-content-center "
                                   id="pills-resume-tab" data-toggle="pill" href="#pills-resume" role="tab"
                                   aria-controls="pills-resume" aria-selected="false">روزمه</a>
                            </li>
                            @if ($advisor->vip == '1')
                                <li class="nav-item pl-1 w-50 text-center">
                                    <a class="nav-link h-100 d-flex align-items-center justify-content-center "
                                       id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                                       aria-controls="pills-contact" aria-selected="false">اطلاعات
                                        تماس</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content p-3" id="pills-tabContent2">
                            <div class="tab-pane fade active show" id="pills-bio" role="tabpanel"
                                 aria-labelledby="pills-bio-tab">
                                <p>{{ $advisor->bio }}</p>
                            </div>
                            <div class="tab-pane fade table-responsive" id="pills-education" role="tabpanel"
                                 aria-labelledby="pills-education-tab">
                                <table class="table text-center">
                                    <tr>
                                        <thead>
                                        <th>تخصص</th>
                                        <th>مدرک</th>
                                        <th>محل تحصیل</th>
                                        <th>تاریخ فارغ التحصیلی</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($education as $item)
                                            <tr>
                                                <td>{{ $item->skill }}</td>
                                                <td>{{ $item->certification }}</td>
                                                <td>{{ $item->location }}</td>
                                                <td>{{ $item->date }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center">هنوز موردی ثبت نشده است.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-resume" role="tabpanel"
                                 aria-labelledby="pills-resume-tab">
                                {{ $advisor->resume }}
                            </div>
                            @if ($advisor->vip == '1')
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                     aria-labelledby="pills-contact-tab">
                                    <div class="d-flex justify-content-center mb-2">
                                        <b>شماره موبايل: {{ $advisor->mobile }}</b>
                                        <p></p>
                                    </div>
                                    <div class="d-flex justify-content-center mb-2">
                                        <b>شماره تلفن ثابت: {{ $advisor->tel }}</b>
                                        <p></p>
                                    </div>
                                    <div class="d-flex justify-content-center mb-2">
                                        <b>ايميل: {{ $advisor->email }}</b>
                                        <p></p>
                                    </div>
                                    <div class="d-flex justify-content-center mb-2">
                                        <b>آدرس: {{ $advisor->address }}</b>
                                        <p></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="left-profile-moshaver" class="col-xl-3 my-3 order-first order-xl-last align-items-center">
                <div id="img-discription-left-single-profile">
                    {!! $advisor->vip == 1 ? '<div class="top-label">VIP</div>' : '' !!}
                    <div id="img-disc">
                        <span class="status-detail">
                            {{ $advisor->status == 1 ? 'هم اکنون آنلاین است' : 'هم اکنون در حال استراحت است' }}
                        </span>
                        <img
                            src="{{ asset($advisor->Profile ? $advisor->Profile->url : 'assets/Web/images/doctor.jpg') }}"
                            alt="{{ $advisor->name }}">
                        <div id="down-left-single-profile-moshaver">
                            @php
                                if ($advisor->status==1) {
                                if (Session::has('anonymous')) {
                                $url = route("Web.Checkout",['id'=>$advisor->id,'type'=>'chat']);
                                } else {
                                $url = route("Web.auth.Login",['advisor'=>$advisor->id]);
                                }
                                if (Auth::guard('web')->user()) {
                                $url = route("Web.Checkout",['id'=>$advisor->id,'type'=>'chat']);
                                }
                                }else{
                                $url= '#';
                                }
                            @endphp
                            <a class="mt-1" href="{{ $url }}" id="start-moshavere">مشاوره بگيريد</a>
                        </div>
                    </div>
                    {{-- @php
                    $Advisor_Networks = unserialize($advisor->networks);
                    @endphp
                    @if ($Advisor_Networks) --}}
                    <p id="pleas-enter-comment-profile">اگر از این مشاور راضی هستید و می خواهید به دوستانتان پیشنهاد
                        دهید
                    </p>
                    <div id="follow-me-profiles">
                        {{-- @forelse ($Advisor_Networks as $key => $network)
                        <a href="{{ $network }}"><i class="fab fa-{{ $key }}"></i></a>
                        @empty
                @endforelse --}}
                        <a href="#"><i class="fab fa-telegram"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                    {{-- @endif --}}
                </div>


            </div>
        </div>
        @php
            $comments = \App\Models\Comment::where('advisor_id',$advisor->id)->where('status','on')->get();
            $times = $advisor->Conversation->sum('time');
            $scores =$comments->sum('score');
        @endphp
        <div class="card-body pt-0 col-md-12 py-3 mt-4">
            <h4 class="name-moshaver-profile mb-5">انتخاب زمان مشاوره</h4>
            <div>
                {!!$ConsultationsTimes!!}
            </div>

        </div>
        <div class="between-profile">
            @if ($times > 0 && $scores > 0)
                <div>
                    <p>میانگین رتبه مشاور </p>
                    <div>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $scores / count($comments)) <i
                                class="fas fa-star text-warning"></i>
                            @else
                                <i class="fas fa-star text-black-50 "></i>
                            @endif
                        @endfor
                    </div>
                    <p> از {{ $times }} دقیقه مشاوره</p>
                </div>
            @endif

            @if ($advisor->video)
                <h3 class="show-more-between-profile">با {{ $advisor->name }} از زبان ایشان بیشتر آشنا شوید </h3>
                <div id="video-parent-profile">
                    <video width="80%" height="380" style="border-radius: 10px" controls>
                        <source src="{{ asset($advisor->video) }}" type="video/mp4">
                    </video>
                </div>
            @endif

        </div>
        @if ($comments!=null)
            @if (count($comments))

                <div id="comments-moshaver-profile ">
                    <div class="footer-comments-profile ">
                        <p>آخرین نظرات کاربران در رابطه با علیرضا نیک مراد</p>
                    </div>
                    <div class="items-comments-profile border-0">

                        @forelse ($comments as $comment)
                            <div class="item-comment border-bottom-0">
                                <div class="right-comment-profile-single">
                                    <p class="comment-profile-value my-3 mx-2"
                                       style="font-size: 16px">{{ $comment->text }}</p>
                                    <div class="stars-profile-comments mb-3 mx-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $comment->score)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="fas fa-star text-black-50 "></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="left-comment-profile-single">
                                    <p class="title-date-profile" style="font-size: 14px">تاریخ: </p>
                                    <p class="create-comment-profile" style="font-size: 14px">
                                        {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('Y/m/d') }}
                                    </p>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                </div>
            @endif
        @endif
    </div>
@endsection
