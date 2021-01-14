@extends('layout.Admins.template')
@section('title','پشتیبانی')
@section('content')
@php
    $ConversationOnline = \App\Models\Conversation::where('status' ,
    'done')->where('type','online')->paginate(15);
    $ConversationOut = \App\Models\Conversation::where('status' ,
    'done')->where('type','out')->paginate(15);
    $ConversationIn = \App\Models\Conversation::where('status' ,
    'done')->where('type','in')->paginate(15);
    $ConversationNotUser = \App\Models\Conversation::where('status' , 'not_user')->paginate(15);
    $ConversationNotAdvisor = \App\Models\Conversation::where('status' , 'not_advisor')->paginate(15);
@endphp



<div class="container-fluid">

    <!-- begin::page header -->
    <div class="page-header">
        <div>
            <h3>تاریخچه مشاوره ها</h3>
        </div>
    </div>
    <!-- end::page header -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3">
                            <h5>نوبت های انلاین</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>نام مشاور</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ConversationOnline as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                {{ $item->subject }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <nav class="m-t-30">
                        <ul class="pagination justify-content-center">
                           {{ $ConversationOnline->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3">
                            <h5>نوبت های تلفنی</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>نام مشاور</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ConversationOut as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                {{ $item->subject }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <nav class="m-t-30">
                        <ul class="pagination justify-content-center">
                           {{ $ConversationOut->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3">
                            <h5>نوبت های حضوری</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>نام مشاور</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ConversationIn as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                {{ $item->subject }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <nav class="m-t-30">
                        <ul class="pagination justify-content-center">
                           {{ $ConversationIn->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3">
                            <h5>نوبت های لغو شده توسط کاربر</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>نام مشاور</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ConversationNotAdvisor as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                {{ $item->subject }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'not_user')
                                                    <span class="text-success">عدم حضور کاربر</span>
                                                @endif
                                                @if ($item->status == 'not_advisor')
                                                    <span class="text-secondary">عدم حضور مشاور</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <nav class="m-t-30">
                        <ul class="pagination justify-content-center">
                           {{ $ConversationNotAdvisor->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3">
                            <h5>نوبت های لغو شده توسط مشاور</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>نام مشاور</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ConversationNotUser as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                {{ $item->subject }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'not_user')
                                                    <span class="text-success">عدم حضور کاربر</span>
                                                @endif
                                                @if ($item->status == 'not_advisor')
                                                    <span class="text-secondary">عدم حضور مشاور</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <nav class="m-t-30">
                        <ul class="pagination justify-content-center">
                           {{ $ConversationNotUser->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
