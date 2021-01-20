@extends('layout.Admins.template')
@section('title','پشتیبانی')
@section('content')


<div class="container-fluid">

    <div class="col-md-12 edit_layout" style="">
        <h4>ویرایش صفحه تماس با ما</h4>
        <form action="{{ route('Admins.ContactUs.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body row">
                    <div class="form-group col-md-6">
                        <label>ایمیل</label>
                        <input type="text" name="email" class="form-control" value="{{ $ContactUs->email }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>تلفن</label>
                        <input type="text" name="phone"  class="form-control" value="{{ $ContactUs->phone }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>آدرس</label>
                        <input type="text" name="address"  class="form-control" value="{{ $ContactUs->address }}">
                    </div>
                    <div class="text-right col-12">
                        <button type="submit" class="btn btn-primary">ثبت
                            ویرایش</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
    <script>
            if ($('#customFile').length) {
            $(function () {
                btn = $('#customFile');
                img = $('#image');

                btn.on('click', function () {
                    img.animate({
                        opacity: 0
                    }, 300);
                });

                btn.on('change', function (e) {
                    var i = 0;
                    for (i; i < e.originalEvent.srcElement.files.length; i++) {
                        var file = e.originalEvent.srcElement.files[i],
                            reader = new FileReader();
                        reader.onloadend = function () {
                            img.attr('src', reader.result).animate({
                                opacity: 1
                            }, 700);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        }
        // Guided by Elisabeth Hamel (https://codepen.io/elisabeth_hamel/pen/QjRgRr)
    </script>
@include('components.ajax.delete')
@endsection
