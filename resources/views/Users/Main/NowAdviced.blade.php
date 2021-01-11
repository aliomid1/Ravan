@extends('layout.Users.template')
@section('title','تاریخچه مشاوره ها')

@section('style')

@endsection



@section('content')

@php
    $User_id = Auth::user()->id;
    $User_Conversation = \App\Models\Conversation::where('user_id' , $User_id)->whereIn('status', ['done' ,
    'doing'])->orderBy('updated_at')->paginate(15);
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
                                    @forelse($User_Conversation->where('type','online') as $item)
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
                            {{-- <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">قبلی</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">بعدی</a>
                            </li> --}}
                            {{ $User_Conversation->links() }}
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
                                    @forelse($User_Conversation->where('type','in') as $item)
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

                            {{ $User_Conversation->links() }}
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
                                    @forelse($User_Conversation->where('type','out') as $item)
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

                            {{ $User_Conversation->links() }}
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
