@extends('layouts.auth')

@section('auth_content')
    <article class="page__section auth__home__main-section">
        @if($model->links != null && !empty($model->links))
            <ul>
                @foreach($model->links as $link)
                    <li>
                        <a href="{{ $link->url }}">{{$link->text}}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </article>
    <article class="page__section">
        @include('custom.form._logout', array('url' => $model->logoutUrl,'text' => $model->logoutText))
    </article>

@endsection
