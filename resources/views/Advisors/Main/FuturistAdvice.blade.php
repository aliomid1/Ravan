@extends('layout.Advisors.template')
@section('title', 'داشبورد')

@section('style')

@endsection


@section('content')
    @php
    $Advisor_id = Auth::guard('advisor')->User()->id;
    $ConversationsOnline = App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,'!='
    ,'done')->where('type','online')->paginate(15);
    $ConversationsOut = App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,'!='
    ,'done')->where('type','out')->paginate(15);
    $ConversationsIn = App\Models\Conversation::where('advisor_id' , $Advisor_id)->where('status' ,'!='
    ,'done')->where('type','in')->paginate(15);
    @endphp

    <div class="container-fluid">

        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>نوبت های رزرو شده</h3>
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
                                            <th>توضیحات</th>
                                            <th>زمان شروع</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ConversationsOnline as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->User ? $item->User->fullname : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    @if ($item->status == 'doing')
                                                        <p>مشاوره درحال انجام است</p>
                                                    @endif
                                                    @if ($item->status == 'to_do')
                                                        <a href="" class="btn btn-primary text-white">شروع مشاوره</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4"> موردي يافت نشد!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <nav class="m-t-30 d-flex justify-content-center">
                            {{ $ConversationsOnline->links() }}
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
                                            <th>توضیحات</th>
                                            <th>زمان شروع</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ConversationsOut as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->User ? $item->User->fullname : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    @if ($item->status == 'doing')
                                                        <a href="#" data-toggle="modal" data-target="#exampleModal"
                                                             data-id="{{ $item->id }}"
                                                            class="endReserve btn btn-warning text-white">اتمام مشاوره</a>
                                                    @endif
                                                    @if ($item->status == 'to_do')
                                                        <a href="" class="btn btn-primary text-white">شروع مشاوره</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4"> موردي يافت نشد!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <nav class="m-t-30 d-flex justify-content-center">
                            {{ $ConversationsOut->links() }}
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
                                            <th>توضیحات</th>
                                            <th>زمان شروع</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ConversationsIn as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->User ? $item->User->fullname : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    @if ($item->status == 'doing')
                                                        <a href="#" data-toggle="modal" data-target="#exampleModal"
                                                             data-id="{{ $item->id }}"
                                                            class="endReserve btn btn-warning text-white">اتمام مشاوره</a>
                                                    @endif
                                                    @if ($item->status == 'to_do')
                                                        <a href="" class="btn btn-primary text-white">شروع مشاوره</a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4"> موردي يافت نشد!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <nav class="m-t-30 d-flex justify-content-center">
                            {{ $ConversationsIn->links() }}
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('Advisors.EndReserve')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایا مشاوره تمام شد ؟</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="id" id="idd">
                        <div class="form-group">
                            <label>کد رزرو</label>
                            <input class="form-control" type="text" name="code">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/lib/jquery.countdown.js') }}"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime(' مانده: %D روز و %H:%M:%S'));
            });
        });
        $('.endReserve').click(function() {
              var id = $(this).data('id');
              $('#idd').val(id);
        });

    </script>
@endsection
