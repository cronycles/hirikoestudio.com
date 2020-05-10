@extends('layouts.page')
@section('page_content')
    <div class="columns__container right-large">
        <article class="page__section column">
            <div>{{$model->project->title}}</div>
            <div>{!! $model->project->description !!}</div>
        </article>
        <article class="page__section column">
            @if($model->project->images != null && !empty($model->project->images))
                <div class="cro__vertical__gallery">
                    @foreach($model->project->images as $image)
                        <div class="gallery__box {{$image->isSmallViewEnabled ? 'small' : ''}}">
                            <div class="image__track">
                                <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                                     data-src="{{$image->url}}"
                                     class="jlimg1000"/>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>
    </div>
@endsection
