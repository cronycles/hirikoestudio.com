import ApiService from '../api/api.service';

export default class ImagesApi {

    constructor(uploadUrl) {
        this.uploadUrl = uploadUrl;
        this.api = new ApiService();
    }

    /**
     * upload a file on server with a given url
     * @returns {*}
     */
    uploadImageToGivenUrl = async (givenUrl, file, uploadProgressFunction) => {
        let body = new FormData();
        body.append('uploaded_file', file);
        return await this.api.ajaxPostFileFormData(givenUrl, body, uploadProgressFunction);
    };

    /**
     * delete a file by id
     * @param {int} imageId
     * @returns {*}
     */
    deleteImageById = async (imageId) => {
        const url = this.uploadUrl + "/" + imageId;
        return await this.api.ajaxDelete(url);
    };

    /**
     * enable or disable the image small view by id
     * @param {int} imageId
     * @param {bool} isActive
     * @returns {*}
     */
    changeImageSmallViewById = async (imageId, isActive = true) => {
        const url = this.uploadUrl + "/" + imageId+ "/small-view";
        const body = {
            'is-active': isActive
        };
        return await this.api.ajaxPost(url, body);
    };
}


