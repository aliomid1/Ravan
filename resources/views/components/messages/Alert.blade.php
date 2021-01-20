@if(session()->has('toast'))

<span style="display: none" id="Alert-Message" data-type="{{session('toast.type')}}" data-message="{{session('toast.message')}}"></span>
@endif
