@extends('layouts.contact')

@section('left_content')
    <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
         data-src="{{config('custom.images.static.shopWindow')}}" class="jlimg">
@endsection

@section('right_content')
    <div class="contact__logo">
        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
             data-src="{{config('custom.images.static.logoBlack')}}" class="jlimg">
    </div>
    <div class="columns__container">
        <ul class="column contact__info">
            <li>
                <a href="tel:{{$model->infoData->telephone}}" class="">
                    <i class="la la-phone" aria-hidden="true"></i>
                    <span class="contact-text">{{$model->infoData->telephoneText}}</span>
                </a>
            </li>
            <li>
                <a href="mailto:{{$model->infoData->email}}" class="">
                    <i class="la la-envelope" aria-hidden="true"></i>
                    <span class="contact-text">{{$model->infoData->email}}</span>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" class="">
                    <i class="la la-map-marker" aria-hidden="true"></i>
                    <span class="contact-text">{{$model->infoData->address}}</span>
                </a>
            </li>
        </ul>
        <div class="column">
            @include('custom.form._form', ['model' => $model->formData])

        </div>
    </div>
@endsection
