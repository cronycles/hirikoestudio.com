@extends('layouts.app')

@section('content')
    <a href="{{route('projects')}}">
        <div id="home-container">
            <section class="gallery__box cro-fs-images-carousel">
                @if(!empty($model->slides))
                    @foreach($model->slides as $slide)
                        <figure>
                            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                                 class="tns-lazy-img"
                                 @if($slide->imageMobileUrl == null || empty($slide->imageMobileUrl))
                                 data-src="{{$slide->imageDesktopUrl}}"
                                 @else
                                 data-d="{{$slide->imageDesktopUrl}}"
                                 data-m="{{$slide->imageMobileUrl}}"
                                 @endif
                                 alt="{{$slide->imageAltText}}">
                        </figure>
                    @endforeach
                @endif
            </section>
        </div>
    </a>
@endsection


