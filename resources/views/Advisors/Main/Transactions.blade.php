@extends('layout.Advisors.template')
@section('title', 'اطلاعات مالی')
    @php
    $Persent = \App\Models\Settings::first()->persent;
    $Advisor = Auth::guard('advisor')->User();
    $AdvisorPayment = $Advisor->Payment();
    $AdvisorPaymentP = $Advisor->Payment()->paginate(10);
    $trxs = \App\Models\Transaction::where(['advisor_id'=>$Advisor->id,'status'=>'true'])
    ->where('type','!=','plan')
    ->get();
    $trxsblock=0;
    if($trxs){
        foreach($trxs as $tx){
              
            if($tx->Conversation){
                if($tx->Conversation->status!='done'){
             
                   $trxsblock+=$tx->price;
                }
            }
        }
    }
  
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
                        <div class="col-xl-4">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>تعداد برداشت از حساب شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $AdvisorPayment->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="row mb-3">
                                <div class=" col-sm-7">
                                    <p>
                                        <b>مجموع مبلغ برداشت شده از حساب شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-5">
                                    <p>{{ number_format($AdvisorPayment->sum('amount')) }} تومان
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">
                            <div class="row mb-3">
                                <div class=" col-sm-6">
                                    <p>
                                        <b>تعداد مشاوره های انجام شده شما</b>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $trxs->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive" tabindex="1" style=" outline: none;">
                        <h4 class="mt-5">ریز اطلاعات درآمد</h4>
                        <table class="table m-t-b-50 text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th class="">نوع مشاوره</th>
                                    <th class="">موضوع</th>
                                    <th class="">مقدار مشاوره به دقیقه</th>
                                    <th class="">درآمد </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $trxs as $key22=> $item)
                                    <tr class="">
                                        <td class="">{{ $key22 + 1 }}</td>
                                        <td class="">
                                            {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d') }}
                                        </td>
                                        @php
                                        $chat =$item->Conversation;
                                        
                                        $typess='';
                                        $time = 0;
                                        $subject='';
                                        switch ($item->type) {
                                        case 'chat':
                                        $typess='در لحظه';
                                        if ($chat) {
                                        $time=$chat->time;
                                        $subject=$chat->subject;
                                        }else{
                                        $time='نامشخص';
                                        }
                                        break;

                                        case 'online':
                                        $typess='گفتگو رزرو شده انلاین';
                                        if ($chat) {
                                        $time=$chat->time;
                                        $subject=$chat->subject;
                                        }else{
                                        $time='نامشخص';
                                        }
                                        break;

                                        case 'out':
                                        $typess='گفتگو رزرو شده حضوری';
                                        if ($chat) {
                                        $time=$chat->time;
                                        $subject=$chat->subject;
                                        }else{
                                        $time='نامشخص';
                                        }
                                        break;
                                        }
                                        @endphp
                                        <td class="">{{ $typess }}</td>
                                        <td class="">{{ $subject }}</td>
                                        <td class="">{{ $time }} </td>
                                        <td class="">{{ number_format($item->price) }} تومان</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5" class="text-center">موردي يافت نشد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="text-center">
                                <tr class="text-success ">
                                    <th colspan="">مجموع درآمد :</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ number_format($trxs->sum('price')) }} تومان
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <nav class="m-t-30 d-flex justify-content-center">



                    </nav>
                    <div class="table-responsive" tabindex="1" style=" outline: none;">
                        <h4 class="mt-5">ریز اطلاعات برداشت از حساب</h4>
                        <table class="table m-t-b-50 text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ برداشت از حساب </th>
                                    <th class="">شماره پیگیری</th>
                                    <th class="">مبلغ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($AdvisorPaymentP as $item)
                                    <tr class="">
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">{{ $item->status == 'done' ? 'واریز شد' : 'درحال برسی' }}</td>
                                        <td class="">
                                            {{ $item->updated_at ? \Morilog\Jalali\Jalalian::forge($item->updated_at)->format('Y/m/d') : '-' }}
                                        </td>
                                        <td class="">{{ $item->code_ref }}</td>
                                        <td class="">{{ number_format($item->amount) }} تومان </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">موردي يافت نشد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="text-center">
                                <tr class="text-success ">
                                    <th colspan="4" class="text-right">مجموع وجوه برداشت شده از حساب شما :</th>
                                    <th>{{ number_format($AdvisorPayment->sum('amount')) }} تومان
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
                        {{ $AdvisorPaymentP->links() }}
                    </nav>
                    <div class="text-right">
                        <p>جمع درآمد : {{ number_format($trxs->sum('price')) }} تومان</p>
                        <p>مجموع وجوه برداشت شده از حساب شما: <span
                                class="text-danger">{{ number_format($AdvisorPayment->sum('amount')) }} تومان</span>
                        </p>
                        <h4 class="font-weight-800 primary-font text-success">مبلغ قابل برداشت از حساب شما:
                            {{ number_format($trxs->sum('price') - $AdvisorPayment->sum('amount')-$trxsblock)  }}
                            تومان
                        </h4>
                    </div>
                </div>
                <div class=" d-print-none">
                    <hr class="m-t-b-50">
                    <form action="{{ route('Advisors.RequestWithdraw') }}" method="post">
                        @csrf
                        <div class="row justify-content-between align-items-end">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="my-input">شماره کارت</label>
                                    <input id="my-input" class="form-control" required type="number" name="card">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="my-input">مبلغ درخواستی</label>
                                    <input id="my-input" class="form-control" required type="number" name="price">
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <button class="btn btn-primary">
                                    <i class="fa fa-send"></i> برداشت از حساب
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
