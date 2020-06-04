import CroReadMoreText from "../custom/cro-readmore-text/cro.readmore.text";

export default class PageProjectShow {
    constructor() {
        let options = {
            heightLimit: 120
        };
        new CroReadMoreText(options);
    }
};
