import CrudView from "./crud.view";
export default class Crud {
    #view;
    constructor() {
        this.#view = new CrudView();

        this.#view.onDeleteClick((itemId)=>{
            this.#view.showDeleteConfirmButton(itemId)
        })
    }
}
