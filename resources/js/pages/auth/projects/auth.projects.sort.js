import Page from '../../page';
import Sorting from '../../../custom/sorting/sorting'
import ApiService from "../../../custom/api/api.service";

export default class PageAuthProjectsSort extends Page {
    #api;
    constructor() {
        super();
        this.api = new ApiService();
        new Sorting({
            onUpdate: (updateUrl, orderedIds) => this.#onUpdate(updateUrl, orderedIds)

        });
    }

    #onUpdate(updateUrl, orderedIds) {
        console.log(orderedIds);
        this.api.ajaxPost(updateUrl, orderedIds)
    }
};
