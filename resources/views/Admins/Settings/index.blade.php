@extends('layout.Admins.template')
@section('title', 'تنظیمات کلی')
@section('content')
    @php
    $settings=\App\Models\Settings::first();
    @endphp
    <div class="container-fluid">
        <div class="col-12 card p-4">
            <div class="page-header">
                <div>
                    <h4>تنظیمات کلی</h4>
                </div>
            </div>
            <div class="container-fluid">
                <h4 class="mb-5">ویرایش اطلاعات کلی</h4>
                <form action="{{ route('Admins.Settings.General.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end ">
                        <div class="form-group col-md-3">
                            <label for="my-input">عنوان</label>
                            <input id="my-input" class="form-control" type="text" value="{{ $settings->title }}" required
                                name="title">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="my-input">لوگو</label>
                            <input id="my-input" class="form-control" type="file" name="logo">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="my-input">رنگ اصلی</label>
                            <input id="my-input" class="form-control" type="color" value="{{ $settings->colorPrimary }}"
                                required name="colorPrimary">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="my-input">رنگ دوم</label>
                            <input id="my-input" class="form-control" type="color" value="{{ $settings->colorSecondary }}"
                                required name="colorSecondary">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">زمان پیشفرض مشاوره</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->time_default }}"
                                required name="time_default">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">هزینه پیشفرض مشاوره</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->price_default }}"
                                required name="price_default">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">اعتبار هدیه</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->gift_default }}"
                                required name="gift_default">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">زمان  مجاز لغو گفتگو توسط کاربر</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->timeleftuser }}"
                                required name="timeleftuser">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">زمان  مجاز لغو گفتگو توسط مشاور</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->timeleftadvisor }}"
                                required name="timeleftadvisor">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">درصد سود سایت</label>
                            <input id="my-input" class="form-control" type="number" value="{{ $settings->percent }}"
                                required name="percent">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">نوع ثبت نام مشاورین</label>
                            <select name="type_signUp_advisors" class="form-control">
                                <option @if ($settings->type_signUp_advisors == 'advisors')
                                    selected
                                    @endif value="advisors">ثبت نام توسط خود مشاور</option>
                                <option @if ($settings->type_signUp_advisors == 'admin')
                                    selected
                                    @endif value="admin">ثبت نام توسط ادمین</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">نایید اجباری ایمیل کاربران</label>
                            <select name="verify_email" class="form-control">
                                <option @if ($settings->verify_email == 'on')
                                    selected
                                    @endif value="on">فعال</option>
                                <option @if ($settings->verify_email == 'off')
                                    selected
                                    @endif value="off">غیرفعال</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">ثبت نام ناشناس</label>
                            <select name="type_signUp_users" class="form-control">
                                <option @if ($settings->type_signUp_users == 'on')
                                    selected
                                    @endif value="on">فعال</option>
                                <option @if ($settings->type_signUp_users == 'off')
                                    selected
                                    @endif value="off">غیرفعال</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">کلمات سئو</label>
                            <textarea name="keywords" class="form-control" id=""
                                rows="4">{{ $settings->keywords }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">توضیحات سئو</label>
                            <textarea name="description" class="form-control" id=""
                                rows="4">{{ $settings->description }}</textarea>
                        </div>
                        <div class="form-group col-md-12 text-left">
                            <button type="submit" class="btn btn-warning text-white">ثبت اطلاعات</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
