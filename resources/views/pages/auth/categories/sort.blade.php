@extends('layouts.auth')

@section('auth_page_content')
    <article class="page__section">
        <div class="section__content admin-section__container">
            @include('custom.sorting._sorting', ['model' => $model->sorting])
        </div>
    </article>
@endsection
