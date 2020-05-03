<header class="header">
    <div class="header__inner">
        <div class="nav__logo">
            <a href="{{route('index')}}" class="logo__link"></a>
        </div>
        <div id="menuToggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
            @render(\App\Http\ViewComponents\Navbar\Component\NavbarComponent::class)
        </div>
    </div>
</header>
