@extends('layout.Users.template')
@section('title', 'پروفایل')
@section('style')
    <style>
        .none {
            display: none;
        }

        .pointer {
            cursor: pointer;
        }

        ::placeholder {
            opacity: 0.9;
        }

    </style>
@endsection
@section('content')
    @php
    $settings = \App\Models\Settings::first();
    // dd(auth()->User(),$settings);
    @endphp
    <div class="container-fluid">
        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>پروفایل</h3>
            </div>
        </div>
        @php
        $user = \App\User::get();
        @endphp
        <div class="row">
            <div class="col-xl-11 col-12 m-auto">
                @if ($settings->verify_email == 'on')
                    @if (auth()->User()->verify_email != 'ok')
                        @include('Users.Main.verifyemail')
                    @else
                        @include('Users.settings.Profile')
                    @endif
                @else
                    @include('Users.settings.Profile')
                @endif
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>
        //  Form Validation
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);






    $("#image").on("change", function() {
        $(".form-image").submit();
        $(this).siblings('p').addClass('disabled').html(
            '<span class="spinner-border spinner-border-sm m-l-5" role="status" aria-hidden="true"> </span> در حال بارگزاری...'
            );
        $(this).parent().attr('for', '');
    });
    $('.form-image').submit(function(e) {
        e.preventDefault();
        data = new FormData();
        var image = $("#image").prop('files')[0];
        data.append('image', image);
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data: data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 'false') {
                    toastr.warning('درخواست کامل نبود');
                } else {
                    $('.advisor_profile').attr('src', "{{ asset('/') }}" +
                        response);
                }
                $('#image').siblings('p').children('span').removeClass(
                    'spinner-border , spinner-border-sm , m-l-5');
                $('#image').siblings('p').removeClass('disabled').text('ویرایش عکس پروفایل');
                $('#image').parent().attr('for', 'image');
            }
        });
    });        
    </script>
@endsection
