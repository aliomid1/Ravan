@extends('layout.Advisors.template')
@section('title', 'داشبورد')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="col-12">
            <h3 class="mx-5 my-5">خلاصه</h3>
        </div>
            <div class="row justify-content-center align-items-stretch">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center justify-content-center m-b-10">
                                        <div class="icon-block icon-block-outline-success icon-block-floating m-l-20">
                                            <i class="ti-clipboard"></i>
                                        </div>
                                        <h2 class="m-b-0 text-success font-weight-800 primary-font">
                                            {{ $Conversation->count() }}
                                        </h2>
                                    </div>
                                    <p>تعداد کل مشاوره ها</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center justify-content-center m-b-10">
                                        <div class="icon-block icon-block-outline-success icon-block-floating m-l-20">
                                            <i class="ti-timer"></i>
                                        </div>
                                        <h2 class="m-b-0 text-success font-weight-800 primary-font">
                                            {{ $Conversation->sum('time') }}
                                        </h2>
                                    </div>
                                    <p>کل مشاوره ها به دقیقه</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center justify-content-center m-b-10">
                                        <div class="icon-block icon-block-outline-success icon-block-floating m-l-20">
                                            <i class="ti-server"></i>
                                        </div>
                                        <h2 class="m-b-0 text-success font-weight-800 primary-font">
                                            {{ number_format($Income30) }} تومان </h2>
                                    </div>
                                    <p>درآمد ۳۰ روز قبل</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center justify-content-center m-b-10">
                                        <div class="icon-block icon-block-outline-warning icon-block-floating m-l-20">
                                            <i class="ti-wallet"></i>
                                        </div>
                                        <h2 class="m-b-0 text-warning font-weight-800 primary-font">
                                            {{ number_format($Transections->sum('price')) }} تومان
                                        </h2>
                                    </div>
                                    <p>درآمد کل </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="card ">
                        <div class="card-body text-center m-t-70-minus" >

                            <figure class="avatar avatar-xl m-b-20">
                                <img class="card-img-top advisor_profile rounded-circle"
                                    src="{{ $Advisor_Image ? asset($Advisor_Image->url) : asset('vendor/media/image/doctor.jpg') }}"
                                    alt="...">
                            </figure>
                            <h4>{{$Advisor->name}}</h4>
                            @if ($Timem>0)
                            <div id="circle-1"  class="circle m-b-10"></div>
                            <div class="m-b-10 text-muted">روز های باقی ماده از پلن شما</div>
                            <h3 class="font-weight-bold primary-font">{{ $Timem }}</h3>
                            @else
                            <div>
                                <h5>شما هنوز پلن فعال ندارید</h5>
                                <p>پلن های vip را میتوانید هم اکنون تهیه کنید</p>
                                <a href="{{ route('Advisors.BuyPlan') }}" class="btn btn-primary">پلن های vip</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body"><iframe class="chartjs-hidden-iframe" tabindex="-1"
                            style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">نمودار درآمد</h5>
                                <h6 class="card-subtitle">نمودار درامد در ۱۰ روز اخیر</h6>
                            </div>
                        </div>
                        <canvas id="chart_demo_4" width="1014" height="506"
                            style="display: block; height: 253px; width: 507px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('js')

    <script src="{{ asset('vendor/vendors/charts/chart.min.js') }}"></script>
    <script src="{{ asset('vendor/vendors/charts/sparkline.min.js') }}"></script>
    <script src="{{ asset('vendor/vendors/circle-progress/circle-progress.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            Chart.defaults.global.defaultFontFamily =
                '"primary-font", "segoe ui", "tahoma"';

            var chartColors = {
                primary: {
                    base: '#3f51b5',
                    light: '#c0c5e4'
                },
                danger: {
                    base: '#f2125e',
                    light: '#fcd0df'
                },
                success: {
                    base: '#0acf97',
                    light: '#cef5ea'
                },
                warning: {
                    base: '#ff8300',
                    light: '#ffe6cc'
                },
                info: {
                    base: '#00bcd4',
                    light: '#e1efff'
                },
                dark: '#37474f',
                facebook: '#3b5998',
                twitter: '#55acee',
                linkedin: '#0077b5',
                instagram: '#517fa4',
                whatsapp: '#25D366',
                dribbble: '#ea4c89',
                google: '#DB4437',
                borderColor: '#e8e8e8',
                fontColor: '#999'
            };

            if ($('body').hasClass('dark')) {
                chartColors.borderColor = 'rgba(255, 255, 255, .1)';
                chartColors.fontColor = 'rgba(255, 255, 255, .4)';
            }

            function chart_demo_4() {
                if ($('#chart_demo_4').length) {
                    var ctx = document.getElementById("chart_demo_4").getContext("2d");
                    var densityData = {
                        backgroundColor: chartColors.primary.light,
                        data: [{{$Income}}]
                    };
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                "روز اول",
                                "روز دوم",
                                "روز سوم",
                                "روز چهارم",
                                "روز پنجم",
                                "روز ششم",
                                "روز هفتم",
                                "روز هشتم",
                                "روز نهم",
                                "امروز",
                            ],
                            datasets: [densityData]
                        },
                        options: {
                            scaleFontColor: "#FFFFFF",
                            legend: {
                                display: false,
                                labels: {
                                    fontColor: chartColors.fontColor
                                }
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        color: chartColors.borderColor
                                    },
                                    ticks: {
                                        fontColor: chartColors.fontColor
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        color: chartColors.borderColor
                                    },
                                    ticks: {
                                        fontColor: chartColors.fontColor,

                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            }

            chart_demo_4();
            if ($('#circle-1').length) {
                $('#circle-1').circleProgress({
                    startAngle: 1.55,
                    value: {{$Timem>0?$Timeplan>0?($Timem /$Timeplan):0:0}},
                    size: 100,
                    fill: {
                        color: "{{ $Timem < $Timeplan / 3 ? ($Timem < 3 ? '#f2125e' : '#ff8300') : '#0acf97' }}"
                    }
                });
            }

        });

    </script>
    <!-- end::chart -->
@endsection
