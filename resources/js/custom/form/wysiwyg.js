import Quill from 'quill/dist/quill.min';
import WysiwygView from "./wysiwyg.view";
export default class Wysiwyg {
    #view;
    constructor() {
        this.#view = new WysiwygView();
        this.#initializeWysiwygIfVisible();
    }

    #initializeWysiwygIfVisible = () => {
        const wysiwygSelectors = this.#view.getAllWysiwygSelectors();
        if(wysiwygSelectors && wysiwygSelectors.length > 0)  {
            for (let wysiwygSelector of wysiwygSelectors) {
                this.#initializeWysiwygPlugin(wysiwygSelector);
            }

            this.#view.onFormSubmit(this.#view.setWysiwygTextToHiddenInput);
            this.#view.onFieldFocusOut(this.#view.setWysiwygTextToHiddenInput);
        }
    };

    #initializeWysiwygPlugin = (wysiwygSelector) => {
        if(wysiwygSelector)  {
            new Quill(wysiwygSelector, {
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{list: 'ordered'}],
                        ['link']
                    ]
                },
                theme: 'snow'
            });
        }
    };

}



