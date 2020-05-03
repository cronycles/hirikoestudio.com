export default class NotificationsView {
    constructor() {

        //Texts
        this.tclick = "click";

        //Selectors
        this.successButtonSelector = ".jsuccessClose";
        this.successMessageContainerSelector = ".jsuccessMessageContainer";

        //DOM
        this.$successButton = $(this.successButtonSelector);
        this.$successMessageContainer = $(this.successMessageContainerSelector);
    }

    onSuccessCloseButtonClick = (callback) => {
        this.$successButton.off(this.tclick).on(this.tclick, (element) => {
            callback();
            return false;
        });
    };

    closeSuccessMessage = () => {
        this.$successMessageContainer.hide();
    };
};
