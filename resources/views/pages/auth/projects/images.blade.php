@extends('layouts.auth')

@section('auth_content')
    @include('custom.imagesUploader._imagesUploader', ['model' => $model->imageUploader])
@endsection
