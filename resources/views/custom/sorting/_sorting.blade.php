@if($model->items != null && !empty($model->items))
<ul class="jsortableContainer sorting__container" data-url="{{$model->updateUrl}}">
    @foreach($model->items as $item)
        <li class="jsortableElement sorting__list_item" data-id="{{$item->id}}">
            <i class="jSortHandle la la-sort" title="{{trans('images-upload.sort-image-button')}}"></i>
            <span class="sorting__text">{{$item->title}}</span>
        </li>
    @endforeach
</ul>
@endif
