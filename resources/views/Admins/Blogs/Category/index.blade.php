@section('title')
دسته بندی
@endsection
@extends('layout.Admins.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 card">
            <div class="table-responsive" tabindex="1" style=" outline: none;">
                <h4 class="my-5">ليست دسته های مقالات</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <p>نام دسته بندي</p>
                            </th>
                            <th>
                                <p>تاريخ ايجاد</p>
                            </th>
                            <th>
                                <p>تعداد بلاگ های ثبت شده</p>
                            </th>
                            <th>
                                <p>تغييرات</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\BlogsCategory::get() as $item)
                        <tr>
                            <td>
                                <p>{{$item->title}}</p>
                            </td>
                            <td>
                                <p>{{$item->created_at ? \Morilog\Jalali\Jalalian::forge($item->created_at)->format('Y/m/d'):'نامشخص'}}
                                </p>
                            </td>
                            <td>
                                <p>{{ $item->GetSubjects($item->title) ? ($item->GetSubjects($item->title)->count()) : '-'}}</p>
                            </td>
                            <td>
                                <a href="{{ route('Admins.BlogsCategories.edit' , $item->id ) }}"
                                    class="d-inline-block my-1  btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#" class="delete btn btn-danger"
                                    data-url="{{route('Admins.BlogsCategories.destroy','Delete')}}" data-type="table"
                                    data-item="دسته" data-id="{{$item->id}}">
                                    <i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @empty
                        <p>دسته بندي اي وجود ندارد</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@include('components.ajax.delete')
@endsection
