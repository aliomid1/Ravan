@extends('layout.Advisors.template')
@section('title', 'پروفایل')


@section('style')
    <style>
        .none {
            display: none;
        }

        .pointer {
            cursor: pointer;
        }

        ::placeholder {
            opacity: 0.9;
        }

    </style>
    <!-- begin::datepicker -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/Web/lib/kamadatepicker/kamadatepicker.min.css') }}" />
    <script src="{{ asset('assets/Web/lib/kamadatepicker/kamadatepicker.min.js') }}"></script>
    <!-- end::datepicker -->
    <!-- begin::clockpicker -->
    <link rel="stylesheet" href="{{ asset('vendor/vendors/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">
    <!-- end::clockpicker -->
@endsection

@section('content')
    @php
    $Advisor = Auth::guard('advisor')->User();
    $Advisor_id = Auth::guard('advisor')->User()->id;
    $Advisor_Conversation = \App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,
    'done')->get();
    $Advisor_Comment = \App\Models\Comment::where('advisor_id' , $Advisor_id)->where('status' , 'on')->get();
    $Advisor_Image = \App\Models\Image::where('item_id' , $Advisor_id)->where('type' , 'profile_advisor')->first();
    $Advisor_Networks = unserialize($Advisor->networks);
    // dd($Advisor->networks);
    // dd($Advisor_Networks);
    $educations = json_decode(Auth::guard('advisor')->User()->education , true);
    if (!is_array($educations) && !is_object($educations)) {
    $educations =[];
    }
    @endphp



    <div class="container-fluid">
        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>پروفایل</h3>
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="#">صفحات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">پروفایل</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
        <!-- end::page header -->
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top advisor_profile"
                    style="object-fit: cover;
                    height: 300px;"
                        src="{{ $Advisor_Image ? asset($Advisor_Image->url) : asset('assets/avatar.jpg') }}"
                        alt="...">
                    <div class="card-body text-center m-t-70-minus">
                        <figure class="avatar avatar-xl m-b-20">
                            <img class="card-img-top advisor_profile rounded-circle"
                                src="{{ $Advisor_Image ? asset($Advisor_Image->url) : asset('assets/avatar.jpg') }}"
                                alt="...">
                        </figure>
                        <h5>{{ $Advisor->name }}</h5>
                        <p class="text-muted small">مشاور</p>
                        <form class="form-image" data-url="{{ route('Advisors.ProfileImage.update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <label for="image">
                                <p class="btn px-3 py-2 btn-primary">
                                    ویرایش عکس پروفایل
                                </p>
                                {{-- <p class="btn btn-outline-primary pointer">
                                    <i class="fa fa-pencil m-l-5"></i> ویرایش عکس پروفایل
                                </p> --}}

                                <input id="image" class="none" type="file" name="image">
                            </label>
                            <h6 class="text-danger text-center">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </h6>
                        </form>
                        <div class="row m-t-30">
                            <div class="col-6 text-success">
                                <h5 class="primary-font">
                                    {{ $Advisor_Conversation->count() }}
                                </h5>
                                <span>تعداد مشاوره</span>
                            </div>
                            <div class="col-6 text-success">
                                <h5 class="primary-font">
                                    {{ $Advisor_Comment ? $Advisor_Comment->avg('score') : 'نظري ثبت نشده است' }}
                                </h5>
                                <span> میانگین رضایت از 5</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card px-2 py-3">
                    @if ($Advisor->video)
                        <video class="w-100 mx-auto" height="280" controls>
                            <source src="{{ asset($Advisor->video) }}">
                        </video>
                    @else
                        <h6 class="text-center">دیدئویی بارگزاری نشده است</h6>
                    @endif
                    <form class="form-video" action="{{ route('Advisors.ProfileVideo.update') }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="video" class="d-flex justify-content-center mt-3">
                            <p class="btn px-3 py-2 btn-outline-primary">
                                افزودن / ویرایش ویدئو
                            </p>
                            <input id="video" class="none" type="file" name="video">
                            <button type="submit" class="btn px-3 mx-1 py-2 btn-outline-danger" style="height: 44px">حذف ویدئو</button>
                        </label>
                        <h6 class="text-danger text-center">
                            @error('video')
                                {{ $message }}
                            @enderror
                        </h6>
                    </form>
                </div>
            </div>

            <div class="col-md-8">

                <form class="" action="{{ route('Advisors.ProfileInfo.update') }}" method="post" novalidate>
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                اطلاعات
                            </h5>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">نام و نام خانوادگي <span class="text-danger mr-1">*</span>
                                </div>
                                <div class="col-sm-8"> <input class="form-control" name="name" type="text"
                                        value="{{ Auth::guard('advisor')->User()->name }}" placeholder="نام و نام خانوادگي">
                                    <span class="text-danger mt-1 d-block">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">نام كاربري <span class="text-danger mr-1">*</span>
                                </div>
                                <div class="col-sm-8"><input class="form-control" name="username" type="text"
                                        value="{{ Auth::guard('advisor')->user()->username }}" placeholder="نام كاربري">
                                    <span class="text-danger mt-1 d-block">
                                        @error('username')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">ایمیل <span class="text-danger mr-1">*</span></div>
                                <div class="col-sm-8"><input class="form-control" name="email" type="email"
                                        value="{{ Auth::guard('advisor')->User()->email }}" placeholder="ایمیل">
                                    <span class="text-danger mt-1 d-block">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">شماره موبايل <span class="text-danger mr-1">*</span>
                                </div>
                                <div class="col-sm-8"><input class="form-control" name="mobile" type="text"
                                        value="{{ Auth::guard('advisor')->User()->mobile }}" placeholder="شماره موبايل">
                                    <span class="text-danger mt-1 d-block">
                                        @error('mobile')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">تلفن ثابت</div>
                                <div class="col-sm-8"> <input class="form-control" name="tel" type="text"
                                        value="{{ Auth::guard('advisor')->User()->tel }}" placeholder="تلفن ثابت">
                                    <span class="text-danger mt-1 d-block">
                                        @error('tel')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">آدرس</div>
                                <div class="col-sm-8"> <input class="form-control" name="address" type="text"
                                        value="{{ Auth::guard('advisor')->User()->address }}" placeholder="آدرس محل کار">
                                    <span class="text-danger mt-1 d-block">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک آدرس تلگرام (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="telegram"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['telegram']) ? $Advisor_Networks['telegram'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('telegram')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک آدرس اینستاگرام (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="instagram"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['instagram']) ? $Advisor_Networks['instagram'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('instagram')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک واتساپ (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="whatsapp"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['whatsapp']) ? $Advisor_Networks['whatsapp'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('whatsapp')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک فیسبوک (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="facebook"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['facebook']) ? $Advisor_Networks['facebook'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('facebook')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک لینکدین (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="linkdin"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['linkdin']) ? $Advisor_Networks['linkdin'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('linkdin')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">لینک میلیتو (اختیاری)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip02" name="mailito"
                                        type="text"
                                        value="{{ isset($Advisor_Networks['mailito']) ? $Advisor_Networks['mailito'] : '' }}"
                                        placeholder="آدرس لینک">
                                    <span class="text-danger mt-1 d-block">
                                        @error('mailito')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">نرخ هر دقیقه مشاوره شما (تومان)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip01" name="price"
                                        type="text" value="{{ Auth::guard('advisor')->user()->price }}"
                                        placeholder="نرخ هر دقیقه مشاوره شما (تومان)">
                                    <span class="text-danger mt-1 d-block">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">رمز عبور جديد</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip01" name="password"
                                        type="password" placeholder="رمز عبور">
                                    <span class="text-danger mt-1 d-block">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 text-muted">تکرار رمز عبور (تاییدیه)</div>
                                <div class="col-sm-8"> <input class="form-control" id="validationTooltip01"
                                        name="password_confirmation" type="password" placeholder="تکرار رمز عبور">
                                    <span class="text-danger mt-1 d-block">
                                        @error('password_confirmation')
                                            {{ $message . '!' }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-success offset-sm-4 offset-6">ويرايش</button>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <form class="bio-form" action="{{ route('Advisors.ProfileBio.update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <h5 class="card-title m-b-15">بیوگرافی</h5>
                                <textarea name="bio"
                                    class="form-control">{{ Auth::guard('advisor')->User()->bio }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="table table-responsive">
                                    <h5 class="mb-0 mt-4 card-title">تحصیلات</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>تخصص</th>
                                                <th>مدرک تحصیلی</th>
                                                <th>محل تحصیل</th>
                                                <th>تاریخ فارغ التحصیلی</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($educations as $item)
                                                <tr>
                                                    <td><input type="text" name="education[{{ $loop->index }}][skill]"
                                                            value="{{ $item['skill'] }}" class="form-control" placeholder="تخصص"
                                                            required></td>
                                                    <td><input type="text" name="education[{{ $loop->index }}][certification]"
                                                            value="{{ $item['certification'] }}" class="form-control"
                                                            placeholder="مدرک تحصیلی" required></td>
                                                    <td><input type="text" name="education[{{ $loop->index }}][location]"
                                                            value="{{ $item['location'] }}" class="form-control"
                                                            placeholder="محل تحصیل" required></td>
                                                    <td><input type="text" name="education[{{ $loop->index }}][date]"
                                                            value="{{ $item['date'] }}" class="form-control"
                                                            placeholder="تاریخ فارغ التحصیلی" required>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td><input type="text" name="education[0][skill]" class="form-control"
                                                            placeholder="تخصص" required></td>
                                                    <td><input type="text" name="education[0][certification]"
                                                            class="form-control" placeholder="مدرک تحصیلی" required></td>
                                                    <td><input type="text" name="education[0][location]" class="form-control"
                                                            placeholder="محل تحصیل" required></td>
                                                    <td><input type="text" name="education[0][date]" class="form-control"
                                                            placeholder="تاریخ فارغ التحصیلی" required></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <a href="javascript:void()" class="add-row btn btn-primary mx-1">افزودن
                                                        ردیف جدید</a>
                                                    <a href="javascript:void()" class="remove-row btn btn-danger mx-1">حذف
                                                        آخرین ردیف</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5 class="card-title m-b-15 mt-4">رزومه</h5>
                                <textarea name="resume" class="form-control"
                                    placeholder="لطفا سابقه ی فعالیت خود را بنویسید.">{{ Auth::guard('advisor')->User()->resume }}</textarea>
                            </div>
                            <button class="btn btn-success  mt-3">ويرايش</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')

<script>
    $("#image").on("change", function() {
        $(".form-image").submit();
        $(this).siblings('p').addClass('disabled').html(
            '<span class="spinner-border spinner-border-sm m-l-5" role="status" aria-hidden="true"> </span> در حال بارگزاری...'
            );
        $(this).parent().attr('for', '');
    });
    $('.form-image').submit(function(e) {
        e.preventDefault();
        data = new FormData();
        var image = $("#image").prop('files')[0];
        data.append('image', image);
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data: data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 'false') {
                    toastr.warning('درخواست کامل نبود');
                } else {
                    $('.advisor_profile').attr('src', "{{ asset('/') }}" +
                        response);
                }
                $('#image').siblings('p').children('span').removeClass(
                    'spinner-border , spinner-border-sm , m-l-5');
                $('#image').siblings('p').removeClass('disabled').text('ویرایش عکس پروفایل');
                $('#image').parent().attr('for', 'image');
            }
        });
    });


    $("#video").on("change", function() {
        $(".form-video").submit();
        $(this).siblings('p').children('span').addClass('spinner-border');
        $(this).siblings('p').addClass('disabled').html(
            '<span class="spinner-border spinner-border-sm m-l-5" role="status" aria-hidden="true"></span> در حال بارگزاری...'
            );
        $(this).parent().attr('for', '');
    });
    // $('.form-video').submit(function(e) {
    //     e.preventDefault();
    //     data = new FormData();
    //     var video = $("#video").prop('files')[0];
    //     data.append('video', video);
    //     $.ajax({
    //         type: "POST",
    //         url: $(this).data('url'),
    //         data: data,
    //         enctype: 'multipart/form-data',
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(response) {
    //             if (response == 'false') {
    //                 // alert('hi');
    //                 toastr.warning('درخواست کامل نبود');
    //             } else {
    //                 $('.advisor_profile').attr('src', "{{ asset('/') }}" +
    //                     response);
    //             }
    //             $('#video').siblings('p').children('span').removeClass('');
    //             $('#video').parent().attr('for', 'video');
    //             $('#video').siblings('p').removeClass('disabled').append(' افزودن / ویرایش ویدئو');
    //         }
    //     });
    // });

</script>

<!-- begin::datepicker -->
<script>
    const HOLIDAYS = [{
            month: 1,
            day: 1
        },
        {
            month: 1,
            day: 2
        },
        {
            month: 1,
            day: 3
        },
        {
            month: 1,
            day: 4
        },
        {
            month: 1,
            day: 12
        },
        {
            month: 1,
            day: 13
        },
        {
            month: 3,
            day: 14
        },
        {
            month: 3,
            day: 15
        },
        {
            month: 11,
            day: 22
        },
        {
            month: 12,
            day: 29
        },
        {
            year: 1399,
            month: 1,
            day: 21
        },
        {
            year: 1399,
            month: 2,
            day: 26
        },
        {
            year: 1399,
            month: 3,
            day: 4
        },
        {
            year: 1399,
            month: 3,
            day: 5
        },
        {
            year: 1399,
            month: 3,
            day: 28
        },
        {
            year: 1399,
            month: 5,
            day: 10
        },
        {
            year: 1399,
            month: 5,
            day: 18
        },
        {
            year: 1399,
            month: 6,
            day: 8
        },
        {
            year: 1399,
            month: 6,
            day: 9
        },
        {
            year: 1399,
            month: 7,
            day: 17
        },
        {
            year: 1399,
            month: 7,
            day: 25
        },
        {
            year: 1399,
            month: 7,
            day: 26
        },
        {
            year: 1399,
            month: 8,
            day: 4
        },
        {
            year: 1399,
            month: 8,
            day: 13
        },
        {
            year: 1399,
            month: 10,
            day: 28
        },
        {
            year: 1399,
            month: 12,
            day: 7
        },
        {
            year: 1399,
            month: 12,
            day: 21
        },
        {
            year: 1399,
            month: 12,
            day: 30
        },
        {
            year: 1400,
            month: 1,
            day: 9
        },
        {
            year: 1400,
            month: 2,
            day: 14
        },
        {
            year: 1400,
            month: 2,
            day: 24
        },
        {
            year: 1400,
            month: 2,
            day: 25
        },
        {
            year: 1400,
            month: 3,
            day: 17
        },
        {
            year: 1400,
            month: 4,
            day: 30
        },
        {
            year: 1400,
            month: 5,
            day: 7
        },
        {
            year: 1400,
            month: 5,
            day: 27
        },
        {
            year: 1400,
            month: 5,
            day: 28
        },
        {
            year: 1400,
            month: 7,
            day: 6
        },
        {
            year: 1400,
            month: 7,
            day: 14
        },
        {
            year: 1400,
            month: 7,
            day: 15
        },
        {
            year: 1400,
            month: 7,
            day: 23
        },
        {
            year: 1400,
            month: 8,
            day: 2
        },
        {
            year: 1400,
            month: 10,
            day: 17
        },
        {
            year: 1400,
            month: 11,
            day: 26
        },
        {
            year: 1400,
            month: 12,
            day: 10
        },
        {
            year: 1400,
            month: 12,
            day: 28
        },
    ];
    kamaDatepicker('date3', {
        nextButtonIcon: "fas fa-arrow-circle-left",
        previousButtonIcon: "fas fa-arrow-circle-right",
        position: 'auto' // top, bottom or auto
            // , forceFarsiDigits: true
            ,
        markToday: true,
        markHolidays: true,
        highlightSelectedDay: true,
        sync: true,
        pastYearsCount: 0,
        futureYearsCount: 1,
        swapNextPrev: true,
        holidays: HOLIDAYS // from kamadatepicker.holidays.js
            ,
        disableHolidays: true,
        gotoToday: true,
        closeAfterSelect: true
    });

</script>
<!-- end::datepicker -->

<!-- begin::clockpicker -->
<script src="{{ asset('vendor/vendors/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('vendor/js/examples/clockpicker.js') }}"></script>
<!-- end::clockpicker -->
<!-- begin::CKEditor -->
{{-- <script src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}">
</script>
<script src="{{ asset('vendor/js/examples/ckeditor.js') }}"></script> --}}
<!-- end::CKEditor -->


@endsection
