@extends('layout.web.template')
@section('title','درباره ما')



@section('style')

@endsection



@section('content')
    <div id="up-site" style=" background-image: linear-gradient(to right, #5ad2a0, rgba(90, 210, 160, .5), #5ad2a0), url( {{ asset( $Image ? $Image->url : 'assets/Web/images/group.jpg') }})">
        <div>
            <h2 id="text-image">
                {{ $AboutUs->title }}
            </h2>
            <p id="short-dis-img">
                {{ $AboutUs->description }}
            </p>
        </div>
    </div>
    <div class="container">
        <h3 id="score">امتیازات {{ env('SiteBrand') }}</h3>
        <div class="row justify-content-center text-center " id="parent-score">
            @forelse ($Advantages as $item)
                <div class="item-score col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <h2>{{ $item['title'] }}</h2>
                    <p>{{ $item['short_desc'] }}</p>
                </div>                
            @empty
                
            @endforelse
        </div>

        <h4  class="text-center mb-4">اهداف</h4>
        <p class="text-center">{{ $AboutUs->target }}</p>
    </div>
@endsection



@section('js')
@endsection
