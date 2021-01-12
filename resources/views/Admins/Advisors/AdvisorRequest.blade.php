@section('title')
ليست مشاوران
@endsection
@extends('layout.Admins.template')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">

@endsection
@section('content')
<div class="topest-gap"></div>
<section class="advisor-request">
    <div class=" ">
        <div class="col-xl-12 mx-auto" >
            <h4 class="mb-4">فرم درخواست همکاری {{ $form['name'] . ' ' . $form['famil'] }}</h4>
            <div class="mb-4">
                <label>
                    <h6>از چه طريق با پورتال مشاوره آنلاين آشنا شده و تقاضای همکاری نموده ايد؟ *</h6>
                </label>
                <p>{{ $form['rahe_artabat'] ? $form['rahe_artabat'] : '-' }}</p>
            </div>
            <div class="mb-4">
                <label>
                    <h6>انگيزه خود را از تمايل به همکاری با پورتال  {{ env('SiteBrand') }}  بيان فرمائيد. *</h6>
                </label>
                <p>{{ $form['angize'] ? $form['angize'] : '-' }}</p>
            </div>
            <div class="main-title">
                <h4>اطلاعات شخصی :</h4>
            </div>
            <div class="mb-4 row">
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>نام *</h6>
                    </label>
                     <p>{{ $form['name'] ? $form['name'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>نام خانوادگی *</h6>
                    </label>
                    <p>{{ $form['famil'] ? $form['famil'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>جنسیت *</h6>
                    </label>
                    <p>{{ $form['gensiat'] ? $form['gensiat'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                    <label>
                        <h6>وضعیت تاهل *</h6>
                    </label>
                    <p>{{ $form['taahhol'] ? $form['taahhol'] : '-' }}</p>
                </div>
                <div class="mb-4 col-lg-3 col-md-4 col-sm-6">
                    <label>
                        <h6>تاریخ تولد : *</h6>
                    </label>
                    <div class="">
                        <p>{{ $form['rooz_tavallod'] ? $form['rooz_tavallod'] . ' / ' . $form['mah_tavallod'] . ' / ' . $form['sal_tavallod'] : '-' }}</p>
                    </div>
                </div>
                <div class="mb-4 col-lg-3 col-md-4 col-sm-6">
                    <label>
                        <h6>محل سکونت : *</h6>
                    </label>
                    <p>{{ $form['shahr_sokunat'] ? $form['shahr_sokunat'] : '-' }}</p>
                </div>
            </div>
            <div class="main-title">
                <h4>اطلاعات شغلی :</h4>
            </div>
            <div class="mb-4 row">
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>آیا در حال حاضر شاغل هستید؟ *</h6>
                    </label>
                    <p>{{ $form['vaziat_shoghl'] ? $form['vaziat_shoghl'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>نام محل کار : *</h6>
                    </label>
                    <p>{{ $form['name_kar'] ? $form['name_kar'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>نشانی محل کار : *</h6>
                    </label>
                    <p>{{ $form['mahal_kar'] ? $form['mahal_kar'] : '-' }}</p>
                </div>
            </div>
            <div class="main-title">
                <h4>مشخصات تماس : </h4>
            </div>
            <div class="mb-4 row">
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>آدرس محل سکونت:*</h6>
                    </label>
                    <p>{{ $form['adress_sokunat'] ? $form['adress_sokunat'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>پست الكترونيك : </h6>
                    </label>
                    <p>{{ $form['email'] ? $form['email'] : '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>تلفن ثابت : * </h6>
                    </label>
                    <p>{{ $form['telephon_sabet'] ? $form['telephon_sabet'] : '-' }}</p>
                </div>
                <div class=" col-md-6 form-group">
                    <label>
                        <h6>تلفن همراه : * </h6>
                    </label>
                    <p>{{ $form['telephone_hamrah'] ? $form['telephone_hamrah'] : '-' }}</p>
                </div>
            </div>
            <div class="main-title">
                <h4>سوابق تحصيلي : </h4>
            </div>
            <div class="mb-4 row">
                <div class=" col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>مدرك تحصيلي : *</h6>
                    </label>
                    <p>{{ $form['madrak_tahsil'] ? $form['madrak_tahsil'] : '-' }}</p>
                </div>
                <div class=" col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>رشته و گرايش تحصيلي : </h6>
                    </label>
                    <p>{{ $form['gerayesh_tahsil'] ? $form['gerayesh_tahsil'] : '-' }}</p>
                </div>
                <div class=" col-lg-3 col-md-4 form-group">
                    <label>
                        <h6>دانشگاه فارغ التحصيل (آخرين مدرك تحصيلي ) :  </h6>
                    </label>
                     <p>{{ $form['daneshgah'] ? $form['daneshgah'] : '-' }}</p>
                </div>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ميزان آشنايي با زبان انگليسي : * </h6>
                </label>
                <p>{{ $form['ashnaii_englisi'] ? $form['ashnaii_englisi'] : '-' }}</p>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ساير زبان های خارجی که ميدانيد و ميزان آشنايی خود را بيان فرماييد. </h6>
                </label>
                <p>{{ $form['sayere_zaban_ha'] ? $form['sayere_zaban_ha'] : '-' }}</p>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ميزان آشنايي با رايانه : * </h6>
                </label>
                <p>{{ $form['ashnaii_rayane'] ? $form['ashnaii_rayane'] : '-' }}</p>
            </div>
            <div class="mb-4">
                <label>
                    <h6>ساير مهارت ها، تخصص ها و اطلاعاتی که ممکن است در استخدام شما اثر مثبت داشته باشد.</h6>
                </label>
                <p>{{ $form['sayere_etelaat_mofid'] ? $form['sayere_etelaat_mofid'] : '-' }}</p>
            </div>
            <div class="mb-4">
                <label>
                    <h6>شرح مختصری از وظايف اصلی آخرين شغل: *</h6>
                </label>
                <p>{{ $form['vazayef_shoghl_ghabl'] ? $form['vazayef_shoghl_ghabl'] : '-' }}</p>
            </div>
            <div class="row">
                <div class="mb-4 col-md-6">
                    <label>
                        <h6>تاریخ آمادگي شروع به همكاري با ما : *</h6>
                    </label>
                    <p>{{ $form['rooz_shoru_kar_ba_ma'] ? $form['rooz_shoru_kar_ba_ma'] . ' / ' . $form['mah_shoru_kar_ba_ma']. ' / ' . $form['sal_shoru_kar_ba_ma'] : '-' }}</p>
                </div>
                <div class="mb-4 col-sm-6">
                    <label>
                        <h6>ميزان تعرفه پيشنهادی برای ارائه مشاوره اينترنتی بازای هر 1 ساعت: *</h6>
                    </label>
                    <p>{{ $form['tarefe_daghighe'] ? $form['tarefe_daghighe'] : '-' }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری رزومه شخصی:</h6>
                    </label>
                    <div>
                        @if ($form['resume'])
                            @if (is_array($form['resume']))
                                @foreach ($form['resume'] as $key => $item)
                                    <a href="{{ url($item) }}" class="btn btn-primary m-1">دانلود عکس {{ $loop->iteration }}</a>
                                @endforeach
                            @else
                                <a href="{{ url($form['resume']) }}" class="btn btn-primary m-1">دانلود عکس</a>
                            @endif
                        @endif  
                    </div>                     
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس مدرک تحصيلی:</h6>
                    </label>
                    <div>
                        @if ($form['madrak_tahsili'])
                            @if (is_array($form['madrak_tahsili']))
                                @foreach ($form['madrak_tahsili'] as $key => $item)
                                    <a href="{{ url($item) }}" class="btn btn-primary m-1">دانلود عکس  {{ $loop->iteration }}</a>
                                @endforeach
                            @else
                                <a href="{{ url($form['madrak_tahsili']) }}" class="btn btn-primary m-1">دانلود عکس</a>
                            @endif
                        @endif                    
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس پروانه اشتغال در صورت دارا بودن پروانه کار:</h6>
                    </label>
                    <div>
                        @if ($form['parvane_eshteghal'])
                            @if (is_array($form['parvane_eshteghal']))
                                @foreach ($form['parvane_eshteghal'] as $key => $item)
                                    <a href="{{ url($item) }}" class="btn btn-primary m-1">دانلود عکس  {{ $loop->iteration }}</a>
                                @endforeach
                            @else
                                <a href="{{ url($form['parvane_eshteghal']) }}" class="btn btn-primary m-1">دانلود عکس</a>
                            @endif
                        @endif  
                    </div>                     
                </div>
                <div class="col-md-6 mb-4">
                    <label>
                        <h6>بارگذاری عکس ترجيحا (3*4): *</h6>
                    </label>
                    <div>
                        @if ($form['aks'])
                            @if (is_array($form['aks']))
                                @foreach ($form['aks'] as $key => $item)
                                    <a href="{{ url($item) }}" class="btn btn-primary m-1">دانلود عکس  {{ $loop->iteration }}</a>
                                @endforeach
                            @else
                                <a href="{{ url($form['aks']) }}" class="btn btn-primary m-1">دانلود عکس</a>
                            @endif
                        @endif  
                    </div>                    
                </div>
                <a href="{{ route('Admins.AdvisorsRequestList') }}" class=" btn btn-danger mt-5">بازگشت</a>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{asset('vendor/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/examples/datatable.js')}}"></script>
@include('components.ajax.delete')
@endsection
