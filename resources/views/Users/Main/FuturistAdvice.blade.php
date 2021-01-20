@extends('layout.Users.template')
@section('title', 'نوبت های رزرو شده')

@section('style')

@endsection



@section('content')

    @php
    $User_id = Auth::user()->id;
    $Conversations = App\Models\Conversation::where('user_id' , $User_id)->where('status' , 'to_do')->where('status', 'doing')->paginate(15);
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
                                            <th>نام مشاور</th>
                                            <th>موضوع</th>
                                            <th>زمان شروع</th>
                                            <th>کد رزرو</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Conversations->where('type','online') as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->Advisor ? $item->Advisor->name : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    {{ $item->code }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">
                                                    موردي يافت نشد!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <nav class="m-t-30 d-flex justify-content-center">

                            {{ $Conversations->links() }}
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
                                            <th>موضوع</th>
                                            <th>زمان شروع</th>
                                            <th>کد رزرو</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Conversations->where('type','in') as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->Advisor ? $item->Advisor->name : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    {{ $item->code }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">
                                                    موردي يافت نشد!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
                            {{ $Conversations->links() }}
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
                                            <th>موضوع</th>
                                            <th>زمان شروع</th>
                                            <th>کد رزرو</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Conversations->where('type','out') as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->Advisor ? $item->Advisor->name : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                    <div data-countdown="{{ $item->start_at }}" class="mt-2 text-danger"></div>
                                                </td>
                                                <td>
                                                    {{ $item->code }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">
                                                    موردي يافت نشد!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
                            {{ $Conversations->links() }}
                        </nav>
                    </div>
                </div>

            </div>
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

    </script>
@endsection
