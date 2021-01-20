@forelse($advisor as $item)
<div class="item-list">
    <div id="child-list" class="flex-column flex-lg-row px-3">
        <div class="status">
            <i class={{ ($item->status == 1) ? 'on' : 'off' }}></i>
            <img class="image-list" src="{{ asset($item->Profile ? $item->Profile->url : 'assets/Web/images/doctor.jpg') }}" alt="">
        </div>
        <div id="prop-moshaver" class=" w-100 px-1 ">
            <p id="name-moshaver">{{ $item->name }}</p>
            <p id="short-discription-moshaver">{{ $item->bio }}</p>
            <div id="down-item-list"
                class="align-items-center justify-content-between flex-column flex-lg-row flex-wrap  w-100">
                <div class="right-down-item-moshaver d-flex felx-wrap">
                    <div class="d-flex flex-column align-items-center flex-lg-row mr-2">
                        <h4 class="mr-0">میانگین رتبه مشاور:</h4>
                        <div class="my-2 mx-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i<=($item->
                                    Comment?$item->Comment->avg('score'):''))
                                <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="fas fa-star text-black-50"></i>
                                @endif
                            @endfor
                        </div>
                        <div>
                            <h4> از
                                {{ $item->Conversation ? $item->Conversation->sum('time') : '' }}
                                دقیقه مشاوره
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="mr-lg-auto ml-lg-0 mx-auto">
                    <a href="{{ route('Web.ProfileMoshaver',$item->id) }}"
                        class="show-profile-moshaver d-inline-block">مشاهده
                        پروفایل
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<h5 class="text-center mt-5">موردی یافت نشد</ا>
@endforelse
