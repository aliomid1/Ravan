@extends('layout.web.template')
@section('title','ورود - ثبت نام')
@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" type="text/css">
@endsection
@section('content')
<section class="sign-in-section first-step " style="margin-top: 8rem;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="loginBox">
            <form action="{{route('Advisors.auth.Login.post')}}" method="POST">
                @csrf
                <h5 class="my-4">ورود به حساب کاربری</h5>
                <div class="input-wrapper mb-4">
                    <label>نام کاربری</label>
                    <input type="text" name="username" placeholder="نام کاربری">
                </div>
                <div class="input-wrapper mb-4">
                    <label>کلمه عبور</label>
                    <input type="password" name="password" placeholder="کلمه عبور">
                </div>
                <input class="send-code btn btn-success" type="submit" name="" value="ورود">
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <script src="{{ asset('vendor/js/app.js') }}"></script>
@endsection
