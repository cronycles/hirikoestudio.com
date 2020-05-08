<!DOCTYPE html>
<html lang="{{ $model->currentLanguageId}}">
@include('custom.layouts.head._head')

<body>
@include('custom.layouts._client-server')
@render(\App\Http\ViewComponents\Header\Components\HeaderComponent::class)

<div id="wrapper" class="jpage" data-p="{{$model->id}}">
    @include('custom.form.messages.success')
    @include('layouts.partials._breadcrumbs', ['breadcrumbs' => $model->breadcrumbs])

    @yield('content')
</div>
@include('custom.layouts._scripts')
</body>

</html>
