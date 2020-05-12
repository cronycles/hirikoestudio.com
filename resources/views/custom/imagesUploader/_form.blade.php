<div class="jimgHandling"
     data-url="{{$model->uploadApiUrl}}"
     data-max-number-of-files="{{$model->maxNumberOfFiles}}"
     data-max-uploaded-reached-err="{{trans('images-upload.max-uploaded-file-reached')}}"
     data-no-valid-image-err="{{trans('images-upload.no-valid-image')}}">

    <div class="img__upload_container">
        <div class="page__section img__upload_select_zone">
            <ul class="jerrorListCont page__section__box none">
                <li class="jClonable none"></li>
            </ul>

            <div class="page__section__box">
                <input type="file" class="jimgHandling__file-input-clonable" multiple accept="image/*"
                       style="display:none">
                <form class="juploadForm img__upload-select_form">
                    <a class="jselectFile cro__button cro__button--small" href="#">
                    <span class="cro__button__icon-and-text">
                         <i class="las la-upload"></i>
                        {{trans('images-upload.select-images-button')}}
                    </span>

                    </a>
                </form>
            </div>
            <div class="page__section__box">
                <div class="jdropzone img__upload-dropzone">
                    <div class="img__upload-dropzone-text">
                        {{trans('images-upload.drag-drop-images')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="page__section img__upload_thumbnail_zone">
            <div class="img__upload_thumb-text">
                {{trans('images-upload.thumbs-description')}}
            </div>
            <ul id="thumbContainer" class="jThumbsContainer jsortableContainer img__upload__thumbs__container"
                data-url="{{$model->updateSortApiUrl}}">
                @if($model->images != null && !empty($model->images))
                    @foreach ($model->images as $image)
                        <li class="jThumb jsortableElement img__upload__thumb-wrap" data-id="{{$image->id}}">

                            <img src="{{$image->url}}" class="jthumbImg">

                            <div class="img__upload__thumb__buttons-wrap">
                                <span class="img__upload__thumb-left__btn jSortHandle">
                                    <i class="las la-sort" title="{{trans('images-upload.sort-image-button')}}"></i>
                                </span>
                                <span
                                    class="jSmallView img__upload__thumb-center__btn {{$image->isSmallViewEnabled ? 'active' : ''}}">
                                    <i class="la la-compress-arrows-alt"
                                       title="{{trans('images-upload.small-image-button')}}"></i>
                                </span>
                                <span class="img__upload__thumb-right__btn">
                                    <i class="jDel las la-trash-alt"
                                       title="{{trans('images-upload.delete-image-button')}}"></i>
                                    <div class="jDelConfirm img__upload__confirm-btn none">
                                        {{trans('images-upload.delete-confirm-image-button')}}
                                    </div>
                                </span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>

            <li class="jThumb jsortableElement jClonable img__upload__thumb-wrap none" data-id="0">
                <img src="" class="jthumbImg">

                <div
                    class="jthumbPercentageBarContainer img__upload__thumb__buttons-wrap img__upload__progress-bar_container">
                    <div class="jPercentageBar img__upload_progress-bar"></div>
                    <div class="jPercentageNumber img__upload_percentage-number">0%</div>
                </div>
            </li>

            <div class="img__upload__thumb__buttons-wrap jThOk jClonable" style="display: none">
                <span class="img__upload__thumb-left__btn jSortHandle">
                    <i class="las la-sort" title="{{trans('images-upload.sort-image-button')}}"></i>
                </span>
                <span class="img__upload__thumb-center__btn jSmallView">
                    <i class="la la-compress-arrows-alt" title="{{trans('images-upload.small-image-button')}}"></i>
                </span>
                <span class="img__upload__thumb-right__btn">
                    <i class="jDel las la-trash-alt" title="{{trans('images-upload.delete-image-button')}}"></i>
                    <div class="jDelConfirm img__upload__confirm-btn none">
                        {{trans('images-upload.delete-confirm-image-button')}}
                    </div>
                </span>
            </div>

            <div class="img__upload__thumb__buttons-wrap jThKo jClonable" style="display: none">
                <span class="img__upload__thumb-left__btn upload-error">
                    {{trans('images-upload.upload-ko')}}
                </span>
                <span class="img__upload__thumb-right__btn">
                    <i class="jDel la la-trash" title="{{trans('images-upload.delete-image-button')}}"></i>
                    <div class="jDelConfirm img__upload__confirm-btn none">
                        {{trans('images-upload.delete-confirm-image-button')}}
                    </div>
                </span>
            </div>

        </div>
    </div>
</div>
