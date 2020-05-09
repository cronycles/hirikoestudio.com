#Single Image Slider

##Installazione
- Prima di tutto nel vostro file di ````variables```` dovete aggiungere le seguenti:
```css
/*---cro-auto-adjust-gallery---*/
$croAAG_imageSize: 25rem;
$croAAG_gridGap: 2ch;
$croAAG_overlayBackgroundColor: rgba(0, 0, 0, 0.5);
```
- Importare il modulo css dove vi serve:
```css
@import "custom/cro-auto-adjust-gallery/cro-auto-adjust-gallery";
```
- nell'html poi bisogna creare un container con immagini nel seguente formato:
```html
 <div class="cro__auto-adjust__gallery overlay-up">
    <figure class="gallery__image__box medium">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
        </a>
        <a href="#" class="overlay__box">
            <div class="overlay__text">The overlay text!</div>
        </a>
        <figcaption>
            qui posso mettere un testo o divs o quello che voglio
        </figcaption>
    </figure>
    ...
 </div>
```

###Configurazione
ovviamente tutti i div interni sono opzionali tranne ovviamente la __img__
  
###Parametrizzazione
poi ci sono parametri per cambiare varie cose delle immagini:

####size delle immagini
Per cambiare il size facilmente basta cambiare la variabile nel css chiamata __$imageSize__

####distanza tra immagini
Stessa cosa per questa, cambiare il __$gridGap__

####Colore Hover
Quando fai l'hover viene fuori un box colorato con un testo. Sil colore si cambia dalla variabile __$overlayBackgroundColor__

####Tipo di hover
* se vuoi l'hover che viene fuori da sotto basta semplicemente mettere, 
accanto alla classe principale chiamata __.auto-adjust-image-gallery__ , la classe ```.overlay-up```
* Se vuoi l'hover con un leggero zoom dell'immagine, allora metti la classe  ```.overlay-zoom```

####Quadrati o rettangoli?
Se si vuole che siano piú rettangolari le immagini basta semplicemente mettere, accanto alla classe principale
chiamata __.auto-adjust-image-gallery__ la classe ```rectangle``` 

###tipo di visualizzazione 
ogni ```<figure>``` puó avere o non avere una particolare classe che le cambia completamente la visualizzazione:
- __medium__: fa crescere di 2 righe l'immagine
- __large__: fa crescere di 3 righe l'immagine
- __full__: non capisco, ancora non so cosa faccia
