# cro' ImagesUploader

## Funzionamento
I files che ci interessano sono:
- I view models: **/app/ViewModels/Images/ImagesUploaderViewModel**
- una pagina php **/view/images/imagesUploader/_form.blade.php**
- i js: **/resources/js/images/imagesUploader/_images.xxx.js**, ...

la pagina __form_ gestisce l'upload delle immaigni.

Ogni volta che si devono gestire uploads di immagini semplicemente bisogna:
- Includere il vostro form nella pagina che volete:

  ```php 
  @include('../cro-modules.views._form', ['$model' => $model->imageUploaderViewModel])
  ```

- richiamare dal vostro javascript

  ```php 
  new ImagesUploader()
  ```

nel **ImagesUploaderViewModel** ci sono una serie di variabili da riempire, questo non vuol dire che si debbano riempire tutte:

- **$images:** lista delle immagini da mostrare (no obbligatorio)
- **$uploadApiUrl:** url Di Upload Delle Immagini (obbligatorio)
- **$maxNumberOfFiles:** numero massimo di file che si possono caricare (obbligatorio)
