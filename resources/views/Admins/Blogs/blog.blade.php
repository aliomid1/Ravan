@extends('layout.Admins.template')
@section('content')

<div class="container-fluid">
    <div class="col-md-12 show_layout">
        <div class="text-center">
           @if ($image)
           <img class="rounded" style="max-width: 100%; height:470px;"
               src="{{ asset($image->url) }}" alt="عکسی انتخاب نشده است">
           @endif
        </div>
        <div class="head row mx-1 align-items-center justify-content-between mt-5 mb-3">
            <h4>{{ $blog->title }}</h4>
        </div>
        <div class="description text-justify">
            <h5>{!! $blog->description !!}</h5>
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
