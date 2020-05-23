<head>
    @include('custom.layouts.head._meta')
    @include('custom.layouts.head._canonical-hreflang')
    <title>{{$model->htmlTitle}} - {{config('custom.company.name')}}</title>
    @include('custom.layouts.head._styles')
</head>
