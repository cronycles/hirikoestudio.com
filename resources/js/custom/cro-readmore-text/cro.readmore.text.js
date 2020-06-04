import CroReadMoreTextView from "./cro.readmore.text.view";

export default class CroReadMoreText {
    constructor(customOptions = {}) {
        let defaultOptions = {
            heightLimit: 120,
            controlButtons: "<span class=\"jmoreBtn cro__readmore__btn-overflow\"><i class=\"las la-plus-square\"></i></span>" +
                "<span class=\"jlessBtn cro__readmore__btn-overflow\"><i class=\"las la-minus-square\"></i></span>"
        };

        let options = {...defaultOptions, ...customOptions};

        this.view = new CroReadMoreTextView(options);

        if (this.view.isHeightLimitReached()) {
            this.view.showControlButtons();
        }

        this.view.onReadMoreClick(this.view.showMoreText);
        this.view.onReadLessClick(this.view.hideMoreText);
    }
}
