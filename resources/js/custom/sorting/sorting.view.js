export default class SortingView {
    constructor() {
        //Texts
        this.tid = "id";
        this.turl = "url";

        //Selectors
        this.sortableContainerSelector = '.jsortableContainer';
        this.sortableElementSelector = '.jsortableElement';
        this.sortableHandleSelector = '.jSortHandle';

        //Wrappers
        this.$sortableContainer = $(this.sortableContainerSelector);
    }

    /**
     * @returns {HTMLBaseElement}
     */
    getSortableListContainer() {
        return this.$sortableContainer.get(0);
    }

    /**
     * @returns {string}
     */
    getSortableHandle() {
        return this.sortableHandleSelector;
    }

    getNewListOfSortedId() {
        let outcome = [];
        const sortableElements = this.$sortableContainer.find(this.sortableElementSelector);
        if(sortableElements && sortableElements.length > 0) {
            outcome = sortableElements.map((index, sortableElement) => $(sortableElement).data(this.tid)).get();
        }
        return outcome;
    }

    getUpdateUrl() {
        return this.$sortableContainer.data(this.turl)
    }



};
