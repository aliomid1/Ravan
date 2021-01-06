@if ($ConsultationsTimes)


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @forelse ($ConsultationsTimes as $key => $Val)
            @php
                $type='';
                $first= array_key_first($ConsultationsTimes);
            @endphp
            @switch($key)
                @case('online')
                @php
                    $type='انلاین';
                @endphp
                @break
                @case('in')
                @php
                    $type='تلفنی';
                @endphp
                @break
                @case('out')
                @php
                    $type='حضوری';
                @endphp
                @break
            @endswitch
            <li class="nav-item">
                <a class="nav-link name-moshaver-profile mb-0 @if ($first==$key) active
            @endif" id="home-{{ $key }}" data-toggle="tab" href="#{{ $key }}" role="tab"
                   aria-controls="{{ $key }}"
                   aria-selected="true"><h5>{{ $type}}</h5></a>
            </li>
        @empty

        @endforelse
    </ul>
    <div class="tab-content" id="myTabContent">
        @forelse ($ConsultationsTimes as $key => $Val)
            @php
                $first= array_key_first($ConsultationsTimes);
                $type='';
            @endphp
            @switch($key)
                @case('online')
                @php
                    $type='انلاین';
                @endphp
                @break
                @case('in')
                @php
                    $type='تلفنی';
                @endphp
                @break
                @case('out')
                @php
                    $type='حضوری';
                @endphp
                @break
            @endswitch
            <div class="tab-pane fade show @if ($first==$key)  active @endif" id="{{$key}}" role="tabpanel"
                 aria-labelledby="{{$key}}-tab">
                @foreach ($Val as $Date => $item)
                    <h6 class="bg-info-gradient text-center p-2 cardd-header d-flex align-items-center justify-content-center">
                        <p class="mx-auto mb-0"> لیست زمانی این مشاور {{$type}} برای تاریخ {{ $Date }} <span
                                class="fa fa-plus mr-2"></span></p>
                    </h6>
                    <div class="cardd-body container-fluid none">
                        <div class="row">
                            @php

                                sort($item);
                            @endphp
                            @forelse ($item as $key3 => $values)
                                @if ($values['Status'] == 1)
                                    <div
                                        class="col-12 my-3 px-4 py-4 @if(count($item)!=($key3+1)) border-bottom @endif">
                                        <div class="row">

                                            <div class="col-md-8">

                                                <h5><span>{{ $key3 + 1 }} - </span> انتخاب نوبت  {{$type}} برای ساعت
                                                    {{ $values['Time'] .
                                                                    ' الی ' .
                                                                    Carbon\Carbon::parse($values['Time'])->addMinutes($TimeOfOneCosultation)->format('H:i') }}
                                                </h5>
                                            </div>
                                            <div class="col-md-4 text-left">
                                                <a href="{{route("Web.Checkout",['id'=>$advisor->id,'type'=>$key,'date'=>str_replace('/','-',$Date),'key'=>$key3])}}"
                                                   class="selcecttimee btn btn-warning text-white">انتخاب نوبت</a>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                                @endforeach
                            @empty

                            @endforelse
                        </div>
                    </div>
            </div>
        @empty

        @endforelse
    </div>
@else
    <p class=" text-center p-2">موردی یافت نشد.</p>
@endif
