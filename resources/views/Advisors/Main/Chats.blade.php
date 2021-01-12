@extends('layout.Advisors.template')
@section('title', 'داشبورد')

@section('style')

@endsection

@php
$Conversation = \App\Models\Chat::where('expert_id',Auth::guard('advisor')->user()->id)->where('status',1)->get();
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

        <div class="card ">
            <div class="row chat-app">
                <div class="col-lg-12  chat-sidebar">

                    <div class="chat-sidebar-messages"
                        style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                        <div class="list-group">
                            @forelse ($Conversation as $item)
                                <div class="list-group-item list-group-item-action d-flex">
                                    <div>
                                        <figure class="avatar avatar-sm">
                                            <img src="{{ $item->User ? asset($item->User->Image->url ) : asset('assets/avatar.jpg') }}"
                                                class="rounded-circle">
                                        </figure>
                                    </div>
                                    <div class="mx-3">
                                        <h6 class="m-0 primary-font">
                                            {{ $item->User ? $item->User->fullname : 'كاربر حذف شده است' }}</h6>
                                        <p class="m-0 small">{{\Morilog\Jalali\Jalalian::forge($item->created_at)->ago()}}
                                        گفتگو ایجاد شده</p>
                                    </div>
                                   <a class=" mr-auto btn btn-success" href="{{route('Web.STARTChat',$item->id)}}">رفتن به گفتگو</a>
                                </div>
                            @empty
                                <p class="text-muted text-center my-4">هنوز گفتگويي ايجاد نشده است.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('js')

@endsection
