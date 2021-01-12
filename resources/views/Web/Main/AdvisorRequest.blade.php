@extends('layout.web.template')
@@section('title', 'فرم ثبت نام مشاور')



@section('style')
<style>
    label{
        margin-bottom: 0 !important;
    }
</style>
@endsection



@section('content')
<div class="topest-gap"></div>
<section class="advisor-request">
    <div class="container ">
        <form action="{{ route('Web.AdvisorRequestPost') }}" class="col-xl-11 mx-auto" method="post" enctype="multipart/form-data">
            <h4>فرم درخواست همکاری روانشناسان</h4>
            <h6 class="text-muted mb-4">لطفا فرم ذیل را ب دقت تکمیل فرمایید تا پس از بررسی درخواست در صورت صلاحدید در اولین
                فرصت با شما تماس گرفته شود.</h6>
            @csrf
            <div class="mb-4">
                <label>
                    <h6>از چه طريق با پورتال مشاوره آنلاين آشنا شده و تقاضای همکاری نموده ايد؟ *</h6>
                </label>
                <select class="form-control" name="rahe_artabat" required>
                    <option value="">انتخاب كنيد....</option>
                    <option value="اینترنت">اینترنت</option>
                    <option value="مراکز شماوره و روانشناسی">مراکز مشاوره و روانشناسی</option>
                    <option value="دوستان">دوستان و همکاران</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>
            <div class="mb-4">
                <label>
                    <h6>انگيزه خود را از تمايل به همکاری با پورتال  {{ env('SiteBrand') }}  بيان فرمائيد. *</h6>
                </label>
                <textarea class="form-control" name="angize" rows="7" placeholder="انگيزه خود را بيان كنيد"></textarea>
            </div>
            <div class="main-title">
                <h4>اطلاعات شخصی :</h4>
            </div>
            <div class="mb-4 row">
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>نام *</h6>
                    </label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>نام خانوادگی *</h6>
                    </label>
                    <input type="text" name="famil" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>جنسیت *</h6>
                    </label>
                    <select class="form-control" name="gensiat" required>
                        <option value="">انتخاب کنید</option>
                        <option value="مرد">مرد</option>
                        <option value="زن">زن</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>وضعیت تاهل *</h6>
                    </label>
                    <select class="form-control" name="taahhol">
                        <option value="">انتخاب کنید</option>
                        <option value="مجرد">مجرد</option>
                        <option value="متاهل">متاهل</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 ">
                <label>
                    <h6>تاریخ تولد : *</h6>
                </label>
                <div class="row">
                    <div class="d-flex flex-column mx-2" style="width:88px">
                        <input class="form-control mb-1" name="rooz_tavallod" type="text" required>
                        <label>
                            <h6 class="text-center">روز</h6>
                        </label>
                    </div>
                    <div class="d-flex flex-column mx-2" style="width:88px">
                        <input class="form-control mb-1" name="mah_tavallod" type="text" required>
                        <label>
                            <h6 class="text-center">ماه</h6>
                        </label>
                    </div>
                    <div class="d-flex flex-column mx-2" style="width:88px">
                        <input class="form-control mb-1" name="sal_tavallod" type="text" required>
                        <label>
                            <h6 class="text-center">سال</h6>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label>
                    <h6>محل سکونت : *</h6>
                </label>
                <input type="text" class="form-control" name="shahr_sokunat" placeholder="تهران / ...." required>
            </div>
            <div class="main-title">
                <h4>اطلاعات شغلی :</h4>
            </div>
            <div class="mb-4 row">
                <div class="col-lg-4 col-md-6 form-group">
                    <label>
                        <h6>آیا در حال حاضر شاغل هستید؟ *</h6>
                    </label>
                    <select class="form-control" name="vaziat_shoghl" required>
                        <option value="">انتخاب کنید...</option>
                        <option value="بله">بله</option>
                        <option value="خیر">خیر</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <label>
                        <h6>نام محل کار : *</h6>
                    </label>
                    <input type="text" class="form-control" name="name_kar" placeholder="نام محل کار خود را وارد کنید." required>
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <label>
                        <h6>نشانی محل کار : *</h6>
                    </label>
                    <input type="text" class="form-control" name="mahal_kar" placeholder="نشاني محل كر خود را وارد كنيد." required>
                </div>
            </div>
            <div class="main-title">
                <h4>مشخصات تماس : </h4>
            </div>
            <div class="mb-4 row">
                <div class=" col-md-6 form-group">
                    <label>
                        <h6>آدرس محل سکونت:*</h6>
                    </label>
                    <input type="text" class="form-control" name="adress_sokunat" placeholder="آدرس محل سكونت خود را وارد كنيد." required>
                </div>
                <div class=" col-md-6 form-group">
                    <label>
                        <h6>پست الكترونيك : </h6>
                    </label>
                    <input type="text" class="form-control" name="email" placeholder="پست الكترونيك خود را وارد كنيد." >
                </div>
                <div class=" col-md-6 form-group">
                    <label>
                        <h6>تلفن ثابت : * </h6>
                    </label>
                    <input type="text" class="form-control" name="telephon_sabet" placeholder="021........." required>
                </div>
                <div class=" col-md-6 form-group">
                    <label>
                        <h6>تلفن همراه : * </h6>
                    </label>
                    <input type="text" class="form-control" name="telephone_hamrah" placeholder="شماره تلفن همراه خود را وارد كنيد." required>
                </div>
            </div>
            <div class="main-title">
                <h4>سوابق تحصيلي : </h4>
            </div>
            <div class="mb-4 row">
                <div class=" col-lg-4 col-sm-6 form-group">
                    <label>
                        <h6>مدرك تحصيلي : *</h6>
                    </label>
                    <input type="text" class="form-control" name="madrak_tahsil" placeholder="مدرك تحصيلي خود را بيان كنيد." required>
                </div>
                <div class=" col-lg-4 col-sm-6 form-group">
                    <label>
                        <h6>رشته و گرايش تحصيلي : </h6>
                    </label>
                    <input type="text" class="form-control" name="gerayesh_tahsil" placeholder="رشته و گرايش تحصيلي خود را بيان كنيد.">
                </div>
                <div class=" col-lg-4 col-sm-6 form-group">
                    <label>
                        <h6>دانشگاه فارغ التحصيل (آخرين مدرك تحصيلي ) :  </h6>
                    </label>
                    <input type="text" class="form-control" name="daneshgah"
                        placeholder="دانشگاه فارغ التحصيل (آخرين مدرك تحصيلي ) خود را بيان كنيد." >
                </div>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ميزان آشنايي با زبان انگليسي : * </h6>
                </label>
                <select class="form-control" name="ashnaii_englisi" required>
                    <option value="">انتخاب كنيد...</option>
                    <option value="زیاد">زياد</option>
                    <option value="متوسط">متوسط</option>
                    <option value="کم">كم</option>
                </select>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ساير زبان های خارجی که ميدانيد و ميزان آشنايی خود را بيان فرماييد. </h6>
                </label>
                <textarea class="form-control" name="sayere_zaban_ha" rows="7"
                    placeholder="ساير زبان های خارجی که ميدانيد و ميزان آشنايی خود را بيان فرماييد."></textarea>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ميزان آشنايي با رايانه : * </h6>
                </label>
                <select class="form-control" name="ashnaii_rayane" required>
                    <option value="">انتخاب كنيد...</option>
                    <option value="خوب">خوب</option>
                    <option value="متوسط">متوسط</option>
                    <option value="ضعیف">ضعيف</option>
                </select>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ساير مهارت ها، تخصص ها و اطلاعاتی که ممکن است در استخدام شما اثر مثبت داشته باشد.</h6>
                </label>
                <textarea class="form-control" name="sayere_etelaat_mofid" rows="7"
                    placeholder="ساير مهارت ها، تخصص ها و اطلاعاتی که ممکن است در استخدام شما اثر مثبت داشته باشد را وارد نماييد."></textarea>
            </div>
            <div class="mb-4">
                <label>
                    <h6>شرح مختصری از وظايف اصلی آخرين شغل: *</h6>
                </label>
                <textarea class="form-control" name="vazayef_shoghl_ghabl" rows="7"
                    placeholder="شرح مختصری از وظايف اصلی آخريرين شغل وارد نماييد." required></textarea>
            </div>
            <div class="row">
                <div class="mb-4 col-md-6">
                    <label>
                        <h6>تاریخ آمادگي شروع به همكاري با ما : *</h6>
                    </label>
                    <div class="row">
                        <div class="d-flex flex-column mx-2 " style="width:88px">
                            <input class="form-control mb-1" name="rooz_shoru_kar_ba_ma" type="text" required>
                            <label>
                                <h6 class="text-center">روز</h6>
                            </label>
                        </div>
                        <div class="d-flex flex-column mx-2" style="width:88px">
                            <input class="form-control mb-1" name="mah_shoru_kar_ba_ma" type="text" required>
                            <label>
                                <h6 class="text-center">ماه</h6>
                            </label>
                        </div>
                        <div class="d-flex flex-column mx-2" style="width:88px">
                            <input class="form-control mb-1" name="sal_shoru_kar_ba_ma" type="text" required>
                            <label>
                                <h6 class="text-center">سال</h6>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-sm-6">
                    <label>
                        <h6>ميزان تعرفه پيشنهادی برای ارائه مشاوره اينترنتی بازای هر 1 ساعت: *</h6>
                    </label>
                    <input class="form-control" type="text" name="tarefe_daghighe" placeholder="مثال : 50 هزار تومان" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس رزومه شخصی:</h6>
                    </label>
                    <input name="resume[]" type="file" multiple>
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس مدرک تحصيلی:</h6>
                    </label>
                    <input name="madrak_tahsili[]" type="file" multiple>
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس پروانه اشتغال در صورت دارا بودن پروانه کار:</h6>
                    </label>
                    <input name="parvane_eshteghal[]" type="file" multiple>
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس از خود ترجيحا (3*4): *</h6>
                    </label>
                    <input name="aks[]" type="file" required multiple>
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>اينجانب پاسخ ها و اظهارات مندرج در اين فرم را تأييد می نمايم. *</h6>
                    </label>
                    <div class="d-flex">
                        <input type="radio" name="taiid" value="بله" required><label class="mr-2">بله</label>
                    </div>
                    <div class="d-flex">
                        <input type="radio" name="taiid" value="خیر"><label class="mr-2">خير</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input class="btn-submit" type="image"
                    src="{{ asset('assets/Web/images/button-g.png') }}" name="" value="">
            </div>
        </form>
    </div>
</section>
@endsection



@section('js')

@endsection
