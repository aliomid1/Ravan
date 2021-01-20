@extends('layout.Admins.template')
@section('title','سوالات متداول')
@section('content')

<div class="container-fluid">
    <div class="col-12 card p-4">
        <div class="page-header">
            <div>
                <h4>چطور از {{ env('SiteBrand') }} استفاده کنم؟</h4>
            </div>
        </div>
        <div class="container">
            <h4>سوال جدید</h4>
            <form action="{{ route('Admins.AddQuestionHow') }}" method="post">
                @csrf
                <div class="row align-items-end justify-content-center">
                    <div class="form-group col-md-12">
                        <label for="my-input">عنوان</label>
                        <input id="my-input" class="form-control" type="text" required name="title">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="my-input">توضیحات</label>
                        <textarea name="description" class="form-control" required rows="4"></textarea>
                    </div>

                    <div class="form-group col-md-12 text-left">
                        <button type="submit" class="btn btn-warning text-white">ثبت سوال</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-12 card p-4">
        <div class="row">
            <div class="col-md-12">
                <h4>لیست سوالات چطور از {{ env('SiteBrand') }} استفاده کنم</h4>
                <div id="accordion">
                    @forelse (\App\Models\Question::where('type', 'how')->get() as $key => $item)
                        <div class="card border">
                            <div class="card-header" id="headingOne{{ $key+=1 }}">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapseOne{{ $key }}" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            {{ $key }} - {{$item->title}} <i class="fa fa-angle-down mr-2"></i>
                                        </button>
                                    </h5>
                                    <a href="{{ route('Admins.DeleteQuestionHow',$item->id) }}"
                                        class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </div>
                            <div id="collapseOne{{ $key }}" class="collapse " aria-labelledby="headingOne{{ $key }}"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p class="text-justify">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                       <div class="col-12 p-5">
                           <p>هیج سوالی ثبت نشده</p>
                       </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="col-12 card p-4">
        <div class="page-header">
            <div>
                <h4>چرا به {{ env('SiteBrand') }} اعتماد كنم؟</h4>
            </div>
        </div>
        <div class="container">
            <h4>سوال جدید</h4>
            <form action="{{ route('Admins.AddQuestionWhy') }}" method="post">
                @csrf
                <div class="row align-items-end justify-content-center">
                    <div class="form-group col-md-12">
                        <label for="my-input">عنوان</label>
                        <input id="my-input" class="form-control" type="text" required name="title">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="my-input">توضیحات</label>
                        <textarea name="description" class="form-control" required rows="4"></textarea>
                    </div>

                    <div class="form-group col-md-12 text-left">
                        <button type="submit" class="btn btn-warning text-white">ثبت سوال</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('Admins.AddImageWhy') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="certification_igames col-md-12">
                        <h4 class="mb-4 mt-4 card-title">عکس های تاییدیه</h4>
                        <div class="text-center">
                            <div class="row items">
                                @forelse(\App\Models\Image::where('type' , 'certification_image')->get() as $key => $item)
                                @php
                                    // dd([$key][$item['trust_image']]);
                                    // dd($item);
                                    // dd($item['trust_link']);
                                @endphp
                                        <div class="col-md-4 item  mb-3" >
                                            <div class="custom-file">
                                                <input type="file" class="image custom-file-input customFile" name="questions[certif_image][{{ $key }}]">
                                                <label class="custom-file-label" for="customFile">انتخاب
                                                    عکس</label>
                                                </div>
                                                <div class="row justify-content-center mt-3 mx-auto col-6">
                                                    <img class="image justify-content w-100"
                                                        src="{{ asset($item->url) }}" alt="عکسی انتخاب نشده است">
                                                </div>
                                            <a href="{{ route('Admins.DeleteImageWhy', $item->id) }}" class="text-center btn btn-danger mt-2 mx-1">حذف</a>
                                        </div>
                                        @empty
                                        <div class="col-md-4 item  mb-3" >
                                            <div class="custom-file">
                                                <input type="file" class="image custom-file-input customFile" name="questions[certif_image][0]">
                                                <label class="custom-file-label" for="customFile">انتخاب
                                                    عکس</label>
                                            </div>
                                            <div class="row justify-content-center mt-3">
                                                <img class="image justify-content col-7" src=""
                                                    alt="عکسی انتخاب نشده است">
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <a href="javascript:void()" class="add-row btn btn-primary mx-1">افزودن
                                        عکس جدید</a>
                                </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <button type="submit" class="btn btn-warning text-white">ثبت عکس(ها)</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-12 card p-4">
        <div class="row">
            <div class="col-md-12">
                <h4>لیست سوالات چرا به {{ env('SiteBrand') }} اعتماد كنم</h4>
                <div id="accordion">
                    @forelse (\App\Models\Question::where('type' , 'why')->get() as $key => $item)
                        <div class="card border">
                            <div class="card-header" id="headingOne{{ $key+=1 }}">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapseOne{{ $key }}" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            {{ $key }} - {{$item->title}} <i class="fa fa-angle-down mr-2"></i>
                                        </button>

                                    </h5>
                                    <a href="{{ route('Admins.DeleteQuestionWhy',$item->id) }}"
                                        class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </div>
                            <div id="collapseOne{{ $key }}" class="collapse " aria-labelledby="headingOne{{ $key }}"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p class="text-justify">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                       <div class="col-12 p-5">
                           <p>هیج سوالی ثبت نشده</p>
                       </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('assets/Web/js/custom.js') }}"></script>
@endsection
