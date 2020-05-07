@extends('layouts.app')
@section('content')

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

    <article class="page__section">
        @yield('page_main')
    </article>

@endsection
