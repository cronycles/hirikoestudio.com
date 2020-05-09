@extends('layouts.show')

@section('left_content')
    <div>{{$model->project->title}}</div>
    <div>{!! $model->project->description !!}</div>
@endsection

@section('right_content')
    @if($model->project->images != null && !empty($model->project->images))
        <div class="cro__vertical__gallery">
            @foreach($model->project->images as $image)
                <div class="gallery__box">
                    <div class="image__track">
                        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="{{$image->url}}"
                             class="jlimg1000"/>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
