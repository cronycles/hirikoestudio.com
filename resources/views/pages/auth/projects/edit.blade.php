@extends('layouts.auth')

@section('auth_content')
    @include('custom.form._form', ['model' => $model->formData])
@endsection
