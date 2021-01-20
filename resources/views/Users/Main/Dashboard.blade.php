@extends('layout.Users.template')
@section('title', 'داشبورد')
    @php

    $Services = json_decode(\App\Models\HomePage::first()->services, true);
    if (!is_array($Services) && !is_object($Services)) {
    $Services = [];
    }
    $Conversations = \App\Models\Conversation::where('user_id',Auth::guard('web')->user()->id)->paginate(5);
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

        .pagination .page-item.active .page-link {
            color: #fff!important;
        }

        .page-link {
            color: #3f51b5 !important;
        }

        .display-4 {
            font-size: 2.4rem;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/lib/rating/starability-minified/starability-all.min.css') }}"/>
@endsection

@section('content')
    @if ($NotCommented)
        <div class="modal fade not_commented" id="not_commented" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <form action="{{ route('Users.AddCommentedConversation') }}" method="post">
                        @csrf
                        <input type="hidden" name="NotCommentedId" value="{{ $NotCommented->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ثبت نظر</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            <div class="form-group d-flex flex-column align-items-center">
                                <img class="rounded-circle mb-2" src="{{ url($NotCommented->Advisor && $NotCommented->Advisor->Profile  ? $NotCommented->Advisor->Profile->url : '') }}" alt="مشکلی پیش آمده" style="width: 166px; height:166px;">
                                <h5 class="text-center mb-2">{{ $NotCommented->Advisor->name }}</h5>
                                <p class="text-center mb-3">لطفا نظر خود را در مورد مشاوره ی خود با ایشان بیان کنید.</p>
                                    <!-- Change starability-basic to different class to see animations. -->
                                    <fieldset class="starability-basic form-group">
                                    <h5 class="text-center">میزان رضایت شما</h5>

                                    <input type="radio" id="rate1" name="rating" value="1"/>
                                    <label for="rate1">1 star.</label>

                                    <input type="radio" id="rate2" name="rating" value="2" />
                                    <label for="rate2">2 stars.</label>

                                    <input type="radio" id="rate3" name="rating" value="3"  />
                                    <label for="rate3">3 stars.</label>

                                    <input type="radio" id="rate4" name="rating" value="4" />
                                    <label for="rate4">4 stars.</label>

                                    <input type="radio" id="rate5" name="rating" value="5" required checked/>
                                    <label for="rate5">5 stars.</label>
                                    <span class="starability-focus-ring"></span>
                                    </fieldset>
                                    <!-- guided by https://github.com/LunarLogic/starability/blob/f3b34818d6b704465278f69dde506c78a6a6f444/README.md#how-to-use -->
                                    <textarea class="form-control" name="text" cols="30" rows="5" placeholder="متن نظر شما در مورد مشاور (اختیاری)"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Users.NoCommentedConversation' , $NotCommented->id) }}" class="btn btn-secondary">تمایلی به ثبت نظر ندارم.</a>
                            <button type="submit" class="btn btn-primary">ثبت نظر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-md-12 mt-5" style="display: flex;flex-direction: column;">
                <div class="card px-5 py-5">
                    <div style="display: flex;" class="items-user-dashbord row">
                        <div class="col-md-4">
                            <div class="card m-b-30 bg-dark-gradient">
                                <div class="card-body text-white">
                                    <div class="text-center">
                                        <div class="display-4 font-weight-800 p-t-20">
                                            {{ $Conversations->where('status', 'done')->sum('time') }} دقیقه
                                        </div>
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
                                        <div class="display-4 font-weight-800 p-t-20">
                                            {{ $Conversations->where('status', 'to_do')->sum('time') }} دقیقه
                                        </div>
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
                                        <div class="display-4 font-weight-800 p-t-20">
                                            {{ number_format($Wallet->sum('amount')) }} تومان
                                        </div>
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
                                    <th>نوع مشاوره</th>
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
                                    case 'doing':
                                    $status='درحال انجام';
                                    break;
                                    }
                                    $type = '';
                                    switch ($item->type) {
                                    case 'out':
                                    $type='حضوری';
                                    break;
                                    case 'chat':
                                    $type='در لحظه';
                                    break;
                                    case 'online':
                                    $type='انلاین';
                                    break;
                                    case 'in':
                                    $type='تلفنی';
                                    break;
                                    }
                                    @endphp
                                    <tr>
                                        <td>{{ $item->Advisor->name }}</td>
                                        <td>{{ $type }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('d M Y') }}</td>
                                        <td>{{ $item->time }} دقیقه</td>
                                        <td>{{ number_format($item->price) }} تومان</td>
                                        <td>{{ $status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">هنور موردی ثبت نشده</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $Conversations->links() }}
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
    @if ($NotCommented)
        <script>
            $('#not_commented').modal('show');
        </script>
    @endif
@endsection
