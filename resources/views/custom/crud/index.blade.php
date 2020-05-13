<div class="crud__container">
    <div class="page__section general__buttons">
        @if($model->createLink != null)
            <div>
                <a class="cro__button cro__button--small" href="{{ $model->createLink->url }}">
                    {{ $model->createLink->text }}
                </a>
            </div>
        @endif
        @if($model->createLink != null)
            <div>
                <a class="cro__button cro__button--small" href="{{ $model->sortLink->url }}">
                    {{ $model->sortLink->text }}
                </a>
            </div>
        @endif
    </div>
    @if($model->crudTable->items != null && !empty($model->crudTable->items))
        <div class="page__section">
            <table class="jitemsContainer items__table">
                <thead>
                <tr>
                    <th class="row-main">
                        {{$model->crudTable->nameTitle}}
                    </th>
                    @if($model->crudTable->isEditingEnabled)
                        <th class="row-manage">
                            <i class="las la-edit" title="{{$model->crudTable->editTitle}}"></i>
                        </th>
                    @endif
                    @if($model->crudTable->isImagesEditingEnabled)
                        <th class="row-manage">
                            <i class="las la-image" title="{{$model->crudTable->imagesTitle}}"></i>
                        </th>
                    @endif
                    @if($model->crudTable->isDeletingEnabled)
                        <th class="row-manage">
                            <i class="las la-trash-alt" title="{{$model->crudTable->deleteTitle}}"></i>
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($model->crudTable->items as $crudItem)
                    <tr class="jitem" data-id="{{$crudItem->id}}">
                        <td>{{$crudItem->name}}</td>
                        @if($model->crudTable->isEditingEnabled)
                            <td class="table__td-centered">
                                <a href="{{ $crudItem->editUrl }}">
                                    <i class="las la-edit" title="{{$crudItem->editText}}"></i>
                                </a>
                            </td>
                        @endif
                        @if($model->crudTable->isImagesEditingEnabled)
                            <td class="table__td-centered">
                                <a href="{{ $crudItem->imagesUrl }}">
                                    <i class="las la-image" title="{{$crudItem->imagesText}}"></i>
                                </a>
                            </td>
                        @endif
                        @if($model->crudTable->isDeletingEnabled)
                            <td class="table__td-centered">
                                @include('custom.crud._delete', array('item' => $crudItem))
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
</div>
