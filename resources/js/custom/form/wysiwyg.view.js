export default class WysiwygView {
    constructor() {

        //Texts
        this.tfocusOut = "focusout";

        //Selectors
        this.wysiwygSelector = ".jwysiwyg";
        this.hiddenInputSelector = ".jwysiwygInput";
        this.qlEditorSelector = ".ql-editor";

        //DOM
        this.$wysiwig = $(this.wysiwygSelector);
        this.$hiddenInputSelector = $(this.hiddenInputSelector);
    }

    isWysiwygVisible = () => {
        let outcome = false;
        if(this.$wysiwig && this.$wysiwig.length > 0) {
            outcome = true;
        }
        return outcome;
    };

    getWysiwygSelector = () => {
        return this.wysiwygSelector;
    };

    onFormSubmit = (callback) => {
        if(this.isWysiwygVisible()) {
            const $form = this.$wysiwig.closest("form");
            $form.on('submit', () => {
                callback();
                return true;
            });
        }
    };

    onFieldFocusOut = (callback) => {
        this.$wysiwig.on(this.tfocusOut, () => {
            callback();
            return true;
        });
    };

    setWysiwygTextToHiddenInput = () => {
        const text = $(this.wysiwygSelector).find(this.qlEditorSelector).html();
        $(this.$hiddenInputSelector).val(text);
    };
}



