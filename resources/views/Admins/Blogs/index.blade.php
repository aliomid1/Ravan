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
        </div>
    </div>
</div>

@endsection
@section('js')
@include('components.ajax.delete')
@endsection
