@extends('layouts.show')

@section('left_content')
    <div>{{$model->project->title}}</div>
    <div>{!! $model->project->description !!}</div>
@endsection

@section('right_content')
    @if($model->project->images != null && !empty($model->project->images))
        @foreach($model->project->images as $image)
            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="{{$image->url}}" class="jlimg"/>
        @endforeach
    @endif
@endsection
