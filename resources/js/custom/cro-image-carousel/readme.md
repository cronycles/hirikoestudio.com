#Cro Image Carousel

##Prerequisiti di importazione:
Il progetto dove importerete il plugin deve essere un progetto che:
- supporta il postCss e gli **@import**
- ha **jquery**
- ha l'owlcarousel 2 (npm install --save-dev owl.carousel)
- ha throttle.debounce.js (npm install --save-dev)
- ha il fontawesome (è una mia libreria, non un pacchetto)

##Come importare il modulo
- richiamare il JS dove vi serve:
    - require del modulo:
     ```javascript
      import ImageCarousel from '/resources/js/custom/cro-image-carousel/js/cro.image.carousel';
    ```
- richiamare il CSS dove vi serve:
    - require del modulo:
     ```css
      @import "custom/cro-image-carousel/cro-image-carousel.scss";
    ```
##Come usarlo
come potete osservare ci sono un paio di esempi di come usare il plugin:
un single carousel con banner e capition e uno con multiple images. Comunque ... 
nella cartella **/js** del plugin trovate un file chiamato **cro.image.carousel.options.js**
li ci sono tutte le opzioni di default da indicare quando si fa il bind del plugin.
###Opzioni:

- **carouselSelector**: è il selettore che metterete nel vostro html per il bind. 
    il consiglio é di passarlo sempre, perché altrimenti vi cercherá il default: ".cro-image__carousel",
- **imageForScreen**: **importante!!** Se volete che si carichino immagini diverse per dispositivo (mobile e desktop)
    allora dovete mettere ogni immagine in un **data-m** (se si tratta di mobile) o **data-d** se desktop.
    In questo modo il plugin detecta che é un mobile o desktop e sostituisce l'immagine 
- **mobileScreenMaxSize**: lo dice la parola stessa, si riferisce anche alla opzione di sopra
- **debounceTime**: lo dice la parola stessa
le opzioni qui sotto son proprie del owlCarousel
- **loop**: true,
- **nav**: true,
- **navText**: ['<i class="la la-angle-left" aria-hidden="true"></i>',
               '<i class="la la-angle-right" aria-hidden="true"></i>'],
- **items**: 1,
- **margin**: 0,
- **lazyLoad**: true,
- **dots**: false,
- **autoplay**: true,
- **autoplayTimeout**: 3000,
- **autoplayHoverPause**: true,
- **responsive**: {}
 
###HTML:
nell'html solo bisogna mettere il selettore che abbiamo passato nel js prima e una classe chiamata **cro-carousel**
in questo caso porto un esempio di un slider con:
- immagine per dispositivo
- caption
Se peró non si vuole ne l'una ne l'altra allora mettere una sola immagine in un **data-src** e togliere la caption:

    ```html
      <div class="single-image__carousel cro-carousel">
          <figure>
              <img data-m="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1600&h=1600&q=80&cs=tinysrgb&crop="
                   data-d="https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?dpr=2&auto=format&fit=crop&w=1600&h=600&q=80&cs=tinysrgb&crop="/>
              <figcaption class="carousel__caption">1</figcaption>
          </figure>
          <figure>
              <img data-m="https://images.unsplash.com/photo-1422255198496-21531f12a6e8?dpr=2&auto=format&fit=crop&w=1600&h=1600&q=80&cs=tinysrgb&crop="
                   data-d="https://images.unsplash.com/photo-1422255198496-21531f12a6e8?dpr=2&auto=format&fit=crop&w=1600&h=600&q=80&cs=tinysrgb&crop="/>
              <figcaption class="carousel__caption">2</figcaption>
          </figure>
          <figure>
              <img data-m="https://images.unsplash.com/photo-1490914327627-9fe8d52f4d90?dpr=2&auto=format&fit=crop&w=1600&h=1600&q=80&cs=tinysrgb&crop="
                   data-d="https://images.unsplash.com/photo-1490914327627-9fe8d52f4d90?dpr=2&auto=format&fit=crop&w=1600&h=600&q=80&cs=tinysrgb&crop="/>
              <figcaption class="carousel__caption">3</figcaption>
          </figure>
      </div>

    ```
    come vedete nel **data-m** va messo l'url della immagine per mobile e nel **data-d** quello per desktop
