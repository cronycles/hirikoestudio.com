<!DOCTYPE html>
<html lang="{{ $model->currentLanguageId}}">
@include('custom.layouts.head._head')

<body>
@include('custom.layouts._client-server')
@render(\App\Http\ViewComponents\Header\Components\HeaderComponent::class)

<div id="wrapper" class="jpage" data-p="{{$model->id}}">
    @include('custom.form.messages.success')

    @yield('content')
</div>

@include('custom.layouts._scripts')
@include('custom.layouts._analytics')
</body>

</html>
