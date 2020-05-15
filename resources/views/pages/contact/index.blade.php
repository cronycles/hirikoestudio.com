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
                {{$model->description}}
            </div>
        @endif
    </div>
    <div id="contact__main-container">
        <article class="page__section shop-images">
            <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                 data-src="{{config('custom.images.static.shopWindow')}}"
                 alt="{!! config('custom.company.altAddress') !!}"
                 class="jlimg">
        </article>

        <article class="page__section">
            <div class="contact__logo">
                <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                     data-src="{{config('custom.images.static.logoBlack')}}"
                     alt="{{config('custom.company.name')}}"
                     class="jlimg">
            </div>
            <div class="columns__container contact__form-info__section">
                <ul class="contact__info">
                    <li>
                        <a href="tel:{{$model->infoData->telephone}}" class="jgtm-phone">
                            <i class="la la-phone" aria-hidden="true"></i>
                            <span class="contact-text">{{$model->infoData->telephoneText}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{$model->infoData->email}}" class="jgtm-email" target="_blank" >
                            <i class="la la-envelope" aria-hidden="true"></i>
                            <span class="contact-text">{{$model->infoData->email}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{$model->infoData->addressMapUrl}}" class="jgtm-addr" target="_blank" >
                            <i class="la la-map-marker" aria-hidden="true"></i>
                            <span class="contact-text">{!! $model->infoData->address  !!}</span>
                        </a>
                    </li>
                </ul>
                <div class="column">
                    @include('custom.form._form', ['model' => $model->formData])
                </div>
            </div>
        </article>

    </div>


@endsection

