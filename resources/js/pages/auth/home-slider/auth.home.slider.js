import Page from '../../page';
import ImagesUploader from '../../../custom/imagesUploader/images.uploader'
import Sorting from "../../../custom/sorting/sorting";
import ApiService from "../../../custom/api/api.service";

export default class PageAuthHomeSlider extends Page {
    #api;
    constructor() {
        super();
        this.#api = new ApiService();
        new ImagesUploader();

        new Sorting({
            onUpdate: (updateImagesSortUrl, imagesOrderedIds) => this.#onUpdate(updateImagesSortUrl, imagesOrderedIds)
        });
    }

    #onUpdate = (updateImagesSortUrl, imagesOrderedIds) => {
        const data = {
          'images-ids' : imagesOrderedIds
        };
        this.#api.ajaxPost(updateImagesSortUrl, data);
    };
};
