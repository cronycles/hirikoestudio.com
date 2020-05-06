<!DOCTYPE html>
<html lang="{{ $model->currentLanguageId}}">
@include('custom.layouts.head._head')

<body>
@include('custom.layouts._client-server')
@render(\App\Http\ViewComponents\Navbar\Components\NavbarComponent::class)

<div class="jpage wrapper" data-p="{{$model->id}}">
    @include('custom.form.messages.success')
    @yield('content')
</div>
@include('custom.layouts._scripts')
</body>

</html>
