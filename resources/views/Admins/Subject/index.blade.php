@section('title')
موضوع ها
@endsection
@php
    $subjects =\App\Models\Subject::get();
@endphp
@section('style')
<link rel="stylesheet" href="{{asset('vendor/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
@endsection
@extends('layout.Admins.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 card pb-5">
            <div class="table-responsive" tabindex="1" style=" outline: none;">
                <h4 class="my-5">ليست موضوع ها</h4>

                <table id="example1" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>
                                <p>عنوان موضوع</p>
                            </th>
                            <th>
                                <p>دسته بندی</p>
                            </th>
                            <th>
                                <p>توضیحات مختصر</p>
                            </th>
                            <th>
                                <p>تعداد نظرات در انتظار بررسی</p>
                            </th>

                            <th>
                                <p>تغييرات</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $item)
                        <tr>
                            <td>
                                <p>{{$item->title}}</p>
                            </td>
                            <td>
                                <p>
                                     {{ str_replace(',' , '، ' , $item->categories)}}
                                </p>
                            </td>
                            <td>
                                <p>{{mb_substr($item->description,0,50)}}...
                                </p>
                            </td>
                            <td>
                                <p>{{$item->WaitingComments->count()}}
                                </p>
                            </td>

                            <td>
                                <a href="{{ route('Admins.Subject.edit' , $item->id ) }}"
                                    class="d-inline-block my-1 btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="delete btn btn-danger"
                                    data-url="{{route('Admins.Subject.destroy','Delete')}}" data-type="table"
                                    data-item="موضوع" data-id="{{$item->id}}">
                                    <i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 card pb-5">
            @php
                $WaitingComments = App\Models\SubjectComments::where('publication', null)->paginate();
            @endphp            
            @if ($WaitingComments)
                <div class="table-responsive" tabindex="1" style=" outline: none;">
                    <h4 class="my-5">لیست نظرات در انتظار تایید</h4>

                    <table id="example1" class="subject-comment-table table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>
                                    <p>عنوان موضوع</p>
                                </th>
                                <th>
                                    <p>نام کاربر</p>
                                </th>
                                <th>
                                    <p>متن</p>
                                </th>
                                <th>
                                    <p>تغييرات</p>
                                </th>
                                <th>
                                    <p>حذف</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($WaitingComments as $item)
                                <tr>
                                    <td>
                                        <p>{{ $item->Blog ? $item->Subject->title : '-'}}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->User ? $item->User->fullname : 'کاربر ناشناس'}}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->text }}</p>
                                    </td>
                                    <td>
                                        <p data-id="{{ $item->id }}" data-url="{{ route('Admins.SubjectComments.publication') }}"
                                            class="publication d-inline-block my-1 btn {{ $item->publication == 'off' || $item->publication == null ? 'btn-secondary' : 'btn-success' }}">
                                            @if ($item->publication == null )
                                                در انتظار تاييد
                                            @endif
                                            @if ($item->publication == 'on' )
                                                تایید شده
                                            @endif
                                            @if ($item->publication == 'off' )
                                                تایید نشده
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <a href="javascript:void()" class="delete btn btn-danger"
                                             data-url="{{ route('Admins.SubjectComments.delete','Delete') }}"
                                            data-type="table" data-item="کامنت" data-id="{{ $item->id }}">
                                            <i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">موردی ثبت نشده است</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $WaitingComments->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('vendor/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/examples/datatable.js')}}"></script>
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
@include('components.ajax.delete')
@endsection
