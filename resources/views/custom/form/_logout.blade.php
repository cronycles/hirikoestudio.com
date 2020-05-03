<form id="logout__form" class="logout__form" action="{{ $url }}" method="POST">
    @csrf
    @method('POST')
    <button class="jformSend cro__button cro__button--basic" data-txt="{{$text}}">
        <i class="la la-sign-out" title="{{ $text }}"></i>
        {{ $text }}
    </button>
</form>
