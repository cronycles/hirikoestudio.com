@extends('layouts.auth')

@section('auth_page_content')
    <article class="page__section">
        @include('custom.crud.index', ['model' => $model])
    </article>
@endsection
