@extends('layouts.page')
@section('page_content')

    <div class="columns__container right-large">
        <article class="page__section column">
            @yield('left_content')
        </article>
        <article class="page__section column">
            @yield('right_content')
        </article>
    </div>

@endsection
