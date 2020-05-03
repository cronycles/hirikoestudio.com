@extends('layouts.page')

@section('page_content')
    <div>
        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}" data-src="https://via.placeholder.com/400x300.png" class="jlimg">
    </div>

    <div class="links">
        <a href="https://laravel.com/docs">Docs</a>
        <a href="https://laracasts.com">Laracasts</a>
        <a href="https://laravel-news.com">News</a>
        <a href="https://blog.laravel.com">Blog</a>
        <a href="https://nova.laravel.com">Nova</a>
        <a href="https://forge.laravel.com">Forge</a>
        <a href="https://vapor.laravel.com">Vapor</a>
        <a href="https://github.com/laravel/laravel">GitHub</a>
    </div>
@endsection


