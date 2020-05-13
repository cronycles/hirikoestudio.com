export default class CrudView {
    #itemsContainerSelector;
    #itemSelector;
    #deleteSelector;
    #deleteConfirmSelector;
    constructor() {
        //Classes
        this.noneClass = "none";

        //Selectors
        this.#itemsContainerSelector = ".jitemsContainer";
        this.#itemSelector = ".jitem";
        this.#deleteSelector = ".jdel";
        this.#deleteConfirmSelector = ".jdelConfirm";

        this.$itemsContainer = $(this.#itemsContainerSelector);
    }

    /**
     * @param {function} callback
     */
    onDeleteClick = (callback) => {
        this.$itemsContainer.on('click', this.#deleteSelector, (element) => {
            const $deleteButton = $(element.currentTarget);
            let itemId = $deleteButton.data("id");
            callback(itemId);
            return false;
        });
    };

    /**
     * @param {int} itemId
     */
    showDeleteConfirmButton = (itemId) => {
        const $item = this.#findItemByItemId(itemId);
        $item.find(this.#deleteSelector).addClass(this.noneClass);
        $item.find(this.#deleteConfirmSelector).removeClass(this.noneClass);
    };

    #findItemByItemId = (itemId) => {
        return this.$itemsContainer.find(this.#itemSelector + '[data-id="' + itemId + '"]');
    };
}
