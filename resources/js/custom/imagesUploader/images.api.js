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
        var body = new FormData();
        body.append('uploaded_file', file);
        return await this.api.ajaxPostFileFormData(givenUrl, body, uploadProgressFunction);
    };

    /**
     * delete a file by id
     * @param imageId
     * @returns {*}
     */
    deleteImageById = async (imageId) => {
        var url = this.uploadUrl + "/" + imageId;
        return await this.api.ajaxDelete(url);
    };
}


