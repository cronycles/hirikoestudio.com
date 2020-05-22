@extends('layouts.page')

@section('page_content')
    <section class="page__section page__unknown">
        <div class='image'></div>
        <div class="content">
            <p><i class="las la-frown-open"></i></p>
            <h1>{{$model->title}} </h1>
            <h2>{{$model->description}}</h2>
        </div>
    </section>
@endsection
