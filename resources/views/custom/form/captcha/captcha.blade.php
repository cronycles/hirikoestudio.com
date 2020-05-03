<input type="hidden" class="jcaptcha" name="captcha" data-key="{{$captcha->key}}" data-form="{{$captcha->formId}}">

@section("scripts")
    @parent
    <script src="https://www.google.com/recaptcha/api.js?render={{$captcha->key}}"></script>
@endsection
