<!DOCTYPE html>
<html lang="{{App::getLocale()}}" xmlns="http://www.w3.org/1999/xhtml">
@section('htmlheader')
    @include('frontend.layouts.partials.htmlheader')
@show
<body class="loaded">
{{--@include('frontend.layouts.partials.header')--}}
{{--@hasSection('news-line')@yield('news-line')@endif--}}
@yield('main-content')
@section('footer')
    @include('frontend.layouts.partials.footer')
@show
@section('popups')
    @include('frontend.layouts.partials.popups')
@show
@section('scripts')
    @include('frontend.layouts.partials.scripts')
@show
</body>

</html>

