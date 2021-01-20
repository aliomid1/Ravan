@extends('layout.web.template')
@section('title','ورود - پنل')
@push('style')

@endpush
@section('content')

<section class="sign-in-section first-step " style="margin-top: 8rem;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="loginBox">
            <form action="{{route('Admins.Login.post')}}" method="POST">
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
