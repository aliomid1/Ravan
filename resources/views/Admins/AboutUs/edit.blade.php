@extends('layout.Admins.template')
@section('title','پشتیبانی')
@section('content')


<div class="container-fluid">

    <div class="col-md-12 edit_layout" style="">
        <h4>ویرایش صفحه درباره ما</h4>
        <form action="{{ route('Admins.AboutUs.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>عنوان</label>
                        <input class="form-control"  type="text" value="{{ $AboutUs->title }}" name="title">
                    </div>
                    <div class="form-group  ">
                        <label>عکس</label>
                        <div class="custom-file">
                            <input type="file" class="image custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">انتخاب
                                عکس</label>
                        </div>
                        @if($Image)
                        <div class="row justify-content-center mt-3">
                            <img id="image" class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                src="{{ asset($Image->url) }}" alt="عکسی انتخاب نشده است">
                        </div>
                        @else
                        <div class="row justify-content-center mt-3">
                            <img id="image" class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                src="" alt="عکسی انتخاب نشده است">
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea name="description"  class="form-control" rows="5">{{ $AboutUs->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="table table-responsive advantages-form">
                            <h5 class="mb-0 mt-4 card-title">مزیت ها</h5>
                            <table class="table">
                                <thead >
                                    <tr class="">
                                        <th class="">عنوان</th>
                                        <th class="">توضیح مختصر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Advantages as $item)
                                        <tr>
                                            <td><input type="text" name="advantages[{{ $loop->index }}][title]"
                                                    value="{{ $item['title'] }}"
                                                    class="form-control" placeholder="عنوان" required></td>
                                            <td><input type="text" name="advantages[{{ $loop->index }}][short_desc]"
                                                    value="{{ $item['short_desc'] }}"
                                                    class="form-control" placeholder="توضیح مختصر" required></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><input type="text" name="advantages[0][title]" class="form-control"
                                                    placeholder="عنوان" required></td>
                                            <td><input type="text" name="advantages[0][short_desc]"
                                                    class="form-control" placeholder="توضیح مختصر" required></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <a href="javascript:void()" class="add-row btn btn-primary mx-1">افزودن
                                                ردیف جدید</a>
                                            <a href="javascript:void()" class="remove-row btn btn-danger mx-1">حذف
                                                آخرین ردیف</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>اهداف</label>
                        <textarea name="target"  class="form-control ck_text_editor"
                            rows="5">{{ $AboutUs->target }}</textarea>
                    </div>
                    <div class="text-left">
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
