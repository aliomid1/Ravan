@extends('layout.web.template')
@section('title', 'ورود ناشناس')
@section('content')

    <!-- Start page content -->
    <div class="topest-gap"></div>
    <!-- special thanks: https://www.freepik.es/ -->
    <section class="sign-in-section first-step">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="loginBox">
                <h5 class="mb-5 mt-3">ورود به صورت ناشناس</h5>
                <form action="{{ route('Web.Anonymous.store') }}" method="POST">
                    @csrf
                    <div class="input-wrapper mb-4">
                        <label> شماره موبایل خود را جهت ورود وارد کنید.</label>
                        <input type="number" name="mobile" id="mobile" placeholder="شماره موبایل">
                    </div>
                    <input type="submit" value="ورود">
                </form>
            </div>
        </div>
    </section>

@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" type="text/css">
@endsection
@section('js')
    <script src="{{ asset('vendor/vendors/bundle.js') }}"></script>
    <script src="{{ asset('vendor/js/app.js') }}"></script>
    <script src="{{ asset('assets/lib/message.js') }}"></script>
@endsection
