@extends('layouts.auth')

@section('auth_page_content')
    <article class="page__section">
        <div class="section__content">
            @include('custom.form._form', ['model' => $model->formData])
        </div>
    </article>
@endsection
