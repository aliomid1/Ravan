@extends('layout.web.template')
@section('title', 'ورود - ثبت نام')
@section('content')
    <!-- Start page content -->
    <div class="topest-gap"></div>
    <!-- special thanks: https://www.freepik.es/ -->
    <section class="sign-in-section log-step" style="display: none">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="loginBox">
                <div class="my-4">
                    <h5>ورود / ثبت نام</h5>
                </div>
                <form action="{{route('Web.auth.Login.post')}}" method="POST">
                    @csrf
                    <div class="input-wrapper mb-4">
                        <label>شماره موبایل</label>
                        <input type="tel" name="mobile"  placeholder="شماره موبایل">
                    </div>
                    <div class="input-wrapper mb-4">
                        <label>کلمه عبور</label>
                        <input type="password" name="password">
                    </div>
                    <button type="submit" class=" btn btn-success">ورود</button>
                    <a href=" javascript:voide()" class="text-center d-block return-back">بازگشت</a>
                </form>
            </div>
        </div>
    </section>
    <section class="sign-in-section first-step">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="loginBox">
                <div class="my-4">
                    <h5>ورود / ثبت نام</h5>
                </div>
                <div class="input-wrapper mb-4">
                    <label> شماره موبایل خود را جهت ثبت نام یا ورود وارد کنید.</label>
                    <input type="tel" name="" id="mobile" placeholder="شماره موبایل">
                </div>
                <button type="button" class="send-code btn btn-success">ارسال کد تایید</button>
                <div class="text-center mt-4">
                    <a class="withpassword" href="#withpassword">ورود با کلمه عبور</a>
                </div>
            </div>
        </div>
    </section>
    <section class="sign-in-section confiirm-code none">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="loginBox">
                <div class="my-4">
                    <h5>ورود / ثبت نام</h5>
                </div>

                <form id="loginForm" action="{{ route('Web.auth.CheckCode') }}" method="post">
                    @csrf
                    <div class="input-wrapper mb-4">
                        <label>لطفا کد تایید ارسال شده را وارد کنید</label>
                        <input type="number" name="certif_code" placeholder=" کد تایید">
                    </div>
                    <input type="submit" name="" value="ثبت" ">
                                                            <a href=" javascript:voide()"
                        class="text-center d-block return-back">بازگشت</a>

                </form>
            </div>
        </div>
    </section>
    <!-- partial -->
    <!-- Guided by Brezo Lozano (https://codepen.io/brezo/pen/QejKVb) -->
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
@endsection
@section('js')
<script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
<script src="{{ asset('vendor/js/app.js') }}"></script>
<script src="{{ asset('assets/lib/message.js') }}"></script>
    <script>
        $('.send-code').click(function() {
            var item = $(this);
            item.attr('disabled', 'disabled');
            var mobile = $('#mobile').val();
            item.html(
                '<span class="spinner-grow spinner-grow-sm m-l-5" role="status" aria-hidden="true"></span>   در حال ارسال ...'
            );
            $.ajax({
                type: "POST",
                url: "{{ route('Web.auth.CheckUser') }}",
                data: {
                    mobile: mobile
                },
                success: function(res) {

                    if (res == true) {
                        $('section.first-step').fadeOut(320);
                        setTimeout(function() {
                            $('section.confiirm-code').fadeIn(320);
                        }, 320);
                        item.html('ارسال کد تایید');
                        item.removeAttr('disabled', 'disabled');
                    } else {
                        toastr.warning(res);
                        item.html('ارسال کد تایید');
                        item.removeAttr('disabled', 'disabled');
                    }
                }
            });

        });

    </script>
@endsection
