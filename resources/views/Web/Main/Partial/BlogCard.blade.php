@forelse($Blogs as $Blog)
<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 outer">
    <div class="item">
        <a class="p-0" href="{{ route('Web.Blog' , $Blog->id) }}">
            <img src="{{ $Blog->Image ? asset($Blog->Image->url)  : asset('assets/Web/images/coronavirus_1.jpg') }}"
                alt="">
        </a>
        <h5 class="mb-0 pb-0">
            <a href="{{ route('Web.Blog' , $Blog->id) }}"
                class="p-0 text-right text-content"> {{ $Blog->title }}
            </a>
        </h5>
        <a href="{{ route('Web.Blog' , $Blog->id) }}"
            class="">{{ $Blog->short_desc }}
        </a>
        <p class="date-content">
            {{ \Morilog\Jalali\Jalalian::forge($Blog->created_at)->format('Y/m/d') }}
        </p>
    </div>
</div>
@empty
<h5 class="text-center w-100 mt-5">موردی یافت نشد</h5>
@endforelse