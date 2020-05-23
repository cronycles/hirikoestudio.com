@extends('layouts.page')
@section('page_content')

    <div class="page__section">
        @if($model->title != null && !empty($model->title))
            <div class="page__title">
                <h1>{{$model->title}}</h1>
            </div>
        @endif
        @if($model->description != null && !empty($model->description))
            <div class="page__description">
                <p>{{$model->description}}</p>
            </div>
        @endif
    </div>
    <div id="contact__main-container">
        <section class="page__section shop-images">
            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                 data-src="{{config('custom.images.static.shopWindow')}}"
                 alt="{!! config('custom.company.altAddress') !!}"
                 title="{!! config('custom.company.altAddress') !!}"
                 class="jlimg">
        </section>

        <section class="page__section">
            <div class="contact__logo">
                <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                     data-src="{{config('custom.images.static.logoBlack')}}"
                     alt="{{config('custom.company.name')}}"
                     title="{{config('custom.company.name')}}"
                     class="jlimg">
            </div>
            <article class="columns__container contact__form-info__section">
                <ul class="contact__info">
                    <li>
                        <a href="{{$model->infoData->telephone->url}}"
                           title="{{$model->infoData->telephone->name}}: {{$model->infoData->telephone->text}}"
                           class="jgtm-phone">
                            <i class="la la-phone" aria-hidden="true"></i>
                            <span class="contact-text">{{$model->infoData->telephone->text}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{$model->infoData->email->url}}"
                           title="{{$model->infoData->email->name}}: {{$model->infoData->email->text}}"
                           class="jgtm-email"
                           target="_blank">
                            <i class="la la-envelope" aria-hidden="true"></i>
                            <span class="contact-text">{{$model->infoData->email->text}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{$model->infoData->address->url}}"
                           title="{{$model->infoData->address->name}}: {!!$model->infoData->address->text!!}"
                           class="jgtm-addr"
                           target="_blank">
                            <i class="la la-map-marker" aria-hidden="true"></i>
                            <span class="contact-text">{!! $model->infoData->address->text  !!}</span>
                        </a>
                    </li>
                </ul>
                <div class="column">
                    @include('custom.form._form', ['model' => $model->formData])
                </div>
            </article>
        </section>

    </div>

@endsection

