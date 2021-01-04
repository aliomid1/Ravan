@extends('layout.Admins.template')
@section('title')
ویرایش مقاله
@endsection
@section('content')

<div class="container-fluid">

    <div class="col-md-12 edit_layout" style="">
        <h4>ویرایش : {{ $blog->title }}</h4>
        <form action="{{ route('Admins.Blogs.update', $blog->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>دسته بندی</label>
                        <div class="d-flex">
                            @forelse($Category as $item)
                                <div class="ml-4 d-flex align-items-center">
                                    <p class="ml-2 mb-0">{{ $item->title }}: </p>
                                    <input class="form-control" type="checkbox" value="{{ $item->title }}" name="category[{{ $item->title }}]"
                                    {{ in_array($item->title , $SelectedCat) ? 'checked' : '' }}
                                    style=" width: 19px;">
                                </div>
                            @empty
                                <p class="text-center text-danger">موردی یافت نشد</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group">
                        <label>عنوان </label>
                        <input class="form-control" required type="text" value="{{ $blog->title }}" name="title">
                    </div>

                    <div class="form-group  ">
                        <label>عکس</label>
                        <div class="custom-file">
                            <input type="file" class="image custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">انتخاب
                                عکس</label>
                        </div>
                        @if($image)
                            <div class="row justify-content-center mt-3">
                                <img id="image" class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                    src="{{ asset($image->url) }}" alt="عکسی انتخاب نشده است">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>توضیحات مختصر</label>
                        <textarea name="short_desc" required class="form-control" rows="5">{{ $blog->short_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea name="description" required class="form-control ck_text_editor"
                            rows="5">{{ $blog->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>کلمات کلیدی</label>
                        <textarea name="keywords"  class="form-control" rows="2">{{ $blog->keywords }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>توضیحات سئو</label>
                        <textarea name="description_seo"  class="form-control" rows="2">{{ $blog->description_seo }}</textarea>
                    </div>
                    <div class="text-left">
                        <a href="{{ route('Admins.Blogs.index') }}" class="btn btn-warning text-white cancel">انصراف</a>
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
<script src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/js/examples/ckeditor.js') }}"></script>
<script type="text/javascript">
    if ($('.ck_text_editor').length) {
        var editors = $('.ck_text_editor');
        $.each(editors, function (i, item) {
            CKEDITOR.replace(item, {
                filebrowserUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token() ]) }}",
                filebrowserImageUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token() ]) }}",
                height: 200
            });
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
    // Guided by Elisabeth Hamel (https://codepen.io/elisabeth_hamel/pen/QjRgRr)
</script>
@endsection
