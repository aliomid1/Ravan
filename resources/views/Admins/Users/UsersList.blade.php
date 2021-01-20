@section('title','ليست كاربران')
@extends('layout.Admins.template')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 py-3 card">
                <h4 class="my-5">ليست كاربران</h4>
                <div class="table-responsive " tabindex="1" style="overflow: hidden; outline: none;">
                    <table id="example1" class="table table-striped table-bordered">
                        <thead class="">
                            <tr>
                                <th>نام كاربر</th>
                                <th>تاريخ عضويت</th>
                                <th>تعداد مشاوره</th>
                                <th>مقدار مشاوره به دقيقه</th>
                                <th>مجموع واریزی به کیف پول</th>
                                <th>حذف کاربر</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse (\App\User::get() as $user)
                            <tr>
                                <td>{{$user->fullname}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('Y/m/d')}}</td>
                                <td>{{count($user->Conversation)}}</td>
                                <td>{{ $user->Conversation->sum('time') }}</td>
                                <td>{{ $user->Wallet->sum('amount') }} تومان</td>
                                <td><a href="#"
                                    class="delete btn btn-danger"
                                    data-url="{{route('Admins.User.destroy','Delete')}}"
                                    data-type="table"
                                    data-item="کاربر"
                                    data-id="{{$user->id}}">
                                    <i class="fa fa-times"></i></a>
                                    </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('vendor/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/examples/datatable.js')}}"></script>
@include('components.ajax.delete')
@endsection
