import SortingView from './sorting.view';
import Sortable from 'sortablejs';

export default class Sorting {
    #view;
    #options;
    constructor(options) {
        this.#options = options;
        this.#view = new SortingView();
        this.#setupSortableList();
    }

    #setupSortableList = () => {
        const $sortableListContainer = this.#view.getSortableListContainer();
        new Sortable($sortableListContainer, {
            handle: this.#view.getSortableHandle(),
            animation: 150,
            ghostClass: 'blue-background-class',
            onUpdate: () => this.#calculateNewIdOrder()
        });
    };

    #calculateNewIdOrder() {
        const orderedIdList = this.#view.getNewListOfSortedId();
        const updateUrl = this.#view.getUpdateUrl();

        this.#options.onUpdate(updateUrl, orderedIdList);
    }

}
