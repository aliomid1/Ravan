@section('title')
 افزودن دسته بندی مقالات
@endsection
@extends('layout.Admins.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <h5 class="card-title">افزودن دسته بندی مقالات</h5>
                <form class="" action="{{ route('Admins.BlogsCategories.store') }}" novalidate=""
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label>عنوان دسته </label>
                            <input type="text" class="form-control" required name="title">
                        </div>


                    </div>
                    <div class="form-row ">
                        <div class="col-md-12 mb-3">
                            <label>کلمات کلیدی سئو</label>
                            <input type="text" class="form-control" required name="keywords_seo">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> توضیحات سئو</label>
                            <textarea name="description_seo" class="form-control" required rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center border-top pt-3 mt-4">
                        <button class="btn btn-success" type="submit">ثبت دسته</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
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
    });

</script>
@endsection
