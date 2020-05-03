# cro' ScriptsLazy

## Descrizione
La classe `lazy.factory.js` permette scacicare e eseguire scripts solo dopo che tutta la pagina
si sia caricata.

## Funzionamento
- Dentro la cartella `resources/js/lazy`' ci vanno tutte le classi che si vogliono scaricare in maniera Lazy.
C'è gia un esempio dentro. 
- Una volta scritta la classe, il file va importato dentro il file `js/lazy.js`.
- aprire il file `ready.js` e importare il `lazy.factory.js`.
- sempre dentro il file `ready.js` eseguire le linee:

`let lazyFactory = new LazyFactory();`

`lazyFactory.loadLazyScripts();`

Gli url dei file da scaricare verranno automaticamente caricati nel file `views/custom/layouts/_client-server.blade.php`
