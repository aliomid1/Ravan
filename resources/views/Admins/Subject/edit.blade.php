@section('title')
ویرایش موضوع
@endsection
@extends('layout.Admins.template')


@section('style')
    {{-- <link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css"> --}}
@endsection


@section('content')
@php
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <h5 class="card-title">ویرایش موضوع</h5>
                <form class=""
                    action="{{ route('Admins.Subject.update','update') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $subject->id }}">
                    <div class="form-group">
                        <label>دسته بندی</label>
                        <div class="d-flex">
                            @forelse(\App\Models\Category::get() as $item)
                                <div class="ml-4 d-flex align-items-center">
                                    <p class="ml-2 mb-0">{{ $item->title }}: </p>
                                    <input class="form-control" type="checkbox" value="{{ $item->title }}"
                                        name="category_id[{{ $item->title }}]"
                                        {{ in_array($item->title , $SelectedCat) ? 'checked' : '' }}
                                        style=" width: 19px;">
                                </div>
                            @empty
                                <p class="text-center text-danger">موردی یافت نشد</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>عنوان موضوع </label>
                            <input type="text" class="form-control" value="{{ $subject->title }}" required
                                name="title">
                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <label>دسته ی موضوع</label>
                            <select name="category" required class="form-control">
                                <option value="">انتخاب کنید</option>
@forelse(\App\Models\Category::get() as $item)
                              
                                <option   @if ($item->id==$subject->category)
                                    selected
@endifvalue="{{ $item->id }}">{{ $item->title }}</option>
@empty
@endforelse
                            </select>
                        </div> --}}
                        <div class="form-group col-md-6 ">
                            <label>عکس</label>
                            <div class="custom-file">
                                <input type="file" class="image custom-file-input" name="image" id="customFile">
                                <label class="custom-file-label" for="customFile">انتخاب
                                    عکس</label>
                            </div>
                            @if($image)
                                <div class="row justify-content-center mt-3">
                                    <img id="image"
                                        class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                        src="{{ asset($image->url) }}" alt="عکسی انتخاب نشده است">
                                </div>
                            @else
                                <div class="row justify-content-center mt-3">
                                    <img id="image"
                                        class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto" src=""
                                        alt="عکسی انتخاب نشده است">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group subject-tags-form">
                        <label>تگ موضوع</label>
                        <div class="body row">
                            @forelse($tags as $item)
                                <input class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3" value="{{ $item }}"
                                    type="text" name="tags[{{ $loop->index }}]">
                            @empty
                                <input class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3" type="text"
                                    name="tags[0]">
                            @endforelse
                        </div>
                        <a href="javascript:void()" class="add-row btn btn-primary mx-1">افزودن
                            ردیف جدید</a>
                        <a href="javascript:void()" class="remove-row btn btn-danger mx-1">حذف
                            آخرین ردیف</a>
                    </div>
                    <div class="form-row ">
                        <div class="col-md-12 mb-3">
                            <label> توضیحات</label>
                            <textarea name="description" class="form-control"
                                rows="4">{{ $subject->description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>کلمات کلیدی سئو</label>
                            <input type="text" class="form-control" value="{{ $subject->keywords_seo }}"
                                name="keywords_seo">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> توضیحات سئو</label>
                            <textarea name="description_seo" class="form-control"
                                rows="4">{{ $subject->description_seo }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> اطلاعات بیشتر</label>
                            <textarea name="page" class="form-control ck_text_editor"
                                rows="5">{!!$subject->page!!}</textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center border-top pt-3 mt-4">
                        <button class="btn btn-success" type="submit">ثبت موضوع</button>
                    </div>
                </form>
                <div class="table-responsive" tabindex="1" style=" outline: none;">
                    <h4 class="my-5">ليست نظرات این موضوع</h4>

                    <table id="example1" class="subject-comment-table table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>
                                    <p>نام کاربر</p>
                                </th>
                                <th>
                                    <p>متن</p>
                                </th>
                                <th>
                                    <p>تغييرات</p>
                                </th>
                                <th>
                                    <p>حذف</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Comments as $item)
                                <tr>
                                    <td>
                                        <p>{{ $item->User ? $item->User->fullname : 'کاربر ناشناس'}}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->text }}</p>
                                    </td>
                                    <td>
                                        <p data-id="{{ $item->id }}" data-url="{{ route('Admins.SubjectComments.publication') }}"
                                            class="publication d-inline-block my-1 btn {{ $item->publication == 'off' || $item->publication == null ? 'btn-secondary' : 'btn-success' }}">
                                            @if ($item->publication == null )
                                                در انتظار تاييد
                                            @endif
                                            @if ($item->publication == 'on' )
                                                تایید شده
                                            @endif
                                            @if ($item->publication == 'off' )
                                                تایید نشده
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <a href="javascript:void()" class="delete btn btn-danger"
                                            data-url="{{ route('Admins.SubjectComments.delete','Delete') }}"
                                            data-type="table" data-item="کامنت" data-id="{{ $item->id }}">
                                            <i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">موردی ثبت نشده است</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $Comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')

<script src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/js/examples/ckeditor.js') }}"></script>
{{-- <script src="{{asset('vendor/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/examples/datatable.js')}}"></script> --}}
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
@include('components.ajax.delete')
<script type="text/javascript">
    if ($('.ck_text_editor').length) {
        var editors = $('.ck_text_editor');
        $.each(editors, function (i, item) {
            CKEDITOR.replace(item, {
                filebrowserUploadUrl: "{{route('CKEDITOR', ['_token' => csrf_token() ])}}",
                filebrowserImageUploadUrl: "{{route('CKEDITOR', ['_token' => csrf_token() ])}}",
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
