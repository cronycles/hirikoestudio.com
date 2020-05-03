<form class="delete__form" action="{{ $url }}" method="POST">
    @csrf
    @method('DELETE')
    <button><i class="la la-trash" title="{{ $text }}"></i></button>
</form>
