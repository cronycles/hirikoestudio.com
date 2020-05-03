@if(session()->has('successMessage'))
    <div class="jsuccessMessageContainer form__success_messages animated">
        {!! session()->get('successMessage') !!}
        <a class="jsuccessClose close"><i class="la la-times"></i></a>
    </div>
@endif

@if (session('status'))
    <div class="jsuccessMessageContainer form__success_messages animated">
        {{ session('status') }}
        <a class="jsuccessClose close"><i class="la la-times"></i></a>
    </div>
@endif
