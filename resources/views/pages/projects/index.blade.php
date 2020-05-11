@extends('layouts.page')

@section('page_content')

    <div class="page__section">
        @if($model->title != null && !empty($model->title))
            <div class="page__title">
                <h1>{{$model->title}}</h1>
            </div>
        @endif
        @if($model->description != null && !empty($model->description))
            <div class="page__description">
                {{$model->description}}
            </div>
        @endif
    </div>

    <div class="page__section">
        @if($model->projects != null && !empty($model->projects))
            @if($model->categories != null && !empty($model->categories))
                <ul class="page__section__box product__categories">
                    @foreach($model->categories as $category)
                        <li class="jcl product__category {{$category->isActive ? 'active' : ''}}"
                           data-c="{{$category->id}}">{{$category->name}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="page__section__box">
                <div class="cro__auto-adjust__gallery overlay-zoom">
                    @foreach($model->projects as $project)
                        <div class="gallery__box jcb" data-c="{{$project->category->id}}">
                            <a class="image__track" href="{{$project->url}}">
                                <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                                     data-src="{{$project->cover ? $project->cover->url : ""}}" class="jlimg">
                            </a>
                            <a href="{{$project->url}}" class="overlay__track">
                                <div class="overlay__text">{{$project->title}}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
