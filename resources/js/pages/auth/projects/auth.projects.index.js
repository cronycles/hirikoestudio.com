import Page from '../../page';
import Crud from "../../../custom/crud/crud";

export default class PageAuthProjectsIndex extends Page {
    constructor() {
        super();
        new Crud();
    }
};
