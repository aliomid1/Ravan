@extends('layout.Admins.template')
@section('title','پشتیبانی')



@section('style')
    <style>
        table td{
            vertical-align: top !important;
            padding: 19px 0.75rem !important;
            white-space: unset !important;
            line-height: 2 !important;
            max-width: 660px;
        }
        ::placeholder{
            opacity: 0.58 !important;
        }
    </style>
@endsection



@section('content')


<div class="container-fluid px-sm-3 px-0">

    <div class="w-100 edit_layout" style="">
        <h4>ویرایش صفحه اصلی</h4>
        <form action="{{ route('Admins.HomePage.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="services-table table table-responsive">
                            <h5 class="mb-0 mt-4 card-title">خدمات</h5>
                            <table class="table text-center">
                                <thead >
                                    <tr class="">
                                        <th class="">عنوان</th>
                                        <th class="">توضیح مختصر</th>
                                        <th class="">لینک (پس از دامنه)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Services as $item)
                                        <tr class="">
                                            <td><input type="text" name="services[{{ $loop->index }}][title]"
                                                    value="{{ isset($item['title']) ? $item['title'] : '' }}"
                                                    class="form-control" placeholder="عنوان" ></td>
                                            <td ><input type="text" name="services[{{ $loop->index }}][short_desc]"
                                                    value="{{ isset($item['short_desc']) ? $item['short_desc'] : '' }}"
                                                    class="form-control" placeholder="توضیح مختصر" >
                                            </td>
                                            <td>
                                                <input type="text" name="services[{{ $loop->index }}][link]"
                                                    value="{{ isset($item['link']) ? $item['link'] : '' }}"
                                                    class="form-control" placeholder="Blogs/Category/100" >
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="">
                                            <td>
                                                <input type="text" name="services[0][title]" class="form-control"
                                                    placeholder="عنوان" required></td>
                                            <td>
                                                <input type="text" name="services[0][short_desc]"
                                                    class="form-control" placeholder="توضیح مختصر" required>
                                            </td>
                                            <td>
                                                <input type="text" name="services[{{ $loop->index }}][link]"
                                                    class="form-control" placeholder="Blogs/Category/100" >
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
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
                    <hr class="mb-5 mt-4">
                    <div class="form-group  ">
                        <h5>انتخاب عکس صفحه اصلی</h5>
                        <div class="custom-file">
                            <input type="file" class="image custom-file-input" name="main_image" id="customFile">
                            <label class="custom-file-label" for="customFile">انتخاب
                                عکس</label>
                        </div>
                        @if($MainImage)
                        <div class="row justify-content-center mt-3">
                            <img id="image" class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                src="{{ asset($MainImage->url) }}" alt="عکسی انتخاب نشده است">
                        </div>
                        @else
                        <div class="row justify-content-center mt-3">
                            <img id="image" class=" justify-content col-xl-3 col-lg-4 col-md-7 col-sm-11 mx-auto"
                                src="" alt="عکسی انتخاب نشده است">
                        </div>
                        @endif
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <div class="select-comment-table table table-responsive">
                            <h5 class="mb-0 mt-4 card-title">انتخاب کامنت های منتخب</h5>
                            <table class="table text-center">
                                <thead >
                                    <tr class="">
                                        <th class="">#</th>
                                        <th class="">نام کاربری</th>
                                        <th class="">عکس</th>
                                        <th class="">نظر</th>
                                        <th class="">تاریخ ثبت</th>
                                        <th class="">وضعیت (جهت تغییر کلیک نمایید)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Comments as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->User ? $item->User->username : 'نام کاربری ثبت نشده' }}</td>
                                            <td>
                                                @if ( $item->User->Image ? $item->User->Image->url : false)
                                                    <img src="{{ asset($item->User->Image->url) }}" alt="مشکلی پیش آمده است" style="width:56px; height: 56px;">
                                                @else
                                                عکسی برای این کاربر ثبت نشده است
                                                @endif
                                            </td>
                                            <td>{{ $item->text }}</td>
                                            <td>{{ $item->updated_at ?? '-' }}</td>
                                            <td><p  data-url="{{ route('Admins.HomePage.publication') }}" data-id="{{ $item->id }}" class="publication btn {{ $item->publication == 'off' ? 'btn-secondary' : 'btn-success' }}">{{ $item->publication == 'off' ? 'انتخاب نشده' : 'انتخاب شده'}}</p></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $Comments->links() }}
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <div class="details-table table table-responsive ">
                            <h5 class="mb-0 mt-4 card-title">توضیحات سایت</h5>
                            <table class="table text-center">
                                <thead >
                                    <tr class="">
                                        <th class="">عنوان</th>
                                        <th class="">توضيحات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Guidences as $item)
                                        <tr>
                                            <td><input type="text" name="guidences[{{ $loop->index }}][title]"
                                                    value="{{ $item['title'] }}"
                                                    class="form-control" placeholder="عنوان" ></td>
                                            <td>
                                                <textarea type="text" name="guidences[{{ $loop->index }}][description]"
                                                    class="form-control" placeholder="توضیح "  rows="5">{{ $item['description'] }}</textarea>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><input type="text" name="guidences[0][title]" class="form-control"
                                                    placeholder="عنوان" ></td>
                                            <td>
                                                <textarea type="text" name="guidences[0][description]" class="form-control" placeholder="توضیح" rows="5" ></textarea>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
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
                    <hr class="my-5">
                    <div class="form-group">
                        <div class="trust-table table table-responsive ">
                            <h5 class="mb-4 mt-4 card-title">فوتر سایت - بخش اعتماد مشتری</h5>
                            <table class="table text-center">
                                <thead>
                                    <tr class="">
                                        <th class="">آیکون</th>
                                        <th class="">لینک نماد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Footer['trust']['items'] as $key => $item)
                                        <tr>
                                            <td style="max-width: 120px;">
                                                <div class="custom-file">
                                                    <input type="file" class="image custom-file-input customFile" name="footer[trust][items][{{ $key }}][trust_image]">
                                                    <label class="custom-file-label" for="customFile">انتخاب
                                                        عکس</label>
                                                </div>
                                                @if(isset($item['trust_image']) && !is_array($item['trust_image']))
                                                    <div class="row justify-content-center mt-3 col-6">
                                                        <img class="image justify-content col-7"
                                                            src="{{ asset($item['trust_image']) }}" alt="عکسی انتخاب نشده است">
                                                    </div>
                                                @else
                                                    <div class="row justify-content-center mt-3">
                                                        <img class="image justify-content col-7" src=""
                                                            alt="عکسی انتخاب نشده است">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="footer[trust][items][{{ $key }}][trust_link]" value="{{ isset($item['trust_link']) ? $item['trust_link'] : '' }}" class="form-control"
                                                    placeholder="https://example.ir">
                                            </td>
                                        </tr> 
                                    @empty
                                        <tr>
                                            <td style="max-width: 120px;">
                                                <div class="custom-file">
                                                    <input type="file" class="image custom-file-input customFile" name="footer[trust][items][0][trust_image]">
                                                    <label class="custom-file-label" for="customFile">انتخاب
                                                        عکس</label>
                                                </div>
                                                <div class="row justify-content-center mt-3">
                                                    <img class="image justify-content col-7" src=""
                                                        alt="عکسی انتخاب نشده است">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="footer[trust][items][0][trust_link]" class="form-control"
                                                    placeholder="https://example.ir">
                                            </td>
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
                        <label >توضیحات بخش اعتماد مشتری</label>
                        <textarea name="footer[trust][detail]" class="form-control"  rows="5">{{ isset($Footer['trust']['detail']) ? $Footer['trust']['detail'] : ''  }}</textarea>
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <div class="social-media-table table table-responsive ">
                            <h5 class="mb-4 mt-4 card-title">فوتر سایت - بخش شبکه های اجتماعی</h5>
                            <table class="table text-center">
                                <thead>
                                    <tr class="">
                                        <th class="">آیکون</th>
                                        <th class="">لینک شبکه ی اجتماعی شرکت شما</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Footer['social_media'] as $key => $item)
                                    @php
                                        // dd([$key][$item['trust_image']]);
                                        // dd($item);
                                        // dd($item['trust_link']);
                                    @endphp
                                        <tr>
                                            <td style="max-width: 120px;">
                                                <div class="custom-file">
                                                    <input type="file" class="image custom-file-input customFile" name="footer[social_media][{{ $key }}][social_media_image]">
                                                    <label class="custom-file-label" for="customFile">انتخاب
                                                        عکس</label>
                                                </div>
                                                @if(isset($item['social_media_image']))
                                                    <div class="row justify-content-center mt-3 col-6">
                                                        <img class="image justify-content col-7"
                                                            src="{{ asset($item['social_media_image']) }}" alt="عکسی انتخاب نشده است">
                                                    </div>
                                                @else
                                                    <div class="row justify-content-center mt-3">
                                                        <img class="image justify-content col-7" src=""
                                                            alt="عکسی انتخاب نشده است">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="footer[social_media][{{ $key }}][social_media_link]" value="{{ isset($item['social_media_link']) ? $item['social_media_link'] : '' }}" class="form-control"
                                                    placeholder="https://example.ir">
                                            </td>
                                        </tr> 
                                    @empty
                                        <tr>
                                            <td style="max-width: 120px;">
                                                <div class="custom-file">
                                                    <input type="file" class="image custom-file-input customFile" name="footer[social_media][0][social_media_image]">
                                                    <label class="custom-file-label" for="customFile">انتخاب
                                                        عکس</label>
                                                </div>
                                                <div class="row justify-content-center mt-3">
                                                    <img class="image justify-content col-7" src=""
                                                        alt="عکسی انتخاب نشده است">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="footer[social_media][0][social_media_link]" class="form-control"
                                                    placeholder="https://example.ir">
                                            </td>
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

@include('components.ajax.delete')
@endsection
