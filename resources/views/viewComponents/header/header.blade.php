<header id="header" class="jheader {{$model->hasInvertedColors ? 'inverted' : ''}}">
    <div class="header__logo jlinv none">
        <a href="{{$model->logo->url}}" title="{{$model->logo->htmlTitle}}">
            <img
                src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                data-src="{{$model->logo->invertedImageUrl}}"
                alt="{{$model->logo->htmlTitle}}"
                title="{{$model->logo->htmlTitle}}"
                class="jlimg">
        </a>
    </div>
    <div class="header__logo jlnorm">
        <a href="{{$model->logo->url}}" title="{{$model->logo->htmlTitle}}">
            <img
                src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                data-src="{{$model->logo->imageUrl}}"
                alt="{{$model->logo->htmlTitle}}"
                title="{{$model->logo->htmlTitle}}"
                class="jlimg">
        </a>
    </div>
    <div id="header__burger" class="jburgerBtn">
        <i data-open="las la-times" data-closed="las la-bars" class="las la-bars"></i>
    </div>
    <div id="header__links-wrapper">
        <nav id="header__nav" class="jnavContainer">
            <ul>
                @foreach($model->pageLinks as $pageLink)
                    <li>
                        <a href="{{$pageLink->url}}"
                           title="{{$pageLink->htmlTitle}}"
                           class="{{ $pageLink->isActive ? 'active' : "" }}">{{$pageLink->text}}
                        </a>
                    </li>
                @endforeach
            </ul>
            @if (!empty($model->socialLinks))
                <ul>
                    @foreach($model->socialLinks as $socialLink)
                        <li>
                            <a href="{{$socialLink->url}}"
                               title="{{$socialLink->text}}"
                               target="_blank">
                                <i class="{{$socialLink->iconClass}}" title="{{$socialLink->text}}"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <ul>
                @if (!empty($model->languageLinks))
                    <li>
                        <div class="nav__dropdown-container">
                            <div class="jdropdownButton dropdown__button">
                                <span>{{ $model->currentLanguage }}</span>
                                <i data-open="la-caret-right" data-closed="la-caret-down" class="la la-caret-down"></i>
                            </div>
                            <div class="jdropdownListContainer dropdown__list-container">
                                @foreach ($model->languageLinks as $languageLink)
                                    <a href="{{ $languageLink->url }}">
                                        {{ $languageLink->text }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
            @if ($model->isUserAuth)
                <ul>
                    <li>
                        <div class="nav__dropdown-container">
                            <div class="jdropdownButton dropdown__button">
                                {{ $model->userName }}
                                <i data-open="la-caret-right" data-closed="la-caret-down" class="la la-caret-down"></i>
                            </div>
                            <div class="jdropdownListContainer dropdown__list-container">
                                @foreach($model->adminPageLinks as $adminPageLink)
                                    <a href="{{$adminPageLink->url}}"
                                       class="{{ $adminPageLink->isActive ? 'active' : "" }}">
                                        {{ $adminPageLink->text }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
        </nav>
    </div>
</header>
