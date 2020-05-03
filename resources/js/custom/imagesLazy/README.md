# cro' Lazy images

## Funzionamento
A prescindere dai plugins, se si vuole scaricare una immagine in modo lazy basta:
- importare nel file `ready.js` questa classe **images.lazy.js**
- poi, sempre nel file `ready.js` aggiungere la linea `imagesLoading.loadAllLazyImagesIntoThePage();`
- Mettere l'immagine di placeholder (che si trova qui, nella cartella **/images**) in un url che si vuole (tipicamente il cdn)

Ora, in qualsiasi html che volete (o php) basta mettere l'immagine nel seguente modo:
`<img scr="<RouteDelPlaceholder>/lazy-img-placeholder.gif" data-src="<urlImmagine>" class="jlimg"/>`
