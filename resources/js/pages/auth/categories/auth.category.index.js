import Page from '../../page';
import Crud from "../../../custom/crud/crud";

export default class PageAuthCategoryIndex extends Page {
    constructor() {
        super();
        new Crud();
    }
};
