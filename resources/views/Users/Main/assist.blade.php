@extends('layout.Users.template')
@section('title','دعوت به همكاري')



@section('style')

@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-md-6 mx-auto">
                <h4 style="color: #5bcb9b;text-align: center;margin-top: 10px;">فراخوان همکاری</h4>
                <p style="padding-right: 17px;text-align: start;">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                     است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط 
                    فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای 
                    زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد 
                    تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ 
                    پیشرو در زبان فارسی ایجاد کرد</p>
                <div class="card-body">
                    <h5 class="card-title">فراخوان همکاری</h5>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">نام و نام خانوادگی</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="نام و نام خانوادگی را وارد کنید.">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">شماره همراه</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="شماره همراه را وارد کنید.">
                        </div>
                        <div style="padding-right: 0px;" class="form-group form-check">
                            <label for="examp   leInputPassword1">زمینه همکاری</label>
                            <select class="custom-select custom-select-lg mb-3">
                                <option selected="">زمینه همکاری</option>
                                <option value="1">پزشکی</option>
                                <option value="2">روانشناسی</option>
                                <option value="3">مشاوره کرونا</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">توضیحات</label>
                            <textarea type="password" class="form-control" id="exampleInputPassword1" rows="10"
                                placeholder="شماره همراه را وارد کنید."></textarea>
                        </div>
                        <button style="justify-content: center;width: 100%;height:50px;font-size: 19px;" type="submit"
                            class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    
@endsection
