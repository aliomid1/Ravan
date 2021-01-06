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
                <a class="nav-link @if ($first==$key) active
                @endif" id="home-{{ $key }}" data-toggle="tab" href="#{{ $key }}" role="tab"
                   aria-controls="{{ $key }}"
                   aria-selected="true">{{ $type}}</a>
            </li>
        @empty

        @endforelse
    </ul>
    <div class="tab-content" id="myTabContent">
        @forelse ($ConsultationsTimes as $key => $Val)
        @php
            $first= array_key_first($ConsultationsTimes);
        @endphp
            <div class="tab-pane fade show @if ($first==$key)
                active
            @endif" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
                @foreach ($Val as $Date => $item)
                    <h6 class="bg-warning text-center p-2 cardd-header d-flex align-items-center justify-content-center">

                        <p class="mx-auto mb-0"> لیست زمانی شما برای تاریخ {{ $Date }} <span
                                class="fa fa-plus mr-2 text-white"></span>
                        </p>
                        <form action="{{ route('Advisors.SetAdvisesTime.delete') }}" method="post">
                            @csrf
                            {{-- @method('delete') --}}
                            <input type="hidden" name="Key" value="{{ $key }}">
                            <input type="hidden" name="Date" value="{{ $Date }}">
                            <button type="submit" class="btn btn-danger justify-content-self-start " href=""><i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </h6>
                    <div class="cardd-body none">
                        <div class="row">
                            @php
                                // dd($item);
                                sort($item);
                            @endphp
                            @forelse ($item as $values)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 ">
                                    {!! $values['Status'] == '1' ? '' :
                                    '<del class="text-danger">' !!} {{ $values['Time'] . ' - ' . Carbon\Carbon::parse($values['Time'])->addMinutes($TimeOfOneCosultation)->format('H:i') }} {!! $values['Status']
                                == '1' ? '' : '</del>' !!}
                                </div>
                            @empty
                                <h6 class=" text-center p-2">موردی یافت نشد.</h6>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
        @endforelse
    </div>
@else
    <p class=" text-center p-2">موردی یافت نشد.</p>
@endif
