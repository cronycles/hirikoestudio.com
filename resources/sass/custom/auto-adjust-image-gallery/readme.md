#Single Image Slider

## Come usarla
- Importare il modulo css dove vi serve:
    ```css
    @import "custom/auto-adjust-image-gallery/auto-adjust-image-gallery.scss";
    ```
- nell'html poi bisogna creare un container con immagini nel seguente formato:
    ```html
     <div class="auto-adjust-image-gallery">
         <figure>
             <img src="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 jelly-o brownie sweet
             </figcaption>
         </figure>
         <figure class="large">
             <img src="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 Muffin jelly gingerbread
             </figcaption>
         </figure>
         <figure class="full">
             <img src="https://images.unsplash.com/photo-1422255198496-21531f12a6e8?dpr=2&auto=format&fit=crop&w=1500&h=996&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 sesame snaps chocolate
             </figcaption>
         </figure>
         <figure class="medium">
             <img src="https://images.unsplash.com/photo-1490914327627-9fe8d52f4d90?dpr=2&auto=format&fit=crop&w=1500&h=2250&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 Oat cake
             </figcaption>
         </figure>
         <figure class="large">
             <img src="https://images.unsplash.com/photo-1476097297040-79e9e1603142?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 jujubes cheesecake
             </figcaption>
         </figure>
         <figure>
             <img src="https://images.unsplash.com/photo-1464652149449-f3b8538144aa?dpr=2&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=">
             <div class="overlay">
                 <button>View →</button>
             </div>
             <figcaption>
                 Dragée pudding brownie
             </figcaption>
         </figure>
     </div>
    ```
poi ci sono parametri per cambiare varie cose delle immagini:

###size delle immagini
Per cambiare il size facilmente basta cambiare la variabile nel css chiamata __$imageSize__

###distanza tra immagini
Stessa cosa per questa, cambiare il __$gridGap__

###Quadrati o rettangoli?
Se si vuole che siano piú rettangolari le immagini basta semplicemente mettere, accanto alla classe principale
chiamata __.auto-adjust-image-gallery__ la classe ```.rectangle``` 

###tipo di visualizzazione 
ogni ```<figure>``` puó avere o non avere una particolare classe che le cambia completamente la visualizzazione:
- __medium__: fa crescere di 2 righe l'immagine
- __large__: fa crescere di 3 righe l'immagine
- __full__: non capisco, ancora non so cosa faccia
