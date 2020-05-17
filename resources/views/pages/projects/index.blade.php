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
        @include('pages.projects._projects-gallery')
    </div>
@endsection
