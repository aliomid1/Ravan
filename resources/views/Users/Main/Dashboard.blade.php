@extends('layout.Users.template')
@section('title', 'داشبورد')
    @php

    $Services = json_decode(\App\Models\HomePage::first()->services, true);
    if (!is_array($Services) && !is_object($Services)) {
    $Services = [];
    }
    $Conversations = \App\Models\Conversation::where('user_id',Auth::guard('web')->user()->id)->get();
    $Wallet = \App\Models\Wallet::where('user_id',Auth::guard('web')->user()->id)->get();
    @endphp
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/Web/css/style.css') }}">
    <style>
        li.link-items:after {
            content: ' ';
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            left: 2px;
            height: 70%;
            width: 5px;
            border-radius: 0 11px 11px 0;
            background-color: #56d4a5;
        }

        .display-4 {
            font-size: 2.4rem;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-md-12 mt-5" style="display: flex;flex-direction: column;">
                <div class="card px-5 py-5">
                    <div style="display: flex;" class="items-user-dashbord row">
                        <div class="col-md-4">
                            <div class="card m-b-30 bg-dark-gradient">
                                <div class="card-body text-white">
                                    <div class="text-center">
                                        <div class="display-4 font-weight-800 p-t-20">{{$Conversations->where('status','done')->sum('time')}} دقیقه</div>
                                        <p class="opacity-7 p-t-10">
                                            تعداد مشاوره های انجام شده
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card m-b-30 bg-dark-gradient">
                                <div class="card-body text-white">
                                    <div class="text-center">
                                        <div class="display-4 font-weight-800 p-t-20">{{$Conversations->where('status','to_do')->sum('time')}} دقیقه</div>
                                        <p class="opacity-7 p-t-10">
                                            مشاوره های رزرو شده
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card m-b-30 bg-dark-gradient">
                                <div class="card-body text-white">
                                    <div class="text-center">
                                        <div class="display-4 font-weight-800 p-t-20">{{number_format($Wallet->sum('amount'))}} تومان</div>
                                        <p class="opacity-7 p-t-10">
                                            کیف پول شما
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <h4 class="my-5">تاریخچه مشاوره های شما</h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>نام مشاور</th>
                                    <th>موضوع مشاوره</th>
                                    <th>تاریخ</th>
                                    <th>دقیقه</th>
                                    <th>هزینه</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Conversations as $item)
                                    @php
                                    $status = '';
                                    switch ($item->status) {
                                    case 'done':
                                    $status='انجام شده';
                                    break;
                                    case 'to_do':
                                    $status='هنوز انجام نشده';
                                    break;
                                    }
                                    @endphp
                                    <tr>
                                        <td>{{ $item->Advisor->name }}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('d M Y') }}</td>
                                        <td>{{ $item->time }} دقیقه</td>
                                        <td>{{number_format($item->price)}} تومان</td>
                                        <td>{{$status}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">هنور موردی ثبت نشده</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="landing-section">
                    <div class="row px-3 px-xl-0">
                        <div class=" alternates pl-md-5 order-last order-md-first ">

                            <div class=" mr-xl-auto px-0">

                                <ul class="items row justify-content-around">
                                    @forelse ($Services as $item)
                                        <li class=" position-relative col-md-5">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <div class="img d-flex justify-content-center align-items-center">
                                                <span></span>
                                            </div>
                                            <div class="text" class="text">
                                                <h1 class="text-black1">
                                                    {{ isset($item['title']) ? $item['title'] : '' }}
                                                </h1>
                                                <h2 class="text-light1">
                                                    {{ isset($item['short_desc']) ? $item['short_desc'] : '' }}
                                                </h2>
                                            </div>
                                            <a href="{{ isset($item['link']) ? asset($item['link']) : '#' }}"
                                                class="entry-link"></a>
                                        </li>
                                    @empty
                                        <h5> </h5>
                                    @endforelse
                                </ul>
                            </div>

                        </div>

                </section>
            </div>
        </div>
    </div>
@endsection



@section('js')

@endsection
