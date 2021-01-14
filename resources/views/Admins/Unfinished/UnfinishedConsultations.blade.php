@extends('layout.Advisors.template')
@section('title', 'داشبورد')
@section('content')
    @php
    $Conversations = App\Models\Conversation::where('status' ,'not')->paginate(15);
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div>
                <h3>مشاوره های تمام نشده</h3>
            </div>
        </div>
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
                                            <th>زمان شروع</th>
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
                                                    {{ $item->Advisor ? $item->Advisor->name : 'کاربر حذف شده' }}
                                                </td>
                                                <td>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->start_at)->format('H:i:s - Y/m/d') }}
                                                </td>
                                                <td>

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
    </div>
@endsection
