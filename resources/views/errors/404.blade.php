@extends('layouts.page')

@section('page_content')
    <section class="page__section page__unknown">
        <p><i class="las la-frown-open"></i></p>
        <h1>{{$model->title}} </h1>
        <h2>{{$model->description}}</h2>
    </section>
@endsection
