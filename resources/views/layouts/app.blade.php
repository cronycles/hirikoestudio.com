<!DOCTYPE html>
<html lang="{{ $model->currentLanguage->code}}">
@include('custom.layouts.head._head')

<body>
@include('custom.layouts._client-server')
@render(\App\Http\ViewComponents\Header\Components\HeaderComponent::class)

    <main class="jpage" data-p="{{$model->id}}">
        @include('custom.form.messages.success')

        @yield('content')
    </main>
@render(\App\Http\ViewComponents\Footer\Component\FooterComponent::class)
@render(\App\Http\ViewComponents\CookieConsent\Component\CookieConsentComponent::class)
@include('custom.layouts._scripts')
@include('custom.layouts._analytics')
</body>

</html>
