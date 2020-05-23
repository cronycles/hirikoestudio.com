@if($model->projects != null && !empty($model->projects))
    @if($model->categories != null && !empty($model->categories))
        <ul class="page__section__box product__categories">
            @foreach($model->categories as $category)
                <li class="jcl product__category {{$category->isActive ? 'active' : ''}}"
                    data-c="{{$category->id}}">{{$category->name}}</li>
            @endforeach
        </ul>
    @endif
    <div class="page__section__box">
        <div class="cro__auto-adjust__gallery overlay-zoom">
            @foreach($model->projects as $project)
                <article class="gallery__box jcb" data-c="{{$project->category->id}}">
                    <a class="image__track" href="{{$project->url}}" title="{{$project->title}}">
                        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                             data-src="{{$project->cover ? $project->cover->url : ""}}"
                             alt="{{$project->title}}"
                             title="{{$project->title}}"
                             class="jlimg">
                    </a>
                    <a href="{{$project->url}}" title="{{$project->title}}" class="overlay__track">
                        <div class="overlay__text">{{$project->title}}</div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
@endif


