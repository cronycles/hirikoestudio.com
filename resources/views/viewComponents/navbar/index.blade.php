<header id="header" class="jheader">
    <div id="header__logo"><a href="{{$model->logo->url}}"><img src="{{$model->logo->imageUrl}}" alt="{{$model->logo->altText}}"></a></div>
    <div id="header__burger" class="jburgerBtn">
        <i data-open="las la-times" data-closed="las la-bars" class="las la-bars"></i>
    </div>
    <div id="header__links-wrapper">
        <nav id="header__nav" class="jnavContainer">
            <ul>
                @foreach($model->pageLinks as $pageLink)
                <li><a href="{{$pageLink->url}}" class="{{ $pageLink->isActive ? 'active' : "" }}">{{$pageLink->text}}</a></li>
                @endforeach
            </ul>
            <ul>
                @if ($model->isMultilanguageActive)
                    <li>
                        <div class="nav__dropdown-container">
                            <div class="jdropdownButton dropdown__button">
                                <span style="float: left">{{ $model->currentLanguage }}</span>
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
            <ul>
                @if ($model->isUserAuth)
                    <li>
                        <div class="nav__dropdown-container">
                            <div class="jdropdownButton dropdown__button">
                                {{ $model->userName }}
                                <i data-open="la-caret-right" data-closed="la-caret-down" class="la la-caret-down"></i>
                            </div>
                            <div class="jdropdownListContainer dropdown__list-container">
                                @foreach($model->adminPageLinks as $adminPageLink)
                                    <a href="{{$adminPageLink->url}}" class="{{ $adminPageLink->isActive ? 'active' : "" }}">
                                        {{ $adminPageLink->text }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
