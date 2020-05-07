import CategorySelectionView from './category.selection.view';

export default class CategorySelection {
    constructor() {
        this.SHOW_ALL_CATEGORIES_ID = 0;
        this.view = new CategorySelectionView();

        this.view.onSelectCategory((categoryId) => {
            if (this.doesShowAllCategories(categoryId)) {
                this.view.showAllBoxes();
            }
            else {
                this.view.showOnlyBoxesOfCategory(categoryId);
            }
        })
    }

    doesShowAllCategories(categoryId) {
        return categoryId === this.SHOW_ALL_CATEGORIES_ID;
    }

}
