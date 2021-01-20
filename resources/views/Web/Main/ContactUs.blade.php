@extends('layout.web.template')
@section('title','درباره ما')
@section('content')
    <div id="main-contact" class="row">
        <div class="col-md-4 col-lg-6 col-sm-12 col-xs-12" id="right-contact">
            <div id="mail-contact">
                <img style="width:5rem" src="{{ asset('assets/Web/images/email.svg') }}" alt="">
                <a href="#">{{ $ContactUs->email }}</a>
            </div>

            <div id="number-contact">
                <img style="width:5rem" src="{{ asset('assets/Web/images/Phone.svg') }}" alt="">
                <a href="#">{{ $ContactUs->phone }}</a>
            </div>

            <div id="location-contact">
                <img style="width:5rem" src="{{ asset('assets/Web/images/location.svg') }}" alt="">
                <p id="adress-contact">{{ $ContactUs->address }}</p>
            </div>

        </div>

        <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12" id="parent-left-contact">
            <div id="sms-contact">
                <h2 id="pleas-send-sms">پیامتان را برای ما ارسال کنید</h2>
                <div class="container">
                    <input placeholder="نام" type="text" name="" id="" class="form-control input-property">
                    <input placeholder="ایمیل" type="text" name="" id="" class="form-control input-property">
                    <textarea placeholder="متن پیام" name="" class="form-control input-property" id="" cols="30" rows="5"></textarea>
                    <button id="btn-contact-send" class="form-control btn btn-success btn-block py-2">ارسال پیام</button>
                </div>
            </div>
        </div>

    </div>
@endsection

