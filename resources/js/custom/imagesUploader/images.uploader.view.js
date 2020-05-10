import ImageUploaderError from './images.uploader.errors'

export default class ImagesUploaderView {
    #deleteSelector;
    #deleteConfirmSelector;
    #smallViewSelector;
    constructor() {

        //Selector
        this.#deleteSelector = ".jDel";
        this.#deleteConfirmSelector = ".jDelConfirm";
        this.#smallViewSelector = ".jSmallView";

        this.imageUploaderSelector = ".jimgHandling";

        this.cloneableSelector = "jClonable";
        this.thumbSelector = "jThumb";
        this.thumbOkSelector = "jThOk";
        this.thumbKoSelector = "jThKo";

        //classes
        this.noneClass = "none";
        this.activeClass = "active";

        //DOM
        this.$imageHandling = $(this.imageUploaderSelector);
        this.$imageHandlingClonableInputFile = $(".jimgHandling__file-input-clonable");
        this.$imageHandlingForm = $(".juploadForm");
        this.$fileSelect = this.$imageHandling.find(".jselectFile");
        this.$fileElem = this.$imageHandling.find("#fileElem");
        this.$dropZone = this.$imageHandling.find(".jdropzone");
        this.$thumbsContainer = this.$imageHandling.find(".jThumbsContainer");
        this.$thumbTheme = this.$imageHandling.find("." + this.thumbSelector + "." + this.cloneableSelector);
        this.$thumbItemSuccessTheme = this.$imageHandling.find("." + this.thumbOkSelector + "." + this.cloneableSelector);
        this.$thumbItemErrorTheme = this.$imageHandling.find("." + this.thumbKoSelector + "." + this.cloneableSelector);
        this.$errorAlertContainer = this.$imageHandling.find(".jerrorListCont");
        this.$clonableError = this.$errorAlertContainer.find("." + this.cloneableSelector);
        this.$errorAlerts = this.$errorAlertContainer.find(".jError");
    }


    getConfigurationFromHtml = () => {
        return {
            uploadUrl: this.$imageHandling.data('url'),
            maxNumberOfFiles: this.$imageHandling.data('max-number-of-files'),
        };
    };

    onSelectFiles = (callback) => {
        this.$fileSelect.off().on('click', (e) => {
            this.#createClassicHiddenInputFileAndCallIt(callback);
            return false;
        });

    };

    onDropFiles = (callback) => {
        this.$dropZone.off("dragenter dragover").on("dragenter dragover", () => {
            this.$dropZone.addClass("dragging");
            return false;
        });
        this.$dropZone.off("dragleave").on("dragleave", () => {
            this.$dropZone.removeClass("dragging");
            return false;
        });

        this.$dropZone.off("drop").on("drop", (e) => {
            //noinspection JSUnresolvedVariable
            callback(e.originalEvent.dataTransfer.files);
            this.$dropZone.removeClass("dragging");
            return false;
        });
    };

    resetAll = () => {
        this.#resetAllButtons();
        this.#hideErrors();
    };

    appendThumbnail = (thumbnail) => {
        let $clonedThumbTheme = this.$thumbTheme.clone();
        $clonedThumbTheme.removeClass(this.cloneableSelector);

        let imageContainer = $clonedThumbTheme.find(".jthumbImg");
        imageContainer.attr('src', thumbnail.src);

        this.$thumbsContainer.append($clonedThumbTheme);
        $clonedThumbTheme.removeClass(this.noneClass);

        return $clonedThumbTheme;
    };

    updateThumbnailPercent = ($thumbnail, percentCompleted) => {
        $thumbnail.find('.jPercentageBar').width(percentCompleted + '%');
        $thumbnail.find('.jPercentageNumber').html(percentCompleted + '%');
    };

    updateThumbnailOk = ($thumbnail, imageId) => {
        $thumbnail.attr('data-id', imageId);

        let $clonedSuccessItem = this.$thumbItemSuccessTheme.clone();
        $clonedSuccessItem.removeClass(this.cloneableSelector);
        $thumbnail.find(".jthumbPercentageBarContainer").replaceWith($clonedSuccessItem);

        $clonedSuccessItem.show();
    };

    updateThumbnailError = ($thumbnail) => {
        let $clonedErrorItem = this.$thumbItemErrorTheme.clone();
        $clonedErrorItem.removeClass(this.cloneableSelector);
        $thumbnail.find(".jthumbPercentageBarContainer").replaceWith($clonedErrorItem);
        $clonedErrorItem.show();
    };

    /**
     * @param {function} callback
     */
    onDeleteFile = (callback) => {
        this.$thumbsContainer.on('click', this.#deleteSelector, (deleteButton) => {
            let id = $(deleteButton.currentTarget).closest("." + this.thumbSelector).data("id");
            callback(id);
            return false;
        });
    };

    /**
     * @param {int} imageId
     */
    showDeleteConfirmButton = (imageId) => {
        const $thumbnail = this.#findThumbnailByImageId(imageId);
        $thumbnail.find(this.#deleteSelector).addClass(this.noneClass);
        $thumbnail.find(this.#deleteConfirmSelector).removeClass(this.noneClass);
    };

    /**
     * @param {function} callback
     */
    onDeleteFileConfirm = (callback) => {
        this.$thumbsContainer.on('click', this.#deleteConfirmSelector, (deleteButton) => {
            let id = $(deleteButton.currentTarget).closest("." + this.thumbSelector).data("id");
            callback(id);
            return false;
        });
    };

    /**
     * @param {function} callback
     */
    onImageSmallViewButtonClick = (callback) => {
        this.$thumbsContainer.on('click', this.#smallViewSelector, (button) => {
            const $button = $(button.currentTarget);
            let id = $button.closest("." + this.thumbSelector).data("id");
            let isSmallViewActive = $button.hasClass('active');
            callback(id, isSmallViewActive);
            return false;
        });
    };

    /**
     * @param {int} imageId
     */
    enableImageSmallView = (imageId) => {
        const $thumbnail = this.#findThumbnailByImageId(imageId);
        $thumbnail.find(this.#smallViewSelector).addClass(this.activeClass);
    };

    /**
     * @param {int} imageId
     */
    disableImageSmallView = (imageId) => {
        const $thumbnail = this.#findThumbnailByImageId(imageId);
        $thumbnail.find(this.#smallViewSelector).removeClass(this.activeClass);
    };

    hideThumbnail = (id) => {
        let $thumbnail = this.#findThumbnailByImageId(id);
        $thumbnail.addClass(this.noneClass);
    };

    showThumbnail = (id) => {
        let $thumbnail = this.#findThumbnailByImageId(id);
        $thumbnail.addClass(this.noneClass);
    };

    deleteThumbnail = (id) => {
        let $thumbnail = this.#findThumbnailByImageId(id);
        $thumbnail.remove();
    };

    getNumberOfUploadedImages = () => {
        return this.$thumbsContainer.find("li").length;
    };

    /**
     * @param error {ImageUploaderError}
     */
    printErrorToUser = (error) => {
        let errorString = "";
        switch (error) {
            case ImageUploaderError.MAX_UPLOAD_FILE_REACHED :
                errorString = this.$imageHandling.data('max-uploaded-reached-err');
                break;
            case ImageUploaderError.NO_VALID_IMAGE :
                errorString = this.$imageHandling.data('no-valid-image-err');
                break;
        }
        let $clone = this.$clonableError.clone();
        $clone.removeClass(this.cloneableSelector).addClass("jError");
        $clone.html(errorString);
        this.$errorAlertContainer.append($clone);
        this.$errorAlerts = this.$errorAlertContainer.find(".jError");
        $clone.removeClass("none");
        this.$errorAlertContainer.removeClass("none");
    };

    /**
     * we need to create always the input to fix the problem of uploading the same image
     * @param callback
     */
    #createClassicHiddenInputFileAndCallIt = (callback) => {
        if (this.$fileElem) {
            this.$fileElem.remove();
        }
        let $clone = this.$imageHandlingClonableInputFile.clone();
        $clone.off().on("change", (input) => {
            callback(Array.from(input.currentTarget.files));
            return false;
        });
        $clone.appendTo(this.$imageHandlingForm);
        this.$fileElem = $clone;

        this.$fileElem.click();
    };

    #hideErrors = () => {
        this.$errorAlerts.remove();
        this.$errorAlertContainer.addClass("none");
    };

    #resetAllButtons = () => {
        const $deleteButtons = this.#getAllDeleteButtons();
        const $confirmButtons = this.#getAllConfirmButtons();
        $confirmButtons.addClass(this.noneClass);
        $deleteButtons.removeClass(this.noneClass);

    };

    /**
     * @param {int} id
     * @returns {jQuery}
     */
    #findThumbnailByImageId(id) {
        return this.$thumbsContainer.find('.' + this.thumbSelector + '[data-id="' + id + '"]');
    }

    /**
     * @returns {jQuery}
     */
    #getAllConfirmButtons = () => {
        return this.$thumbsContainer.find(this.#deleteConfirmSelector);
    };

    /**
     * @returns {jQuery}
     */
    #getAllDeleteButtons = () => {
        return this.$thumbsContainer.find(this.#deleteSelector);
    };
}


