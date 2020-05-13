<form class="delete__form" action="{{ $item->deleteUrl }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="jdel" data-id="{{$item->id}}">
        <i class="las la-trash-alt" title="{{ $item->deleteText }}"></i>
    </div>
    <button class="jdelConfirm img__upload__confirm-btn none">
        {{trans('images-upload.delete-confirm-image-button')}}
    </button>
</form>
