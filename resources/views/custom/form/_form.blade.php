
<form id="{{ $model->id }}" method="POST" action="{{ $model->actionUrl }}" novalidate>
    @csrf

    @include('custom.form.messages.errors')

    @include('custom.form.fields._fields', ['fields' => $model->fields])

    @if($model->captcha != null)
        @include('custom.form.captcha.captcha', ['captcha' => $model->captcha])
    @endif

    <button class="cro__button cro__button--basic jformSend" data-txt="{{$model->buttonText}}">{{$model->buttonText}}</button>
</form>

