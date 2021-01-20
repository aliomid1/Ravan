@extends('layout.Admins.template')
@section('title', 'مدیریت صفحات')
@section('content')

    <div class="container-fluid">
        <div class="col-12 card p-4">
            <div class="page-header">
                <div>
                    <h4>مدیریت صفحات</h4>
                </div>
            </div>
            <div class="container-fluid">
                <h4>صفحه جدید</h4>


                <form action="{{ route('Admins.PagesManagerUpdate') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$page->id}}">
                    <div class="row align-items-end justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="my-input">عنوان</label>
                            <input id="my-input" class="form-control" type="text" required value="{{$page->title}}" name="title">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">عنوان منو</label>
                            <input id="my-input" class="form-control" type="text" required value="{{$page->titlemenu}}" name="titlemenu">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input2">نمایش در منو</label>

                            <select id="my-input2" class="form-control" name="statusmenu">
                                <option {{$page->statusmenu=='on'?"selected":""}} value="on">نمایش داده شود</option>
                                <option {{$page->statusmenu=='off'?"selected":""}} value="off">نمایش داده نشود</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">کلمات کلیدی سئو</label>
                            <textarea name="keywords" class="form-control" required rows="4">{{$page->keywords}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">توضیحات سئو</label>
                            <textarea name="description" class="form-control" required rows="4">{{$page->description}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">محتوا صفحه</label>
                        <textarea name="content" class="form-control ck_text_editor" required>{!!$page->content!!}</textarea>
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
