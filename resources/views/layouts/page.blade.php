@extends('layouts.app')
@section('content')
    @include('layouts.partials._breadcrumbs', ['breadcrumbs' => $model->breadcrumbs])

    <div class="page">
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
        @yield('page_content')
    </div>
@endsection
