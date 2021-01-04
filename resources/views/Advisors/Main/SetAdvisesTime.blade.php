@extends('layout.Advisors.template')
@section('title','پروفایل')
@section('style')
    <style>
        .none {
            display: none;
        }

        .pointer {
            cursor: pointer;
        }
        ::placeholder{
            opacity: 0.9;
        }

        .cardd-header{
            cursor: pointer;
        }
        .none{
            display: none;
        }
    </style>
    <!-- begin::datepicker -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/Web/lib/kamadatepicker/kamadatepicker.min.css') }}" />
    <!-- end::datepicker -->
    <!-- begin::clockpicker -->
    <link rel="stylesheet" href="{{ asset('vendor/vendors/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">
    <!-- end::clockpicker -->
@endsection
@section('content')
<div class="container-fluid">
    <!-- begin::page header -->
    <div class="page-header">
        <div>
            <h3>زمان های شما برای مشاوره</h3>

        </div>
    </div>
    <!-- end::page header -->
    <div class="card">
        <div class="card-body">
            <div class="alert alert-info alert-with-border alert-dismissible" role="alert">
                <i class="ti-alert m-l-10"></i> زمان های مشاوره ی شما به صورت پیش فرض به صورت {{ $TimeOfOneCosultation }} دقیقه ای تنظیم میشود، و متقاضیانِ مشاوره در صورت تمایل میتوانند، چندین زمان را برای مشاوره انتخاب کنند، در صورتی که جزو <a href="#" class="font-weight-bold">مشاوران VIP</a> می باشید میتوانید از طریق منوی  <a href="#" class="font-weight-bold"> تنظیمات </a> این کار را انجام بدهید.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="bio-form" action="{{ route('Advisors.SetAdvisesTime.create') }}" method="post">
                @csrf
                <div class="form-group d-flex justify-content-between">
                    <h5 class="card-title m-b-15">تعیین و افزودن زمان جهت مشاوره</h5>
                </div>
                <div class="form-group ">
                    <h6 class="mb-2">انتخاب تاریخ</h6>
                    <input name="Date" class="form-control" type="text" id="date3" style="width: 256px; height:42px;" value="{{ old('Date') }}" placeholder="جهت انتخاب تاریخ مشاوره، کلیک نمایید." autocomplete="off">
                    @error('Date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex form-group">
                    <div class="ml-3" style="max-width:240px;">
                        <h6 class="mb-2">شروع</h6>
                        <div class="input-group clockpicker-autoclose-demo">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            </div>
                            <input name="StartTime" class="form-control" value="{{ old('StartTime' , '08:30') }}" type="text" placeholder="8:30" autocomplete="off">
                        </div>
                        @error('StartTime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="" style="max-width:240px;">
                        <h6 class="mb-2">پایان</h6>
                        <div class="input-group clockpicker-autoclose-demo">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            </div>
                            <input name="EndTime" class="form-control" value="{{ old('EndTime' , '14:30') }}" type="text" placeholder="14:30" autocomplete="off">
                        </div>
                        @error('EndTime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-success  mt-3">افزودن</button>
            </form>
            <div class="form-group">
                <h5 class="card-title m-b-15 mt-4">زمان های ثبت شده ی شما {{ $ConsultationsTimes ? '(جهت نمایش کمتر/بیشتر روي عنوان تاريخ کلیک کنید.)' : '' }}</h5>
                <div class="table">
                    <div class="alert alert-info alert-with-border alert-dismissible" role="alert">
                        <i class="ti-alert m-l-10"></i> در بین زمان های هر تاریخ، رنگ سبز به معنای رزرو نشده، و رنگ قرمز به معنای رزرو شده توسط متقاضیانِ مشاوره می باشد.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @forelse ($ConsultationsTimes as $Date => $item)
                        <h6 class="bg-primary text-center p-2 cardd-header d-flex align-items-center justify-content-center">
                            <form action="{{ route('Advisors.SetAdvisesTime.delete') }}" method="post">
                                @csrf
                            {{-- @method('delete') --}}
                                <input type="hidden" name="Date" value="{{ $Date }}">
                                <button type="submit" class="btn btn-danger justify-content-self-start " href="">حذف</button>
                            </form>
                            <p class="mx-auto mb-0"> لیست زمانی شما برای تاریخ {{ $Date }}  <span class="fa fa-plus mr-2 text-white"></span></p>
                        </h6>
                        <div class="cardd-body none">
                            <div class="row">
                                @php
                                // dd($item);
                                sort($item);
                                @endphp
                        @forelse ($item as $values)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6 ">
                                {!! $values['Status'] == '1' ? '' : '<del class="text-danger">' !!}  {{ $values['Time'] .' - '. Carbon\Carbon::parse($values['Time'])->addMinutes($TimeOfOneCosultation)->format('H:i') }} {!! $values['Status'] == '1' ? '' : '</del>' !!}
                            </div>
                        @empty
                            <h6 class=" text-center p-2">موردی یافت نشد.</h6>
                        @endforelse
                            </div>
                        </div>
                    @empty
                        <h6 class=" text-center p-2">موردی یافت نشد.</h6>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/Web/lib/kamadatepicker/kamadatepicker.min.js') }}"></script>
<script>
    const HOLIDAYS = [
        { month: 1, day: 1 },
        { month: 1, day: 2 },
        { month: 1, day: 3 },
        { month: 1, day: 4 },
        { month: 1, day: 12 },
        { month: 1, day: 13 },
        { month: 3, day: 14 },
        { month: 3, day: 15 },
        { month: 11, day: 22 },
        { month: 12, day: 29 },
        { year: 1399, month: 1, day: 21 },
        { year: 1399, month: 2, day: 26 },
        { year: 1399, month: 3, day: 4 },
        { year: 1399, month: 3, day: 5 },
        { year: 1399, month: 3, day: 28 },
        { year: 1399, month: 5, day: 10 },
        { year: 1399, month: 5, day: 18 },
        { year: 1399, month: 6, day: 8 },
        { year: 1399, month: 6, day: 9 },
        { year: 1399, month: 7, day: 17 },
        { year: 1399, month: 7, day: 25 },
        { year: 1399, month: 7, day: 26 },
        { year: 1399, month: 8, day: 4 },
        { year: 1399, month: 8, day: 13 },
        { year: 1399, month: 10, day: 28 },
        { year: 1399, month: 12, day: 7 },
        { year: 1399, month: 12, day: 21 },
        { year: 1399, month: 12, day: 30 },
        { year: 1400, month: 1, day: 9 },
        { year: 1400, month: 2, day: 14 },
        { year: 1400, month: 2, day: 24 },
        { year: 1400, month: 2, day: 25 },
        { year: 1400, month: 3, day: 17 },
        { year: 1400, month: 4, day: 30 },
        { year: 1400, month: 5, day: 7 },
        { year: 1400, month: 5, day: 27 },
        { year: 1400, month: 5, day: 28 },
        { year: 1400, month: 7, day: 6 },
        { year: 1400, month: 7, day: 14 },
        { year: 1400, month: 7, day: 15 },
        { year: 1400, month: 7, day: 23 },
        { year: 1400, month: 8, day: 2 },
        { year: 1400, month: 10, day: 17 },
        { year: 1400, month: 11, day: 26 },
        { year: 1400, month: 12, day: 10 },
        { year: 1400, month: 12, day: 28 },
    ];
    kamaDatepicker('date3', {
          nextButtonIcon: "fas fa-arrow-circle-left"
        , previousButtonIcon: "fas fa-arrow-circle-right"
        , position: 'auto'
        , markToday: true
        , markHolidays: true
        , highlightSelectedDay: true
        , sync: true
        , pastYearsCount: 0
        , futureYearsCount: 1
        , swapNextPrev: true
        , holidays: HOLIDAYS
        , disableHolidays: true
        , gotoToday: true
        , closeAfterSelect: true
    });
</script>
<script src="{{ asset('vendor/vendors/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('vendor/js/examples/clockpicker.js') }}"></script>
@endsection
