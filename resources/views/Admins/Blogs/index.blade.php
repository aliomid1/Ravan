@extends('layout.Admins.template')
@section('title')
لیست مقالات ثبت شده
@endsection
@section('content')
@php
    $list=\App\Models\Blog::paginate(12);
@endphp

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>لیست مقالات ثبت شده</h5>
                    <div class="row">
                        @if(count($list))
                            @foreach($list as $item)
                                <div class="col-md-3 itemcard">
                                    <div class="card border">
                                        <div class="card-body">
                                            @php
                                                $image =
                                                \App\Models\Image::where(['type'=>'blogs','item_id'=>$item->id])->first();
                                            @endphp
                                            <img src="{{ asset($image?$image->url:'') }}"
                                                class="img-fluid mb-3" alt="img">
                                            <h5 class="card-title">{{ $item->title }} </h5>
                                            <div class="row align-items-center mt-3 mx-3 justify-content-between">
                                                <div>
                                                    <a data-url="{{ route('Admins.Blogs.destroy','delete') }}"
                                                        data-type="item" data-parent=".itemcard" data-item="مقاله"
                                                        data-id="{{ $item->id }}" data-typesend="DELETE"
                                                        class="btn btn-danger  btn-sm text-white delete">
                                                        <i class="fa fa-trash"></i></a>
                                                    <a href="{{ route('Admins.Blogs.edit' , $item->id) }}"
                                                        class="btn btn-primary  btn-sm text-white">
                                                        <i class="fa fa-pencil"></i></a>
                                                </div>
                                                <a href="{{ route('Admins.Blogs.show',$item->id) }}"
                                                    class="text-primary">خواندن</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 text-center text-danger">
                                <p>هیچ مقاله ای ثبت نشده است</p>
                            </div>
                        @endif

                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @if ($WaitingComments)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" tabindex="1" style=" outline: none;">
                        <h4 class="my-5">ليست نظرات در انتظار تایید</h4>

                        <table id="example1" class="subject-comment-table table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>
                                        <p>عنوان وبلاگ</p>
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
                                            <p>{{ $item->Blog ? $item->Blog->title : '-'}}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->User ? $item->User->fullname : 'کاربر ناشناس'}}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->text }}</p>
                                        </td>
                                        <td>
                                            <p data-id="{{ $item->id }}" data-url="{{ route('Admins.BlogsComments.publication') }}"
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
                                                data-url="{{ route('Admins.BlogsComments.delete','Delete') }}"
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
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('assets/Web/js/custom.js') }}"></script>
@include('components.ajax.delete')
@endsection
