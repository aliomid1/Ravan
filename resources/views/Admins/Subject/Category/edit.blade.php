@section('title')
افزودن مشاور
@endsection
@extends('layout.Admins.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <h5 class="card-title">افزودن دسته بندی</h5>
                <form class="" action="{{route('Admins.SubjectCategories.update','update')}}" novalidate="" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>عنوان دسته </label>
                            <input type="text" class="form-control" value="{{$category->title}}" required name="title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>عکس</label>
                            <input type="file" class="form-control" name="image" />
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-md-12 mb-3">
                            <label>کلمات کلیدی سئو</label>
                            <input type="text" class="form-control" value="{{$category->keywords_seo}}" required
                                name="keywords_seo">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label> توضیحات سئو</label>
                            <textarea name="description_seo" class="form-control" required
                                rows="4">{{$category->description_seo}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center border-top pt-3 mt-4">
                        <button class="btn btn-success" type="submit">ویرایش دسته</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
