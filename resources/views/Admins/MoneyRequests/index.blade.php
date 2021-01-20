@section('title')
درخواست ها
@endsection
@extends('layout.Admins.template')
@section('style')
@endsection

@php
    $ToDoPayment = \App\Models\Payment::where('status' , 'to_do')->paginate(10);
@endphp

@section('content')
<div class="container-fluid">

    <!-- begin::page header -->
    <div class="page-header">
        <div>
            <h3>اطلاعات مالی</h3>
        </div>
    </div>
    <!-- end::page header -->

    <div class="card">
        <div class="card-body p-50">
            <div class="invoice">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row mb-3">
                            <div class=" col-sm-6">
                                <p>
                                    <b>تعداد درخواست های در صف واريز براي مشاوران</b>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p>{{ $ToDoPayment->count() }}  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row mb-3">
                            <div class=" col-sm-6">
                                <p>
                                    <b>مجموع مبلغ درخواستي در صف واريز براي مشاوران</b>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p>{{ $ToDoPayment->sum('amount') }} تومان
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" tabindex="1" style=" outline: none;">
                    <h4 class="mt-5">ریز اطلاعات درخواست وجه مشاوران</h4>
                    <table class="table m-t-b-50 text-center">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>تاریخ درخواست</th>
                                <th>نام مشاور</th>
                                <th class="">مبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ToDoPayment as $item)
                                <tr class="">
                                    <td class="">{{ $loop->iteration }}</td>
                                     <td class="">
                                        {{ $item->updated_at ? \Morilog\Jalali\Jalalian::forge($item->updated_at)->format('Y/m/d') : '-' }}
                                    </td>
                                    <td class="">{{ $item->code_ref }}</td>
                                    <td class="">{{ $item->amount }} تومان </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">موردي يافت نشد</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="text-center">
                            <tr class="text-success ">
                                <th colspan="">مجموع وجوه برداشت شده از حساب شما :</th>
                                <th></th>
                                <th></th>
                                <th>{{ ($ToDoPayment->sum('amount')) }} تومان
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <nav class="m-t-30 d-flex justify-content-center">
                    {{-- <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">قبلی</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">بعدی</a>
                        </li>
                    </ul> --}}
                    {{ $ToDoPayment->links() }}
                </nav>

            </div>
            <div class="text-left d-print-none">
                <hr class="m-t-b-50">
                <a href="#" class="btn btn-primary">
                    <i class="fa fa-send m-l-5"></i> صفحه ی برداشت از حساب
                </a>
                {{-- <a href="javascript:window.print()" class="btn btn-success m-r-5">
                    <i class="fa fa-print m-l-5"></i> چاپ
                </a> --}}
            </div>
        </div>
    </div>

</div>
@endsection



@section('js')

@endsection
