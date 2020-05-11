#Single Image Slider

##Installazione
- Prima di tutto nel vostro file di ````variables```` dovete aggiungere le seguenti:

```css
/*---cro-auto-adjust-gallery---*/
$croAAG_minImageSize: 50ch;
$croAAG_gridGap: 2ch;
$croAAG_overlayAlpha: 0.5;
$croAAG_overlayTextColor: #ffffff;
```
- Importare il modulo css dove vi serve:
```css
@import "custom/cro-auto-adjust-gallery/cro-auto-adjust-gallery";
```
- nell'html poi bisogna creare un container con immagini nel seguente formato:
```html
 <div class="cro__auto-adjust__gallery square overlay-zoom">
    <div class="gallery__box">
        <a class="image__track" href="#">
            <img src="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
        </a>
        <a href="#" class="overlay__track">
            <div class="overlay__text">The overlay text!</div>
        </a>
        <div class="caption__track">
            qui posso mettere un testo o divs o quello che voglio
        </div>
    </div>
    ...
 </div>
```

###Configurazione

__overlay__track__ e __caption__track__, sono div opzionali
  
###Parametrizzazione
poi ci sono parametri per cambiare varie cose delle immagini:

####size delle immagini
Per cambiare il size facilmente basta cambiare la variabile nel css chiamata __$croAAG_minImageSize__

####distanza tra immagini
Stessa cosa per questa, cambiare il __$croAAG_gridGap__

####Colore testo overlay
Quando faccio hover sull'immagine vedró un testo del colore deciso por la variabile: __$croAAG_overlayTextColor__

####Alpha Hover
Quando fai l'hover viene fuori un box con un testo. Per cambiare la trasparenza basta cambiare __$croAAG_overlayAlpha__

####Tipo di hover
* se vuoi l'hover che viene fuori da sotto basta semplicemente mettere, 
accanto alla classe principale chiamata __.auto-adjust-image-gallery__ , la classe ```.overlay-up```
* Se vuoi l'hover con un leggero zoom dell'immagine, allora metti la classe  ```.overlay-zoom```

__UNA DELLE DUE CLASSI É OBBLIGATORIA__

####Quadrati o rettangoli?
Se si vuole che gli elementi siano quadrati basta semplicemente mettere, 
accanto alla classe principale chiamata __.auto-adjust-image-gallery__ , la classe ```square``` 
