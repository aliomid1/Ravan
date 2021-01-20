@section('title')
    واریزی ها برای مشاوران
@endsection
@extends('layout.Admins.template')
@section('style')
@endsection
@php
$DonePayment = \App\Models\Payment::paginate(10);
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
                                        <b>تعداد واریزی ها به حساب مشاوران</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $DonePayment->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>مجموع مبلغ واريزي به حساب مشاوران</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $DonePayment->sum('amount') }} تومان
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" tabindex="1" style=" outline: none;">
                        <h4 class="mt-5">ریز اطلاعات واريز به حساب مشاوران</h4>
                        <table class="table m-t-b-50 text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>تاریخ واریز</th>
                                    <th>نام مشاور</th>
                                    <th>شماره کارت درخواست کننده</th>
                                    <th>شماره پیگیری</th>
                                    <th>مبلغ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($DonePayment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->updated_at ? \Morilog\Jalali\Jalalian::forge($item->updated_at)->format('Y/m/d - H:i:s') : '-' }}
                                        </td>
                                        <td>{{ $item->Advisor->name }}</td>
                                        <td>{{ $item->card }}</td>
                                        <td>{{ $item->code_ref }}</td>
                                        <td>{{ number_format($item->amount) }} تومان </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a href="#" data-toggle="modal" data-id="{{ $item->id }}"
                                                        data-target="#exampleModal" class="dropdown-item payt">پرداخت شد</a>
                                                    <a href="{{ route('Admins.SupportDelete', $item->id) }}"
                                                        class="dropdown-item">حذف</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">موردي يافت نشد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="text-center">
                                <tr class="text-success ">
                                    <th colspan="">مجموع وجوه درخواست شده از شما :</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ number_format($DonePayment->sum('amount')) }} تومان
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <nav class="m-t-30 d-flex justify-content-center">
                        {{ $DonePayment->links() }}
                    </nav>
                </div>

            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('Admins.DepositToAdvisorsAccount.status')}}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اطلاعات پرداخت</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            @csrf
                            <input type="hidden" name="id" id="idd">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my-input">کد پیگیری پرداخت</label>
                            <input id="my-input" class="form-control" required type="text" name="code_ref">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('.payt').click(function() {
        var id = $(this).data('id');
        $('#idd').val(id);
    });
</script>
@endsection
