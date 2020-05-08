@extends('layouts.auth')

@section('auth_content')
    @include('custom.imagesUploader._form', ['model' => $model->imageUploader])
@endsection
