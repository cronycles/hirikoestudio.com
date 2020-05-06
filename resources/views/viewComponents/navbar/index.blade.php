<header class="jheader">
    <div class="header__logo"><a href="{{$model->logo->url}}"><img src="{{$model->logo->imageUrl}}" alt="{{$model->logo->altText}}"></a></div>
    <div class="jburgerBtn nav__burger">
        <i data-open="las la-times" data-closed="las la-bars" class="las la-bars"></i>
    </div>
    <nav>
        <ul class="jnavList">
            @foreach($model->pageLinks as $pageLink)
            <li><a href="{{$pageLink->url}}" class="{{ $pageLink->isActive ? 'active' : "" }}">{{$pageLink->text}}</a></li>
            @endforeach
            @if ($model->isMultilanguageActive)
                <li>
                    <div class="nav__dropdown-container">
                        <div class="jdropdownButton nav__dropdown-button">
                            <span style="float: left">{{ $model->currentLanguage }}</span>
                            <i data-open="la-caret-right" data-closed="la-caret-down" class="la la-caret-down"></i>
                        </div>
                        <div class="jdropdownContent nav__dropdown-list-container">
                            @foreach ($model->languageLinks as $languageLink)
                                <a href="{{ $languageLink->url }}">
                                    {{ $languageLink->text }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endif
                @if ($model->isUserAuth)
                    <li>
                        <div class="nav__dropdown-container">
                            <div class="jdropdownButton nav__dropdown-button">
                                {{ $model->userName }}
                                <i data-open="la-caret-right" data-closed="la-caret-down" class="la la-caret-down"></i>
                            </div>
                            <div class="jdropdownContent nav__dropdown-list-container">
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
</header>
