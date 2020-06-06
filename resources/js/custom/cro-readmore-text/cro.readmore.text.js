import CroReadMoreTextView from "./cro.readmore.text.view";
import ScreenHelper from "../screen/screen.helper";

export default class CroReadMoreText {
    constructor(customOptions = {}) {
        let defaultOptions = {
            heightLimit: 120,
            onlyMobile: false,
            controlButtons:
                "<span class=\"jmoreBtn cro__readmore__btn-overflow\"><i class=\"las la-plus-square\"></i></span>" +
                "<span class=\"jlessBtn cro__readmore__btn-overflow\"><i class=\"las la-minus-square\"></i></span>"
        };

        let options = {...defaultOptions, ...customOptions};

        this.view = new CroReadMoreTextView(options);
        this.screenHelper = new ScreenHelper();

        if (this.view.isHeightLimitReached()) {
            if(!options.onlyMobile) {
                this.view.enableReadMore();
            }
            else if(this.screenHelper.isMobileScreen()){
                this.view.enableReadMore();
            }
        }

        this.view.onReadMoreClick(this.view.showMoreText);
        this.view.onReadLessClick(this.view.hideMoreText);
    }
}
