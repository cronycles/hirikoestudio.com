<link rel="{{ $model->canonicalRouteUrl->rel }}" href="{{ $model->canonicalRouteUrl->url }}">
@if($model->hreflangRouteUrls != null && !empty($model->hreflangRouteUrls))
    @foreach($model->hreflangRouteUrls as $hreflangRouteUrl)
        <link rel="{{ $hreflangRouteUrl->rel }}"
              href="{{ $hreflangRouteUrl->url }}"
              hreflang="{{ $hreflangRouteUrl->languageCode }}">
    @endforeach
@endif

