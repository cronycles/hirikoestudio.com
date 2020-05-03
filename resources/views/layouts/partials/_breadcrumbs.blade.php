@if($breadcrumbs != null && !empty($breadcrumbs))
    <article class="page__section">
        <ul class="section__breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                <li><a href="{{$breadcrumb->url}}">{{$breadcrumb->name}}</a></li>
            @endforeach
        </ul>
    </article>
@endif
