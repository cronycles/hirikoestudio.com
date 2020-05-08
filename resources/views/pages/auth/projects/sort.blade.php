@extends('layouts.auth')

@section('auth_content')
    @include('custom.sorting._sorting', ['model' => $model->sorting])
@endsection
