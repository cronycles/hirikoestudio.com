#cro' Lazy images

##Descrizione
Il javascript permette di caricare le immagini in modo figo e solo quando appaiono sullo schermo

## Funzionamento
A prescindere dai plugins, se si vuole scaricare una immagine in modo lazy basta:
- importare nel file `ready.js` questa classe **images.lazy.js**
- poi, sempre nel file `ready.js` aggiungere la linea `imagesLoading.loadAllLazyImagesIntoThePage();`
- Mettere l'immagine di placeholder (che si trova qui, nella cartella **/images**) in un url che si vuole (tipicamente il cdn)

Ora, in qualsiasi html che volete (o php) basta mettere l'immagine nel seguente modo:
`<img src="<RouteDelPlaceholder>/lazy-img-placeholder.gif" data-src="<urlImmagine>" class="jlimg"/>`

###Configurazione
Chi fa tutto il lavoro é la classe ````jlimg````. 
L'uso di questa classe é consigliato per le immagini pre-show, cioé le gallerie di immagini ingresso 
a un progetto principale. Per le immagini di un progetto principale si consiglia l'uso della classe
```jlimg1000``` che fa un effetto figo di carica di immagini di 1000ms=1sec
