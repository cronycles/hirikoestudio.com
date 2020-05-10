export default class CategorySelectionView {
    constructor() {
        //Texts
        this.tclick = "click";

        //classes
        this.activeClass = "active";

        //Selectors
        this.dataCategoryIdSelector = 'c';
        this.categorySelector = ".jcl";
        this.categoryBoxSelector = ".jcb";

        //Wrappers
        this.$categories = $(this.categorySelector);
        this.$categoryBoxes = $(this.categoryBoxSelector);

    }

    //#region Public functions
    onSelectCategory(callback) {
        this.$categories.off(this.tclick).on(this.tclick, (category) => {
            let $clickedCategory = $(category.currentTarget);
            this.selectCategoryFromWrapper($clickedCategory);
            let categoryId = this.getCategoryIdFromWrapper($clickedCategory);
            callback(categoryId);
            return false;
        })
    }

    showAllBoxes() {
        this.$categoryBoxes.show();
    }

    showOnlyBoxesOfCategory(categoryId) {
        let $filteredBoxes = this.$categoryBoxes.filter((index, element) => {
            const $categoryBox = $(element);
            const categoryBoxId = this.getCategoryIdFromWrapper($categoryBox);
            return categoryBoxId === categoryId;
        });
        this.$categoryBoxes.hide();
        $filteredBoxes.show();
    }

    //#endregion Public functions

    //#region Private functions
    selectCategoryFromWrapper($categoryWrapper) {
        this.$categories.removeClass(this.activeClass);
        $categoryWrapper.addClass(this.activeClass);
    }

    getCategoryIdFromWrapper($categoryWrapper) {
        return $categoryWrapper.data(this.dataCategoryIdSelector);
    }
    //#endregion Private functions



};
