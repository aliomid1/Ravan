@extends('layout.Admins.template')
@section('title','پشتیبانی')
@section('content')

<div class="container-fluid ">
    <div class="row">
        <div class="col-md-12 card pb-4">

            <div class="row">
                <div class="col-md-12 ">
                    <div class="table-responsive">
                        <h4 class="my-5">ليست تیکت ها</h4>
                        <table id="example1" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>شماره تیکت</th>
                                    <th>نام کاربری</th>
                                    <th>عنوان</th>
                                    <th>تاریخ</th>
                                    <th>وضعیت</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $list = \App\Models\Support::get();
                                @endphp
                                @forelse ($list as $key => $item)
                                @php
                                $status ='';
                                switch ($item->status) {
                                case 'new':
                                $status ='<span class="text-danger">جدید</span>';
                                break;
                                case 'ok':
                                $status ='<span class="text-success">پاسخ داده شد</span>';
                                break;
                                default:
                                $status='';
                                break;
                                }
                                @endphp

                                <tr>
                                    <td>{{ $key+=1 }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->User?$item->User->fullname:'کاربر حذف شده' }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('H:i -- Y/m/d') }}
                                    </td>
                                    <td>{!! $status !!}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('Admins.SupportShow',$item->id) }}"
                                                    class="dropdown-item">پاسخ</a>
                                                <a href="{{ route('Admins.SupportDelete',$item->id) }}"
                                                    class="dropdown-item">حذف</a>
                                            </div>
                                        </div>
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
    </div>

</div>

@endsection
@section('js')
<script src="{{asset('vendor/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/examples/datatable.js')}}"></script>
@include('components.ajax.delete')
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
@endsection
