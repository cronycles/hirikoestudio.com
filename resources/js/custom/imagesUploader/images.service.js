export default class ImagesService {

    constructor() {
    }

    /**
     * @param file: a File() object
     * @returns {boolean}
     */
    isAnImageFileType(file) {
        var outcome = false;
        if (file) {
            var imageType = /^image\//;
            outcome = imageType.test(file.type);
        }
        return outcome;
    }

    createThumbnailFromFile = async (file) => {
        return await this.#loadImageFromFile(file);
    };

    /**
     * @param file: a File() object
     */
    #loadImageFromFile = async (file) => {
        return new Promise(resolve => {
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imageObject = new Image();
                    imageObject.src = e.target.result;
                    imageObject.onload = function () {
                        resolve(this);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    };
}


