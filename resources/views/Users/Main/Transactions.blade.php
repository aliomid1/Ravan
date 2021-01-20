@extends('layout.Users.template')
@section('title', 'داشبورد')

@section('style')
@endsection



@section('content')
    @php
    $User = Auth::user();
    $UserConversation = $User->Conversation()->paginate(15);
    $UserWallet = $User->Wallet()->get();
    $UserGiftWallet = $User->Wallet()->where('type' , 'friend')->get();
    // dd($UserWallet);
    $TotalCost = 0;
    @endphp



    <div class="container-fluid">

        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>کیف پول</h3>
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
                                        <b>تعداد دریافتی به کیف شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p> {{ $UserWallet->where('type','!=','withdraw')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>مجموع مبلغ دریافتی شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p> {{ number_format($UserWallet->where('type','!=','withdraw')->sum('amount')) }} تومان
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>تعداد افراد دعوت شده توسط شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $UserGiftWallet->where('type', 'friend')->count() }} نفر
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>مجموع دریافتی اعتبار هدیه</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p> {{ number_format($UserGiftWallet->sum('amount')) }} تومان
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive" tabindex="1" style=" outline: none;">
                        <h4 class="mt-5">ریز واریز ها به کیف پول شما</h4>
                        <table class="table m-t-b-50 text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th class="">توضیحات</th>
                                    <th class="">مبلغ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $UserWallet as $item)
                                    <tr class="">
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">
                                            {{ $item->created_at ? \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d - H:i:s') : '-' }}
                                        </td>
                                        <td class="">
                                            @if ($item->type)
                                                @if ($item->type == 'friend')
                                                    {{ ' اعتبار دعوت از دوست' }}
                                                @endif
                                                @if ($item->type == 'deposit')
                                                    {{ ' واریز از درگاه پرداخت' }}
                                                @endif
                                                @if ($item->type == 'withdraw')
                                                    {{ 'برداشت از کیف پول' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="@if ($item->type == 'withdraw') text-danger @endif">{{ number_format($item->amount) }} </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="4" class="text-center">موردي يافت نشد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="text-center">
                                <tr class="text-success ">
                                    <th colspan="">مجموع پرداختی شما :</th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ number_format($UserWallet->sum('amount')) }} تومان
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <nav class="m-t-30">
                        {{ $UserConversation->links() }}
                    </nav>
                    <div class="col-md-12">
                        <form action="{{ route('Users.AddWalletP') }}" method="post">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <h5>واریز به کیف پول</h5>
                                </div>
                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <label for="my-input">مبلغ پرداخت (تومان)</label>
                                        <input id="my-input" class="form-control" type="text" name="amount">
                                    </div>
                                </div>

                                <div class="col-lg-1 mb-3">
                                    <button class="btn btn-primary">واریز مبلغ</button>
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
