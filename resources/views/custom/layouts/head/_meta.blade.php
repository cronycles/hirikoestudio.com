<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{$model->htmlMetaDescription}}"/>
<meta name="keywords" content="{{$model->htmlMetaKeywords}}">
<meta name="author" content="cronycles">
<meta property="og:title" content="{{$model->htmlTitle}}">
<meta property="og:description" content="{{$model->htmlMetaDescription}}" />
<meta property="og:image" content="{{$model->ogImageUrl}}" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="{{$model->currentLanguage->cultureCode}}" />
<meta name="csrf-token" content="{{csrf_token()}}" />
