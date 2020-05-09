@extends('layouts.show')

@section('left_content')
    <div>{{$model->project->title}}</div>
    <div>{!! $model->project->description !!}</div>
@endsection

@section('right_content')
    @if($model->project->images != null && !empty($model->project->images))
        <div class="cro__vertical__gallery">
            @foreach($model->project->images as $image)
                <figure class="gallery__image__box">
                        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="{{$image->url}}"
                             class="jlimg"/>
                </figure>
            @endforeach
        </div>
    @endif
@endsection
