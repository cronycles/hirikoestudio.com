@extends('layouts.page')
@section('page_content')
    <div id="page__project-show">
        <section class="page__section show__section">
            <h1>{{$model->project->title}}</h1>
            <p>{!! $model->project->description !!}</p>
        </section>
        <section class="page__section show__section">
            @if($model->project->images != null && !empty($model->project->images))
                <div class="cro__vertical__gallery">
                    @foreach($model->project->images as $image)
                        <div class="gallery__box {{$image->isSmallViewEnabled ? 'small' : ''}}">
                            <div class="image__track">
                                <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                                     data-src="{{$image->url}}"
                                     alt="{{$model->project->title}}"
                                     title="{{$model->project->title}}"
                                     class="jlimg1000"/>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
        <div class="page__section show__section">
            <hr />
        </div>
        <div class="page__section show__section">
            <h2>{{$model->moreProjectsTitle}}</h2>
            <p>{{$model->moreProjectsDescription}}</p>
        </div>
        <section class="page__section show__section">
            @include('pages.projects._projects-gallery')
        </section>
    </div>
@endsection
