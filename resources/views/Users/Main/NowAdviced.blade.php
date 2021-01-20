@extends('layout.Users.template')
@section('title','تاریخچه مشاوره ها')

@section('style')

@endsection



@section('content')

@php
    $User_id = Auth::user()->id;
    $User_ConversationOnline = \App\Models\Conversation::where('user_id' , $User_id)->where('status' ,
    'done')->where('type','online')->paginate(15);
    $User_ConversationOut = \App\Models\Conversation::where('user_id' , $User_id)->where('status' ,
    'done')->where('type','out')->paginate(15);
    $User_ConversationIn = \App\Models\Conversation::where('user_id' , $User_id)->where('status' ,
    'done')->where('type','in')->paginate(15);
    $User_ConversationNot = \App\Models\Conversation::where('user_id' , $User_id)->whereIn('status' ,
    ['not_user', 'not_advisor'])->paginate(15);
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
                                        <th>نام مشاور</th>
                                        <th>توضیحات</th>
                                        <th>وضعیت</th>
                                        <th>زمان انجام مشاوره</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($User_ConversationOnline->where('type','online') as $item)
                                        <tr>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                    {{ $item->subject  }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->status == "done")
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if($item->status == "doing")
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->start_at ? \Morilog\Jalali\Jalalian::forge($item->start_at)->format('Y/m/d - H:i:s') : '-' }}
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
                            {{ $User_ConversationOnline->links() }}
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
                                        <th>نام مشاور</th>
                                        <th>توضیحات</th>
                                        <th>وضعیت</th>
                                        <th>زمان انجام مشاوره</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($User_ConversationOut->where('type','in') as $item)
                                        <tr>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                    {{ $item->subject  }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->status == "done")
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if($item->status == "doing")
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->start_at ? \Morilog\Jalali\Jalalian::forge($item->start_at)->format('Y/m/d - H:i:s') : '-' }}
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

                            {{ $User_ConversationOut->links() }}
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
                                        <th>نام مشاور</th>
                                        <th>توضیحات</th>
                                        <th>وضعیت</th>
                                        <th>زمان انجام مشاوره</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($User_ConversationIn->where('type','out') as $item)
                                        <tr>
                                            <td>
                                                {{ $item->Advisor ? $item->Advisor->name : "کاربر حذف شده" }}
                                            </td>
                                            <td>
                                                <div class="">
                                                    {{ $item->subject  }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->status == "done")
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if($item->status == "doing")
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->start_at ? \Morilog\Jalali\Jalalian::forge($item->start_at)->format('Y/m/d - H:i:s') : '-' }}
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

                            {{ $User_ConversationIn->links() }}
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
                            <h5>نوبت های لغو شده</h5>
                        </div>
                    </div>

                    <div class="table-email-list">
                        <div class="table-responsive" tabindex="1" style=" outline: none;">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>نام متقاضی</th>
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($User_ConversationNot as $item)
                                        <tr>
                                            <td>
                                                {{ $item->User ? $item->User->fullname : "کاربر حذف شده" }}
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
                           {{ $User_ConversationNot->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection



@section('js')
@endsection
