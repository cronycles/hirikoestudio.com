import NotificationsView from "./notifications.view";

export default class Notifications {
    #view;
    constructor() {
        this.#view = new NotificationsView();

        this.#view.onSuccessCloseButtonClick(this.#view.closeSuccessMessage);
    }
};
