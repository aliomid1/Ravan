@extends('layout.Advisors.template')
@section('title','داشبورد')

@section('style')

@endsection


@section('content')
@php
    $Advisor_id = Auth::guard('advisor')->User()->id;
    $Advisor_ConversationOnline = \App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,
    'done')->where('type','online')->paginate(15);
    $Advisor_ConversationOut = \App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,
    'done')->where('type','out')->paginate(15);
    $Advisor_ConversationIn = \App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,
    'done')->where('type','in')->paginate(15);
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
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Advisor_ConversationOnline as $item)
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
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
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
                           {{ $Advisor_ConversationOnline->links() }}
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
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Advisor_ConversationOut as $item)
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
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
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
                           {{ $Advisor_ConversationOut->links() }}
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
                                        <th>موضوع</th>
                                        <th>زمان شروع مشاوره</th>
                                        <th>وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Advisor_ConversationIn as $item)
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
                                                @if ($item->status == 'done')
                                                    <span class="text-success">انجام شده</span>
                                                @endif
                                                @if ($item->status == 'doing')
                                                    <span class="text-secondary">در حال انجام...</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $time =\Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d')}}
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
                           {{ $Advisor_ConversationIn->links() }}
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
