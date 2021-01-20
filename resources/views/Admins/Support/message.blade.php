@extends('layout.Admins.template')
@section('title','پشتیبانی')
@section('content')
@php
$support = \App\Models\Support::where('id',$id)->first();
@endphp

    <div class="container-fluid">
        <div class="page-header">
            <div>
                <h4>تیکت {{ $support->id }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5 card p-4">
                <h4>{{ $support->title }}</h4>
                <p>{{ \Morilog\Jalali\Jalalian::forge($support->created_at)->format('H:i -- Y/m/d') }}</p>
            </div>

            <div class="col-md-12">
                <h5>گفتگو</h5>
                <div class="p-3">
                    @forelse (\App\Models\SupportMessage::where('support_id',$support->id)->get() as $key=> $item)

                    @if ($item->user_id=='Admin')
                    <div class="col-md-4 bg-info p-2 itemcard  mb-1" style="border-radius: 10px">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>شما :</h6>
                            <div>
                                <small>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago()=='0 ثانیه پیش'?"همین الان":\Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}</small>
                                <a class="delete mx-2"
                                data-url="{{route('Admins.SupportMessageDelete')}}"
                                data-type="item"
                                data-parent=".itemcard"
                                data-item="پیام" data-id="{{$item->id}}"
                                style="cursor: pointer"><i class="fa fa-trash"></i></a>
                            </div>

                        </div>

                        <p>{{ $item->message }}</p>
                    </div>
                    @else
                    <div class="col-md-4 bg-secondary p-2 itemcard mr-auto  mb-1" style="border-radius: 10px">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ $item->GetUser?$item->GetUser->fullname:'کاربر حذف شده'}}</h6>
                            <div>
                                <small>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago()=='0 ثانیه پیش'?"همین الان":\Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}</small>
                                <a class="delete mx-2"
                                data-url="{{route('Admins.SupportMessageDelete')}}"
                                data-type="item"
                                data-parent=".itemcard"
                                data-item="پیام" data-id="{{$item->id}}"
                                style="cursor: pointer"><i class="fa fa-trash"></i></a>
                            </div>

                        </div>

                        <p>{{ $item->message }}</p>
                    </div>
                    @endif

                    @empty
                    <div></div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 card p-4">
                <form action="{{ route('Admins.SupportReplay') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="Admin">
                    <input type="hidden" name="support_id" value="{{ $support->id }}">
                    <h5>پاسخ </h5>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-warning text-white">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
@include('components.ajax.delete')
@endsection
