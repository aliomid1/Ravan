@extends('layout.Admins.template')
@section('title', 'مدیریت پلن ها')
@section('content')

    <div class="container-fluid">
        <div class="col-12 card p-4">
            <div class="page-header">
                <div>
                    <h4>مدیریت پلن ها</h4>
                </div>
            </div>
            <div class="container-fluid">
                <h4>پلن جدید</h4>
                <form action="{{ route('Admins.PlansManagerAdd') }}" method="post">
                    @csrf
                    <div class="row align-items-end justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="my-input">عنوان</label>
                            <input id="my-input" class="form-control" type="text" required name="title">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">قیمت</label>
                            <input id="my-input" class="form-control" type="text" required name="price">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="my-input">زمان استفاده به روز</label>
                            <input id="my-input" class="form-control" type="text" required name="time">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">توضیحات</label>
                            <textarea name="description" class="form-control" required rows="4"></textarea>
                        </div>

                        <div class="form-group col-md-12 text-left">
                            <button type="submit" class="btn btn-warning text-white">ثبت پلن</button>
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
                    <h4>لیست پلن ها</h4>
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>قیمت</th>
                                    <th>زمان</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Plan::get() as $key => $item)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ number_format($item->price) }} تومان</td>
                                        <td>{{ $item->time }} روز</td>
                                        <td class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"
                                                data-url="{{ route('Admins.PlansManagerEdit', $item->id) }}"
                                                class="btn editplan btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-item="پلن" data-typesend="GET" data-type="table"
                                                data-url="{{ route('Admins.PlansManagerDelete', $item->id) }}"
                                                class="btn delete  btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">موردی ثبت نشده</p>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('Admins.PlansManagerUpdate') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" class="idplan" name="id">
                        <div class="form-group col-md-12">
                            <label for="my-input">عنوان</label>
                            <input id="my-input" class="form-control titleplan" type="text" required name="title">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">قیمت</label>
                            <input id="my-input" class="form-control priceplan" type="text" required name="price">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">زمان استفاده به روز</label>
                            <input id="my-input" class="form-control timeplan" type="text" required name="time">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="my-input">توضیحات</label>
                            <textarea name="description" class="form-control descplan" required rows="4"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
@include('components.ajax.delete')
<script>
    $(document).ready(function() {
        $('.editplan').click(function(e) {
            var url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    if (response != false) {
                        $('.modal-title').html(response.title);
                        $('.idplan').val(response.id);
                        $('.titleplan').val(response.title);
                        $('.priceplan').val(response.price);
                        $('.timeplan').val(response.time);
                        $('.descplan').html(response.description);
                    } else {
                        toastr.error('درخواست کامل نیست');

                    }
                }
            });
        });
    })

</script>
@endsection
