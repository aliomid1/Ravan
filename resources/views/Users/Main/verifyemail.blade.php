<div class="card">
    <div class="card-body">
        <h5 class="card-title d-flex justify-content-between align-items-center">
            اطلاعات
        </h5>
        @if (auth()->User()->verify_email != 'ok')
            <h6 class="my-4"> ابتدا باید ایمیل خود را تایید کنید</h6>
        @endif
        <div class="row form-group ">
            <div class="col-6 col-sm-4 text-muted">ايميل <span class="text-danger">*</span></div>
            <div class="col-6 col-sm-8">
                <input class="form-control emailuser" @if (auth()->User()->verify_email == 'ok')

                disabled
                @endif name="email" type="email" value="
                {{ auth()->User()->email }}" placeholder="ايميل" required>
                <span class="text-danger mt-1 d-block">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        @if (auth()->User()->verify_email != 'ok')
        <div class="row form-group mt-3 code verify" 
        @if (auth()->User()->verify_email == null) style="display: none"
        @endif >
            <div class="col-6 col-sm-4 text-muted">کد تایید دریافت شده را وارد کنید<span class="text-danger">*</span></div>
            <div class="col-6 col-sm-8">
                <input type="number" class="form-control codevv">
        </div>
    </div>
    <div class="col-12 text-center ">
        <button class="btn btn-success checkcode m-2 " data-url="{{ route('Users.VerifyEmail') }}" @if (auth()->User()->verify_email == null) style="display: none" @endif
        >برسی</button>
    </div>
        <div class="col-12 text-center " 
            >
            <button class="btn btn-success m-2 sendcode" data-url="{{ route('Users.SendCodeEmail') }}">
                @if (auth()->User()->verify_email != null)
                     ارسال مجدد کد 
                @else 
                    ارسال کد        
                    تایید
                @endif
            </button>
        </div>
    @endif
</div>
</div>
