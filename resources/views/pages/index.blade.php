@extends('layouts.app')

@section('content')
    <a href="{{route('projects')}}">
        <div id="home-container">
            <div class="gallery__box cro-fs-images-carousel">
                <figure>
                    <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                         class="tns-lazy-img"
                         data-src="{{config('custom.images.static.homeSlide1')}}"
                         alt="{{config('custom.company.name')}}">
                </figure>
                <figure>
                    <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                         class="tns-lazy-img"
                         data-src="{{config('custom.images.static.homeSlide2')}}"
                         alt="{{config('custom.company.name')}}">
                </figure>
                <figure>
                    <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                         class="tns-lazy-img"
                         data-src="{{config('custom.images.static.homeSlide3')}}"
                         alt="{{config('custom.company.name')}}">
                </figure>
            </div>
        </div>
    </a>
@endsection


