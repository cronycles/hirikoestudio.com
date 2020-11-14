@extends('layouts.app')

@section('content')
    <section class="gallery__box cro-fs-images-carousel jslider">
        @if(isset($model->slidesSection->slides) && !empty($model->slidesSection->slides))
            @foreach($model->slidesSection->slides as $slide)
                <figure class="none">
                    <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                         class="tns-lazy-img"
                         data-src="{{$slide->imageUrl}}"
                         @if($slide->isMobileSlide)
                         data-m="1"
                         @endif
                         alt="{{$slide->imageAltText}}">
                </figure>
            @endforeach
        @endif
    </section>
    <section id="home__below__container">
        <div class="page__section presentation-section">
            <h1>{{$model->presentationSection->title}}</h1>
            <h3>{!!$model->presentationSection->subtitle!!}</h3>
            <p></p>
            <div class="presentation-text">{!! $model->presentationSection->text !!}</div>
        </div>
        @if(isset($model->projectsSection->projects) && !empty($model->projectsSection->projects))
            <article class="page__section">
                <h2>{{$model->projectsSection->title}}</h2>
                @include('pages.projects._projects-gallery', ['model' => $model->projectsSection])
                <a href="{{$model->projectsSection->seeMoreUrl}}"
                   class="cro__button cro__button--basic center">{{$model->projectsSection->seeMoreText}}</a>
            </article>
        @endif
    </section>
@endsection


