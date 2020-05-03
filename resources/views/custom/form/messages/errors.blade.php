@if ($errors->any() && !session()->has('successMessage'))
    <ul class="form__error_messages">
        @foreach ($errors->all() as $error)
            <li>{!! $error !!} </li>
        @endforeach
    </ul>
@endif
<ul class="jsFormErr form__error_messages none">{{__('validation.generic_error')}}</ul>
