#Cro ReadMore Text

##Descrizione
Taglia il testo se passa una certa altezza e mette un bottone per mostrarlo e nasconderlo

##Installazione
- Importare il modulo css dove vi serve:
```css
@import "custom/cro-readmore-text/cro-readmore-text";
```
- Importare il js dove vi serve:
```js
import CroReadMoreText from "../custom/cro-readmore-text/cro.readmore.text";

export default class MyClass {
    constructor() {
        let options = {
            heightLimit: 120
        };
        new CroReadMoreText(options);
    }
};
```


- nell'html poi bisogna creare un container con il testo nel seguente formato:
```html
<div class="jCRTcontainer cro__readmore">
    <div>{!! $model->project->description !!}</div>
</div>
```
Mettete sempre il testo dentro di un div, perché, se il testo contiene tags html, non creerá problemi.

##Configurazione

Le opzioni si possono passare o no. Le opzioni default sono:
 - heightLimit: 120; (vuol dire 120px)
 - controlButtons: sono i controlli per mostrare o nascondere il testo. Di default sono un piu e un meno, 
   icone di lineAwesome font. Se si vogliono cambiare si possono passare via opzione, 
   l'importante é che mantengano le classi degli span originali


