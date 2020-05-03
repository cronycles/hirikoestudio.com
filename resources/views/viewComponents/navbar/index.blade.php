@if (Route::has('login'))
<div class="navbar">
    @foreach($model->pageLinks as $pageLink)
        <a href="{{$pageLink->url}}" class="{{ $pageLink->isActive ? 'active' : "" }}">{{$pageLink->text}}</a>
    @endforeach

    @if ($model->isMultilanguageActive)
        <div class="dropdown">
            <button class="dropbtn">
                {{ $model->currentLanguage }}
                <i class="la la-caret-down"></i>
            </button>
            <div class="dropdown-content">
                @foreach ($model->languageLinks as $languageLink)
                <a href="{{ $languageLink->url }}">
                    {{ $languageLink->text }}
                </a>
                @endforeach
            </div>
        </div>
    @endif

    @if ($model->isUserAuth)
        @foreach($model->adminPageLinks as $adminPageLink)
            <a href="{{$adminPageLink->url}}" class="dropdown-toggle {{ $adminPageLink->isActive ? 'active' : "" }}" data-toggle="dropdown">
                {{ $adminPageLink->text }}
            </a>
        @endforeach

    @else
        @foreach($model->userPageLinks as $userPageLink)
            <a href="{{$userPageLink->url}}" class="{{ $userPageLink->isActive ? 'active' : "" }}">{{$userPageLink->text}}</a>
        @endforeach
    @endif

</div>
@endif
