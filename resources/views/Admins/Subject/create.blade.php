@section('title')
ایجاد موضوع
@endsection
@extends('layout.Admins.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <h5 class="card-title">افزودن موضوع</h5>
                <form class="" action="{{route('Admins.Subject.store')}}"  method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>دسته بندی</label>
                        <div class="d-flex">
                            @forelse(\App\Models\Category::get() as $item)
                                <div class="ml-4 d-flex align-items-center">
                                    <p class="ml-2 mb-0">{{ $item->title }}: </p>
                                    <input class="form-control" type="checkbox" value="{{ $item->title }}"
                                        name="category_id[{{ $item->title }}]" style=" width: 19px;">
                                </div>
                            @empty
                                <p class="text-center text-danger">موردی یافت نشد</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>عنوان موضوع </label>
                            <input type="text" class="form-control" required name="title">
                        </div>

                        {{-- <div class="col-md-4 mb-3">
                            <label>دسته ی موضوع</label>
                            <select name="category" required class="form-control">
                                <option value="">انتخاب کنید</option>
                                @forelse (\App\Models\Category::get() as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div> --}}

                        <div class=" col-md-6 mx-auto  ">
                            <label>عکس</label>
                            <div class="custom-file">
                                <input type="file" class="image custom-file-input" name="image" id="customFile">
                                <label class="custom-file-label" for="customFile">انتخاب
                                    عکس</label>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <img id="image"
                                    class=" mx-auto"
                                    src="" alt="عکسی انتخاب نشده است">
                            </div>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-md-12 mb-3">
                            <label> توضیحات</label>
                            <textarea name="description" class="form-control" required rows="4"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>کلمات کلیدی سئو</label>
                            <input type="text" class="form-control" required name="keywords_seo">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> توضیحات سئو</label>
                            <textarea name="description_seo" class="form-control" required rows="4"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> اطلاعات بیشتر</label>
                            <textarea name="page" class="form-control ck_text_editor" required rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center border-top pt-3 mt-4">
                        <button class="btn btn-success" type="submit">ثبت موضوع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
@php
    $folder='Subject-'.\App\Models\Subject::count();
@endphp
<script src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/js/examples/ckeditor.js') }}"></script>
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
<script type="text/javascript">
    if ($('.ck_text_editor').length) {
        var editors = $('.ck_text_editor');
        $.each(editors, function (i, item) {
         var cik =   CKEDITOR.replace(item, {
                filebrowserUploadUrl: "{{route('CKEDITOR', ['_token' => csrf_token()  ])}}",
                filebrowserImageUploadUrl: "{{route('CKEDITOR', ['_token' => csrf_token() ])}}",
                height: 500
            });
            console.log(cik);
        });
    }

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
</script>

@endsection
