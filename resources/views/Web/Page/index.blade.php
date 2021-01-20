@extends('layout.web.template')
@section('title',$page->title)
@section('keywords',$page->keywords)
@section('description',$page->description)
@section('content')
<div style="margin-top: 8rem" class="container">
    {!!$page->content!!}
</div>
@endsection
