@extends('layout.Advisors.template')
@section('title', 'داشبورد')
    @php
    $user= Auth::guard('advisor')->user();
    $Supports= \App\Models\Support::where(['user_id'=>$user->id,'type_user'=>'advisor'])->get();
    @endphp
@section('content')
    <div class="container-fluid">

        <!-- begin::page header -->
        <div class="page-header">
            <div>
                <h3>پشتیبانی</h3>
            </div>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="ti-plus m-l-5"></i> تیکت جدید
            </button>
        </div>
        <!-- end::page header -->

        <div class="card chat-app-wrapper">
            <div class="row chat-app">
                <div class="col-lg-3 chat-sidebar">
                    {{-- <div class="chat-sidebar-search">
                        <form>
                            <input type="text" class="form-control" placeholder="جستجوی تیکت ...">
                        </form>
                    </div> --}}
                    <div class="chat-sidebar-messages"
                        style="overflow: hidden; outline: none; cursor: grab; touch-action: none;">
                        <div class="list-group">
                            @forelse ($Supports as $item)
                                <a href="#" data-id="{{$item->id}}" data-url="{{route('Advisors.Supports.show','id')}}" class="list-group-item align-items-center d-flex list-group-item-action open-ct">
                                    <div>
                                        <figure class="avatar avatar-sm">
                                            <span
                                                class="avatar-title bg-success rounded-circle">{{ mb_substr($item->title, 0, 1,'utf-8') }}</span>
                                        </figure>
                                    </div>
                                    <div>
                                        <h6 class="m-0 primary-font">{{mb_substr($item->title,0,50)}}</h6>
                                    </div>

                                </a>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 chat-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('Advisors.Supports.store')}}" method="post">
                <input type="hidden" name="type_user" value="advisor">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد تیکت</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my-input">عنوان تیکت</label>
                            <input id="my-input" class="form-control" type="text" name="title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ایجاد</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('.open-ct').click(function () {
            var id = $(this).data('id');
            var url = $(this).data('url');
            var type_user = 'advisor';
                $.ajax({
                url: url,
                data:{id:id,type_user:type_user},
                success: function (response) {
                   $('.chat-body').html(response);
                   $('.open-ct').children('.badge').removeClass('badge-primary');
                }
            });
        });

        $(document).on('click','#sendmessageg',function () {

            var url = $(this).data('url');
            var text = $(document).find('.text-messagesuppo').val();
            var type_user = 'advisor';
            var id = $(this).data('id');
            if (text!='') {
                $.ajax({
                url: url,
                type:"POST",
                data:{id:id,type_user:type_user,text:text},
                success: function (response) {
                   $('.chat-body').html(response);
                }
            });
            } else {
                toastr.error('متن پیام را بنویسید');
            }

        })
    });
</script>
@endsection
