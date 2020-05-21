export default class WysiwygView {
    constructor() {

        //Texts
        this.tfocusOut = "focusout";

        //Selectors
        this.wysiwygSelector = ".jwysiwyg";
        this.hiddenInputSelector = ".jwysiwygInput";
        this.qlEditorSelector = ".ql-editor";

        //DOM
        this.$wysiwygs = $(this.wysiwygSelector);

        this.$hiddenInputs = $(this.hiddenInputSelector);

        this.wysiwigRealSelectors = this.#initializeWysiwigRealSelectors();
    }

    #initializeWysiwigRealSelectors = () => {
        let outcome = [];
        if(this.$wysiwygs && this.$wysiwygs.length > 0) {
            this.$wysiwygs.map((index, element) => {
                let $wysiwyg = $(element);
                if($wysiwyg) {
                    const wysiwygRealSelector = "#" + $wysiwyg.attr('id');
                    outcome.push(wysiwygRealSelector)
                }
            })
        }
        return outcome;
    };

    areWysiwygsVisible = () => {
        let outcome = false;
        if(this.$wysiwygs && this.$wysiwygs.length > 0) {
            outcome = true;
        }
        return outcome;
    };

    getAllWysiwygSelectors = () => {
        return this.wysiwigRealSelectors;
    };

    onFormSubmit = (callback) => {
        if(this.areWysiwygsVisible()) {
            const $form = this.$wysiwygs.closest("form");
            $form.on('submit', () => {
                callback();
                return true;
            });
        }
    };

    onFieldFocusOut = (callback) => {
        this.$wysiwygs.on(this.tfocusOut, () => {
            callback();
            return true;
        });
    };

    setWysiwygTextToHiddenInput = () => {
        if(this.wysiwigRealSelectors && this.wysiwigRealSelectors.length > 0) {
            for(let wysiwigRealSelector of this.wysiwigRealSelectors) {
                const $wysiwygRealSelector = $(wysiwigRealSelector);
                const text = $wysiwygRealSelector.find(this.qlEditorSelector).html();
                const inputName = $wysiwygRealSelector.data('name');
                const $hiddenInput = this.$hiddenInputs.filter(`[name='${inputName}']`);
                $hiddenInput.val(text);
            }
        }
    };
}



