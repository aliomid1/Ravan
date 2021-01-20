@extends('layout.web.template')
@section('content')
    @php
    $typefa ='';
    switch ($type) {
    case 'chat':
    $typefa ='انلاین';
    break;
    case 'online':
    $typefa ='انلاین';
    break;
    case 'in':
    $typefa ='تلفنی';
    break;
    case 'out':
    $typefa ='حضوری';
    break;
    }
    $settings = \App\Models\Settings::find(1);
    $advisor = \App\Models\Advisors::find($id);
    $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
    $price2 = $advisor->price ? $advisor->price : $settings->price_default;
    $price = ($time * $price2);
    $price22 = $price + (($price * $settings->percent) / 100);
    @endphp
    <div class="topest-gap"></div>

    <section class="sign-in-section log-step">
        <div class="container d-flex justify-content-center align-items-center">
            <form action="{{route('SubmitPaymentType')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="key" value="{{ $key }}">
                <input type="hidden" name="date" value="{{ $date }}">

                <div class="">
                    <h4 class="my-4">درخواست مشاوره {{ $typefa }}</h4>
                    <h5 class="my-4">مشاور : {{ $advisor->name }}</h5>
                    <div class="">
                        <div class="form-group">
                            <label for="my-input">موضوع مشاوره</label>
                            <input id="my-input" class="form-control" type="text" name="subject" required>
                        </div>
                    </div>
                    <h6 class="my-4">زمان مشاوره : {{ $time }} دقیقه</h6>
                    <h6 class="my-4">هزینه هر دقیقه مشاوره : {{ number_format($price2) }} تومان</h6>
                    <h6 class="my-4">هزینه خدمات : {{ number_format((($price * $settings->percent) / 100)) }} تومان</h6>
                    <h6 class="my-4">هزینه کل مشاوره : {{ number_format($price22) }} تومان</h6>
                    <div class="row ">
                        <div class="col-12 my-4">
                            <label for="">روش پرداخت را انتخاب کنید</label>
                        </div>
                        <div class="col-md-4 my-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="typepayment" checked value="wallet" class="custom-control-input"
                                    id="customControlValidation212" name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation212">کیف پول</label>
                            </div>
                            <p class="mr-2">موجودی کیف پول شما : <span>{{number_format(Auth::guard('web')->user()->Wallet->sum('amount'))}}</span> تومان</p>
                        </div>
                        <div class="col-md-4 my-2">

                            <div class="custom-control custom-radio">
                                <input type="radio" name="typepayment" checked value="payir" class="custom-control-input"
                                    id="customControlValidation21" name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation21">PAY.IR</label>
                            </div>
                        </div>
                        <div class="col-md-4 my-2">

                            <div class="custom-control custom-radio">
                                <input type="radio" name="typepayment" value="ZARINPAL" class="custom-control-input"
                                    id="customControlValidation22"  name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation22">ZARINPAL</label>
                            </div>
                        </div>
                        <div class="col-md-4 my-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="typepayment" value="idpay" class="custom-control-input"
                                    id="customControlValidation2" name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation2">IDPAY</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-success mt-4 mx-auto">پرداخت</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
