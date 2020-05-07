@extends('layouts.show-all')

@section('page_main')
    @if($model->projects != null && !empty($model->projects))
        @if($model->categories != null && !empty($model->categories))
            <div class="page__section__box">
                <div class="product__categories">
                    @foreach($model->categories as $category)
                        <a href="#" class="jcl {{$category->isActive ? 'active' : ''}}"
                           data-c="{{$category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="page__section__box">
            <div class="auto-adjust-image-gallery image__gallery">
                @foreach($model->projects as $project)
                    <figure class="medium jcb" data-c="{{$project->category->id}}">
                        <a href="{{$project->url}}">
                            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="{{$project->cover ? $project->cover->url : ""}}" class="jlimg">
                        </a>
                        <a href="{{$project->url}}" class="overlay">
                            <div class="view__button">{{$project->viewText}}</div>
                        </a>
                        <figcaption>
                            <div class="caption__category">{{$project->category->name}}</div>
                            <div class="caption__text">{{$project->title}}</div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    @endif
@endsection
