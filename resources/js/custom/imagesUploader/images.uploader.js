import ImagesUploaderView from './images.uploader.view'
import ImagesService from './images.service'
import ImagesApi from './images.api'
import ImageUploaderError from './images.uploader.errors'

export default class ImagesUploader {
    constructor() {
        this.view = new ImagesUploaderView();

        this.config = this.view.getConfigurationFromHtml();

        this.api = new ImagesApi(this.config.uploadUrl);
        this.service = new ImagesService();

        this.imagesToBeUploaded = [];
        this.isUploading = false;

        this.view.onSelectFiles(async (files) => {
            this.view.resetAll();
            await this.#startUploadImages(files)
        });
        this.view.onDropFiles(async (files) => {
            this.view.resetAll();
            await this.#startUploadImages(files)
        });
        this.view.onDeleteFile(async (imageId) => {
            this.view.resetAll();
            this.view.showDeleteConfirmButton(imageId)
        });
        this.view.onDeleteFileConfirm(async (imageId) => {
            await this.#performDeleting(imageId)
        });
        this.view.onImageSmallViewButtonClick(async (imageId, isSmallViewActive) => {
            if(isSmallViewActive) {
                await this.#disableImageSmallView(imageId);
            }
            else {
                await this.#enableImageSmallView(imageId);
            }
        });
    }

    #performDeleting = async (imageId) => {
        this.view.hideThumbnail(imageId);
        this.view.resetAll();
        let response = await this.api.deleteImageById(imageId);
        if (!response.hasErrors) {
            this.view.deleteThumbnail(imageId);
        }
        else {
            this.view.showThumbnail(imageId);
        }
    };

    #startUploadImages = async (files) => {
        if(files && files.length) {
            for(const file of files) {
                await this.#startUploadImage(file);
            }
        }
    };

    #startUploadImage = async (file) => {
        if (this.#canUploadImage(file)) {
            this.imagesToBeUploaded.push(file);
            await this.#uploadImagesFromList();

        } else {
            this.#showImpossibleUploadErrors(file);
        }
    };

    #canUploadImage = (file) => {
        let errorList = this.#calculateImpossibleFileUploadErrorList(file);
        return errorList == null || errorList.length === 0;
    };

    #showImpossibleUploadErrors = (file) => {
        let errors = this.#calculateImpossibleFileUploadErrorList(file);
        this.#manageAndPrintErrors(errors);
    };

    #calculateImpossibleFileUploadErrorList(file) {
        let outcome = [];
        if (this.#isMaxUploadedFileReached()) {
            outcome.push(ImageUploaderError.MAX_UPLOAD_FILE_REACHED);
        }
        if (!this.service.isAnImageFileType(file)) {
            outcome.push(ImageUploaderError.NO_VALID_IMAGE);
        }
        return outcome;
    }

    #isMaxUploadedFileReached = () => {
        let outcome = true;
        if (this.config.maxNumberOfFiles > 0) {
            var uploadedImagesNumber = this.view.getNumberOfUploadedImages();
            outcome = uploadedImagesNumber >= this.config.maxNumberOfFiles;
        }

        return outcome;
    };

    #uploadImagesFromList = async () => {
        if (!this.isUploading && this.imagesToBeUploaded.length > 0) {
            this.isUploading = true;
            let file = this.imagesToBeUploaded.shift();
            await this.#uploadImage(file);
        }
    };

    #uploadImage = async (fileToBeUploaded) => {
        let $thumbnail = await this.#createAndShowThumbnailWithProgressBar(fileToBeUploaded);

        var uploadProgressFunction = (percentCompleted) => {
            this.view.updateThumbnailPercent($thumbnail, percentCompleted)
        };

        let response = await this.api.uploadImageToGivenUrl(this.config.uploadUrl, fileToBeUploaded, uploadProgressFunction);
        if (response && response.params && response.params.imageId) {
            this.view.updateThumbnailOk($thumbnail, response.params.imageId);
        } else {
            this.view.updateThumbnailError($thumbnail);
        }
        this.isUploading = false;
        this.#uploadImagesFromList();

    };

    #createAndShowThumbnailWithProgressBar  = async (file) => {
        let thumbnail = await this.service.createThumbnailFromFile(file);
        return this.view.appendThumbnail(thumbnail);
    };

    #manageAndPrintErrors = (errors) => {
        if (errors) {
            for (const error of errors) {
                this.view.printErrorToUser(error);
            }
        }
    };

    #enableImageSmallView = async (imageId) => {
        this.view.enableImageSmallView(imageId);
        let response = await this.api.changeImageSmallViewById(imageId, true);
        if (response.hasErrors) {
            this.view.disableImageSmallView(imageId);
        }
    };

    #disableImageSmallView = async (imageId) => {
        this.view.disableImageSmallView(imageId);
        let response = await this.api.changeImageSmallViewById(imageId, false);
        if (response.hasErrors) {
            this.view.enableImageSmallView(imageId);
        }
    };

}


