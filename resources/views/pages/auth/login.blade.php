@extends('layouts.auth')

@section('auth_content')
    @include('custom.form._form', ['model' => $model->formData])

    @if (Route::has('password.request'))
        <a class="" href="{{ $model->forgotPasswordUrl }}">
            {{ $model->forgotPasswordText }}
        </a>
    @endif
@endsection

