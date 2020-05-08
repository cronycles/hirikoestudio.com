@extends('layouts.auth')

@section('auth_content')
    @include('custom.crud.index', ['model' => $model])
@endsection
