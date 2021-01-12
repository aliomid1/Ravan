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
                            <th>تاريخ عضويت</th>
                            <th>مقدار مشاوره به دقيقه</th>
                            <th>كل درآمد</th>
                            <th>ویرایش / حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\Advisors::get() as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{\Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d')}}</td>
                            <td>{{$item->Conversation->sum('time')}} دقیقه</td>
                            <td>{{number_format($item->Conversation->sum('price'))}} تومان</td>
                            <td>
                            <a href="{{route('Admins.Advisors.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="#"
                            class="delete btn btn-danger"
                            data-url="{{route('Admins.Advisors.destroy','Delete')}}"
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
