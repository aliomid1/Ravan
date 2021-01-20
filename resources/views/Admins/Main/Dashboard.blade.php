@extends('layout.Admins.template')
@section('title', 'داشبورد')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12">
                <div class="card overflow-hidden bg-dark-gradient">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center m-b-10">
                            <div class="icon-block icon-block-outline-white icon-block-floating m-l-20">
                                <i class="ti-user"></i>
                            </div>
                            <h2 class="m-b-0 text-white font-weight-800 primary-font">{{ $Advisors->count() }}</h2>
                        </div>
                        <p>تعداد مشاوران</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card overflow-hidden bg-dark-gradient">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center m-b-10">
                            <div class="icon-block icon-block-outline-white icon-block-floating m-l-20">
                                <i class="ti-user"></i>
                            </div>
                            <h2 class="m-b-0 text-white font-weight-800 primary-font">{{ $Users->count() }}</h2>
                        </div>
                        <p>تعداد كاربران</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card overflow-hidden bg-dark-gradient">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center m-b-10">
                            <div class="icon-block icon-block-outline-white icon-block-floating m-l-20">
                                <i class="ti-server"></i>
                            </div>
                            <h2 class="m-b-0 text-white font-weight-800 primary-font">{{number_format((($trxg->sum('price')/10)*$settings->percent)/100)}} </h2>
                            تومان
                        </div>
                        <p>كل سود شما </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card col-lg-11">
                <div class="card-body"><iframe class="chartjs-hidden-iframe" tabindex="-1"
                        style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">نمودار درآمد</h5>
                            <h6 class="card-subtitle">نمودار درامد سی روز اخیر</h6>
                        </div>

                    </div>
                    <canvas id="chart_demo_4" width="1014" height="506"
                        style="display: block; height: 253px; width: 507px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="{{ asset('vendor/vendors/charts/chart.min.js') }}"></script>
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
                    densityData.data.reverse();
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                                '6',
                                '7',
                                '8',
                                '9',
                                '10',
                                '11',
                                '12',
                                '13',
                                '14',
                                '15',
                                '16',
                                '17',
                                '18',
                                '19',
                                '20',
                                '21',
                                '22',
                                '23',
                                '24',
                                '25',
                                '26',
                                '27',
                                '28',
                                '29',
                                '30',
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
        });

    </script>
@endsection
