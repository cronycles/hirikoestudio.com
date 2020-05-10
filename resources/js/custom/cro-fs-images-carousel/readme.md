#Cro full screen image carousel

##Descrizione
Full screen slider carousel responsive

##Installazione
- Prima di tutto dovete installare con __npm__ in plugin __tinyslider 2.x__

- Importare il modulo css dove vi serve:
```css
@import "custom/cro-fs-images-carousel/cro-fs-images-carousel";
```
- Importare il js dove vi serve:
```js
import CroFullScreenImagesCarousel from "../custom/cro-fs-images-carousel/cro.fs.images.carousel";

export default class MyClass {
    constructor() {
        let options = {
        
        };
        new CroFullScreenImagesCarousel(options);
    }
};
```

- nell'html poi bisogna creare un container con immagini nel seguente formato:
```html
<div class="cro-fs-images-carousel">
    <figure><img class="tns-lazy-img" data-src="https://via.placeholder.com/1920x1080.png"></figure>
    <figure><img class="tns-lazy-img" data-src="https://via.placeholder.com/1080x1920.png"></figure>
    <figure><img class="tns-lazy-img" data-src="https://via.placeholder.com/1920x1080.png"></figure>
</div>
```

##Configurazione

si possono passare le opzioni del tinySlider al ```CroFullScreenImagesCarousel```
Documentazione e opzioni disponibily del tiny: https://github.com/ganlanyuan/tiny-slider

###Lazy
Questo plugin NON funziona con il mio lazy.images, ha uno suo e per farlo funzionare, come si puo vedere, 
utilizza la classe ```tns-lazy-img```
