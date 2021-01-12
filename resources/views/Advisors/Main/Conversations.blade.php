@extends('layout.Advisors.template')
@section('title','داشبورد')

@section('style')

@endsection

@php
    $Conversation = \App\Models\Conversation::get();
    $Image = \App\Models\Image::get();

@endphp

@section('content')
<div class="container-fluid">

        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>گفتگو ها</h3>

            </div>

        </div>
        <!-- end::page header -->

        <div class="card chat-app-wrapper">
            <div class="row chat-app">
                <div class="col-lg-3 chat-sidebar">
                    <div class="chat-sidebar-search">
                        <form>
                            <input type="text" class="form-control" placeholder="جستجوی گفتگو ...">
                        </form>
                    </div>
                    <div class="chat-sidebar-messages" style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                        <div class="list-group">
                            @forelse ($Conversation as $item)
                            <a href="#" class="list-group-item list-group-item-action d-flex active">
                                <div>
                                    <figure class="avatar avatar-sm">
                                        <img src="{{ $item->UserImage ? asset($item->UserImage->url) : asset('vendor/media/image/avatar.jpg') }}" class="rounded-circle">
                                    </figure>
                                </div>
                                <div>
									<h6 class="m-0 primary-font">{{ $item->User ? $item->User->fullname : 'كاربر حذف شده است' }}</h6>
                                    <p class="m-0 small">{{ $item->Subject ? $item->Subject->title : 'موضوع حذف شده است' }}</p>
                                </div>
                                <span class="badge badge-primary badge-pill mr-auto">3</span>
                            </a>
                            @empty
                                <p class="text-muted text-center">هنوز گفتگويي ايجاد نشده است.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 chat-body">
                    <div class="chat-body-header">
                        <a href="#" class="btn btn-dark opacity-3 m-l-10 btn-chat-sidebar-open">
                            <i class="ti-menu"></i>
                        </a>
                        <div>
                            <figure class="avatar avatar-sm m-l-10">
                                <img src="{{ asset('vendor/media/image/avatar.jpg') }}" class="rounded-circle">
                            </figure>
                        </div>
                        <div>
							<h6 class="m-b-0 primary-font">بری الن</h6>
                            <i class="small text-success">در حال نوشتن ...</i>
                        </div>
                        <div class="mr-auto d-flex">
                            <button type="button" class="mr-2 btn btn-sm btn-success btn-floating">
                                <i class="fa fa-video-camera"></i>
                            </button>
                            <div class="dropdown mr-2">
                                <button type="button" data-toggle="dropdown" class="btn btn-sm  btn-warning btn-floating">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-body" style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href="#">پروفایل</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">مسدود کردن</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">حذف</a>
                                            </li>
                                        </ul>
                                    </div>
                                <div id="ascrail2004" class="nicescroll-rails nicescroll-rails-vr" style="width: 6px; z-index: 2; cursor: grab; position: absolute; top: 0px; left: 0px; height: 0px; touch-action: none; display: none;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: none; background-clip: padding-box; border-radius: 5px; touch-action: none;"></div></div><div id="ascrail2004-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 6px; z-index: 2; top: -6px; left: 0px; position: absolute; display: none;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: none; background-clip: padding-box; border-radius: 5px;"></div></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-body-messages" style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                        <div class="message-items">
                            <div class="message-item message-item-media">
                                <ul>
                                    <a href="{{ asset('vendor/media/image/portfolio-four.jpg') }}">
                                        <img src="{{ asset('vendor/media/image/portfolio-four.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی</span>
                                    </a>
                                    <a href="{{ asset('vendor/media/image/portfolio-two.jpg') }}">
                                        <img src="{{ asset('vendor/media/image/portfolio-two.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی</span>
                                    </a>
                                </ul>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item message-item-media">
                                <div class="m-b-0 text-muted text-right">
                                    <a href="#" class="btn btn-light btn-outline-light text-right align-items-center justify-content-center m-l-10">
                                        <i class="fa fa-file-o font-size-25 m-l-15"></i>
										<div class="small line-height-20" dir="ltr">
                                            <div>example test.txt</div>
                                            <div>10 KB</div>
                                        </div>
                                    </a>
                                </div>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message">
                                لورم ایپسوم متن ساختگی با تولید
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message message-item-media">
                                <ul>
                                    <a href="{{ asset('vendor/media/image/portfolio-four.jpg') }}" class="media-error">
                                        <img src="{{ asset('vendor/media/image/portfolio-four.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی با تولید</span>
                                    </a>
                                    <a href="{{ asset('vendor/media/image/portfolio-six.jpg') }}">
                                        <img src="{{ asset('vendor/media/image/portfolio-six.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی</span>
                                    </a>
                                    <a href="{{ asset('vendor/media/image/portfolio-three.jpg') }}" class="media-error">
                                        <img src="{{ asset('vendor/media/image/portfolio-three.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی با تولید</span>
                                    </a>
                                    <a href="{{ asset('vendor/media/image/portfolio-one.jpg') }}">
                                        <img src="{{ asset('vendor/media/image/portfolio-one.jpg') }}" alt="image">
                                        <span>لورم ایپسوم متن ساختگی</span>
                                    </a>
                                </ul>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item message-item-date-border">
                                <span class="badge">دیروز</span>
                            </div>
                            <div class="message-item message-item-error">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message message-item-error">
                                لورم ایپسوم متن ساختگی
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message message-item-media">
                                <div class="m-b-0 text-muted text-right media-file">
                                    <a href="#" class="btn btn-light btn-outline-light text-right align-items-center justify-content-center m-l-10 m-b-10 media-error">
                                        <i class="fa fa-file-o font-size-25 m-l-15"></i>
                                        <div class="small line-height-20" dir="ltr">
                                            <div>example-file.txt</div>
                                            <div>5 KB</div>
                                        </div>
                                    </a>
                                </div>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن
                            </div>
                            <div class="message-item message-item-date-border">
                                <span class="badge">امروز</span>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                            </div>
                            <div class="message-item outgoing-message">
                                لورم ایپسوم متن ساختگی
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item">
                                لورم ایپسوم
                            </div>
                        </div>
                    </div>
                    <div class="chat-body-footer">
                        <form class="d-flex align-items-center">
                            <input type="text" class="form-control" placeholder="پیام ...">
                            <div class="d-flex">
                                <button type="button" class="mr-3 btn btn-primary btn-floating">
                                    <i class="fa fa-send"></i>
                                </button>
                                <div class="dropup">
                                    <button type="button" data-toggle="dropdown" class="mr-3 btn btn-success btn-floating">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-body" style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="icon fa fa-picture-o"></i> تصویر
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="icon fa fa-video-camera"></i> ویدئو
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <div id="ascrail2005" class="nicescroll-rails nicescroll-rails-vr" style="width: 6px; z-index: 2; cursor: grab; position: absolute; top: 0px; left: 0px; height: 0px; touch-action: none; display: none;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: none; background-clip: padding-box; border-radius: 5px; touch-action: none;"></div></div><div id="ascrail2005-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 6px; z-index: 2; top: -6px; left: 0px; position: absolute; display: none;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: none; background-clip: padding-box; border-radius: 5px;"></div></div></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')

@endsection
