@extends('layout.Admins.template')
@section('title')
ایجاد مقاله
@endsection
@section('content')
@php
    $Category = \App\Models\BlogsCategory::get();
@endphp
<div class="container-fluid">

    <div class="page-header">
        <div>
            <h3>ثبت مقاله</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('Admins.Blogs.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>دسته بندی</label>
                            <div class="d-flex">
                                @forelse($Category as $item)
                                    <div class="ml-4 d-flex align-items-center">
                                        <p class="ml-2 mb-0">{{ $item->title }}: </p>
                                        <input class="form-control" type="checkbox" value="{{ $item->title }}"
                                            name="category[{{ $item->title }}]" style=" width: 19px;">
                                    </div>
                                @empty
                                    <p class="text-center text-danger">موردی یافت نشد</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="form-group">
                            <label>عنوان </label>
                            <input class="form-control" required type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea name="description" required class="form-control ck_text_editor"
                                rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>کلمات کلیدی</label>
                            <textarea name="keywords" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>توضیحات سئو</label>
                            <textarea name="description_seo" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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


</script>
@endsection
