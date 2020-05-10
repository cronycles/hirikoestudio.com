@extends('layouts.app')

@section('content')
    <div id="home-container">
        <div class="gallery__box cro-fs-images-carousel">
            <figure><img class="tns-lazy-img" data-src="{{config('custom.images.static.homeSlide1')}}"></figure>
            <figure><img class="tns-lazy-img" data-src="{{config('custom.images.static.homeSlide2')}}"></figure>
            <figure><img class="tns-lazy-img" data-src="{{config('custom.images.static.homeSlide3')}}"></figure>
        </div>
    </div>
@endsection


