#Single Image Slider

##Descrizione
Questa é una semplicissima galleria di immagini verticali, senza niente di niente.

L'unica cosa che fa é, se le immagini sono marcate come __small__, rimpicciolirle alla metá dell'occupazione, 
cosicché, invece di occupare una intera colonna, ne occupano metá.

##Installazione
- Prima di tutto nel vostro file di ````variables```` dovete aggiungere le seguenti:
```css
/*---cro-vertical-gallery---*/
$croVG_gridGap: 2ch;
```
- Importare il modulo css dove vi serve:
```css
@import "custom/cro-vertical-gallery/cro-vertical-gallery";
```
- nell'html poi bisogna creare un container con immagini nel seguente formato:
```html
 <div class="cro__vertical__gallery">
    <div class="gallery__box">
        <div class="image__track">
            <img src="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
        </div>
    </div>
    ...
 </div>
```

###Parametrizzazione
poi ci sono parametri per cambiare varie cose delle immagini:

####distanza tra immagini
Stessa cosa per questa, cambiare il __$croVG_gridGap__

####Small o Full?
Se si vuole che gli elementi siano piú piccoli e per esempio si vuole farne stare 2 in una colonna, 
accanto alla classe __.gallery__box__ , basta mettere la classe la classe ```small``` 
e l'immagine occuperá una sola colonna
