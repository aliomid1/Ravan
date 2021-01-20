@section('title')
ویرایش اطلاعات مشاور
@endsection
@extends('layout.Admins.template')


@section('style')
<style>
    .none {
        display: none;
    }

    .pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('content')



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

        {{-- <div class="col-md-4">
            <div class="card">
                <img class="card-img-top advisor_profile"
                    src="{{ $Advisor_Image?asset($Advisor_Image->url):asset('vendor/media/image/doctor.jpg') }}"
                    alt="...">
                <div class="card-body text-center m-t-70-minus">
                    <figure class="avatar avatar-xl m-b-20">
                        <img class="card-img-top advisor_profile rounded-circle"
                            src="{{ $Advisor_Image?asset($Advisor_Image->url):asset('vendor/media/image/doctor.jpg') }}"
                            alt="...">
                    </figure>
                    <h5>/h5>
                    <p class="text-muted small">مشاور</p>
                    <form class="form-image" data-url="{{ route('Advisors.ProfileImage.update')}}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="image">
                            <p class="btn px-3 py-2 btn-primary">
                                ویرایش عکس پروفایل
                            </p>
                            <input id="image" class="none" type="file" name="image">
                        </label>
                        <h6 class="text-danger text-center">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </h6>
                    </form>
                    <div class="row m-t-30">
                        <div class=" text-success">
                            <h5 class="primary-font">
                                {{ $Advisor_Conversation->count() }}
                            </h5>
                            <span>تعداد مشاوره</span>
                        </div>
                        <div class=" text-success">
                            <h5 class="primary-font">
                                {{ $Advisor_Comment?$Advisor_Comment->avg('score'):'نظري ثبت نشده است' }}
                            </h5>
                            <span> میانگین رضایت از 5</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
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
                    </label>
                    <h6 class="text-danger text-center">
                        @error('video')
                            {{ $message }}
                        @enderror
                    </h6>
                </form>
            </div>
        </div> --}}

        <div class="col-md-8 mx-auto">

            <form class="" action="{{ route('Admins.Advisors.store') }}" method="post" novalidate>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            اطلاعات
                        </h5>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">نام و نام خانوادگي <span
                                    class="text-danger mr-1">*</span></div>
                            <div class=" col-sm-8"> <input class="form-control" name="name" type="text"
                                    value="{{ old('name') }}" placeholder="نام و نام خانوادگي">
                                <span class="text-danger mt-1 d-block">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">نام كاربري <span class="text-danger mr-1">*</span>
                            </div>
                            <div class=" col-sm-8"><input class="form-control" name="username" type="text"
                                    value="{{ old('username') }}" placeholder="نام كاربري">
                                <span class="text-danger mt-1 d-block">
                                    @error('username')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">ایمیل <span class="text-danger mr-1">*</span></div>
                            <div class=" col-sm-8"><input class="form-control" name="email" type="email"
                                    value="{{ old('email') }}" placeholder="ایمیل">
                                <span class="text-danger mt-1 d-block">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">شماره موبايل <span class="text-danger mr-1">*</span>
                            </div>
                            <div class=" col-sm-8"><input class="form-control" name="mobile" type="text"
                                    value="{{ old('mobile') }}" placeholder="شماره موبايل">
                                <span class="text-danger mt-1 d-block">
                                    @error('mobile')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">رمز عبور جديد <span class="text-danger mr-1">*</span></div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip01"
                                    name="password" type="password" placeholder="رمز عبور">
                                <span class="text-danger mt-1 d-block">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">تکرار رمز عبور (تاییدیه) <span class="text-danger mr-1">*</span></div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip01"
                                    name="password_confirmation" type="password" placeholder="تکرار رمز عبور">
                                <span class="text-danger mt-1 d-block">
                                    @error('password_confirmation')
                                        {{ $message . '!' }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">تلفن ثابت</div>
                            <div class=" col-sm-8"> <input class="form-control" name="tel" type="text"
                                    value="{{ old('tel') }}" placeholder="تلفن ثابت">
                                <span class="text-danger mt-1 d-block">
                                    @error('tel')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">آدرس</div>
                            <div class=" col-sm-8"> <input class="form-control" name="address" type="text"
                                    value="{{ old('address') }}" placeholder="آدرس محل کار">
                                <span class="text-danger mt-1 d-block">
                                    @error('address')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک آدرس تلگرام (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="telegram" type="text"
                                    value="{{ old('telegram') }}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('telegram')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک آدرس اینستاگرام (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="instagram" type="text"
                                    value="{{ old('instagram') }}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('instagram')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک واتساپ (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="whatsapp" type="text"
                                    value="{{ old('whatsapp') }}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('whatsapp')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک فیسبوک (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="facebook" type="text"
                                    value="{{ old('facebook')}}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('facebook')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک لینکدین (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="linkdin" type="text"
                                    value="{{ old('linkdin') }}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('linkdin')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-sm-4 text-muted">لینک میلیتو (اختیاری)</div>
                            <div class=" col-sm-8"> <input class="form-control" id="validationTooltip02"
                                    name="mailito" type="text"
                                    value="{{ old('mailito') }}"
                                    placeholder="آدرس لینک">
                                <span class="text-danger mt-1 d-block">
                                    @error('mailito')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="px-4">
                            <button class="btn btn-success offset-sm-4 offset-6">ويرايش</button>
                        </div>
                    </div>
                </div>
                <p class="text-center bg-white p-2">افزودن یا ویرایش اطلاعات بیش تر در پنل مشاور امکان پذیر می باشد.</p>
            </form>
            {{-- <div class="card">
                <div class="card-body">
                    <form class="bio-form" action="{{ route('Advisors.ProfileBio.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <h5 class="card-title m-b-15">بیوگرافی</h5>
                            <textarea name="bio"
                                class="form-control">/textarea>
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
                                            <td><input type="text" name="education[0][skill]"
                                                    value="{{ $item['skill'] }}" class="form-control" placeholder="تخصص"
                                                    required></td>
                                            <td><input type="text" name="education[0][certification]"
                                                    value="{{ $item['certification'] }}" class="form-control"
                                                    placeholder="مدرک تحصیلی" required></td>
                                            <td><input type="text" name="education[0][location]"
                                                    value="{{ $item['location']  }}" class="form-control"
                                                    placeholder="محل تحصیل" required></td>
                                            <td><input type="text" name="education[0][date]" value="{{ $item['date'] }}"
                                                    class="form-control" placeholder="تاریخ فارغ التحصیلی" required>
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
                                placeholder="لطفا سابقه ی فعالیت خود را بنویسید.">/textarea>
                        </div>
                        <button class="btn btn-success  mt-3">ويرايش</button>
                    </form>

                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection



@section('js')
<script src="{{ asset('assets/WEb/js/custom.js') }}"></script>
<script>
    $("#image").on("change", function () {
            $(".form-image").submit();
            $(this).siblings('p').addClass('disabled').html('<span class="spinner-border spinner-border-sm m-l-5" role="status" aria-hidden="true"> </span> در حال بارگزاری...');
            $(this).parent().attr('for' , '');
    });
    $('.form-image').submit(function (e) {
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
                success: function (response) {
                    if (response == 'false') {
                        toastr.warning('درخواست کامل نبود');
                    } else {
                        $('.advisor_profile').attr('src', "{{ asset('/') }}" +
                        response);
                    }
                    $('#image').siblings('p').children('span').removeClass('spinner-border , spinner-border-sm , m-l-5');
                    $('#image').siblings('p').removeClass('disabled').text('ویرایش عکس پروفایل');
                    $('#image').parent().attr('for' , 'image');
                }
        });
    });
      
    
    $("#video").on("change", function () {
        $(".form-video").submit();
        $(this).siblings('p').children('span').addClass('spinner-border');
        $(this).siblings('p').addClass('disabled').html('<span class="spinner-border spinner-border-sm m-l-5" role="status" aria-hidden="true"></span> در حال بارگزاری...');
        $(this).parent().attr('for' , '');
    });
    $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data: data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 'false') {
                        // alert('hi');
                        toastr.warning('درخواست کامل نبود');
                } else {
                    $('.advisor_profile').attr('src', "{{ asset('/') }}" +
                    response);
                }
                $('#video').siblings('p').children('span').removeClass('');
                $('#video').parent().attr('for' , 'video');
                $('#video').siblings('p').removeClass('disabled').append(' افزودن / ویرایش ویدئو');
            }
    });
</script>
<!-- begin::CKEditor -->
{{-- <script src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}">
</script>
<script src="{{ asset('vendor/js/examples/ckeditor.js') }}"></script> --}}
<!-- end::CKEditor -->


@endsection