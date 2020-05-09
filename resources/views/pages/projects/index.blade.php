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
            <div class="cro__auto-adjust__gallery overlay-zoom">
                @foreach($model->projects as $project)
                    <div class="gallery__box jcb" data-c="{{$project->category->id}}">
                        <a class="image__track" href="{{$project->url}}">
                            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="{{$project->cover ? $project->cover->url : ""}}" class="jlimg">
                        </a>
                        <a href="{{$project->url}}" class="overlay__track">
                            <div class="overlay__text">{{$project->title}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
