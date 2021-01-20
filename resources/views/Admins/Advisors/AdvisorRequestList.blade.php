@section('title')
ليست مشاوران
@endsection
@extends('layout.Admins.template')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 py-3 card">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <h4 class="my-5">ليست مشاوران</h4>
                <table id="example1" class="table table-striped ">
                    <thead>
                        <tr>
                            <th>نام مشاور</th>
                            <th>تاريخ ثبت فرم</th>
                            <th>مشاهده / حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\AdvisorsRequest::get() as $item)
                        <tr>
                            <td>{{json_decode($item->advisor_form , true)['name'] . ' ' . json_decode($item->advisor_form , true)['famil'] }}</td>
                            <td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d - H:i:s')   }}</td>
                            <td>
                                <a href="{{route('Admins.AdvisorRequest',$item->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#"
                                class="delete btn btn-danger"
                                data-url="{{route('Admins.AdvisorRequestDelete', $item->id)}}"
                                data-type="table"
                                data-item="مشاور"
                                data-id="{{$item->id}}">
                                <i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">مشاوری ثبت نشده</td>
                        </tr>
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
