@extends('layouts.auth')

@section('auth_content')
    @include('custom.form._logout', array('url' => $model->logoutUrl,'text' => $model->logoutText))
@endsection
