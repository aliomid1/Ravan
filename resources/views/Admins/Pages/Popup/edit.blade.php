@extends('layout.Admins.template')
@section('title', 'پاپ آپ صفحات')
@section('content')

    <div class="container-fluid">
        <div class="col-12 card p-4">
            <div class="page-header">
                <div>
                    <h4>مدیریت پاپ آپ صفحات</h4>
                </div>
            </div>
            <div class="container-fluid">
                <form action="{{ route('Admins.Popup.post') }}" method="post">
                    @csrf
                        <div class="form-group col-md-4">
                            <label >تعیین میزان زمان تاخیر اجرا شدن (ثانیه)</label>
                            <input class="form-control" type="number" name="popup_sleep" value="{{ $page->popup_sleep }}" placeholder="ثانیه">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">محتوا صفحه</label>
                        <textarea name="popup_content" class="form-control ck_text_editor" required>{!!$page->popup_content!!}</textarea>
                        <p class="text-danger"> * در صورتی که این فیلد خالی باشد، پاپ آب به صورت خودکار غیر فعال خواهد شد.</p>
                        </div>
                        <div class="form-group col-md-12 text-left">
                            <button type="submit" class="btn btn-warning text-white">ثبت صفحه</button>
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
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
<script type="text/javascript">
    if ($('.ck_text_editor').length) {
        var editors = $('.ck_text_editor');
        $.each(editors, function(i, item) {
            CKEDITOR.replace(item, {
                filebrowserUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token()]) }}",
                filebrowserImageUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token()]) }}",
                height: 200
            });
        });
    }

</script>
@endsection
