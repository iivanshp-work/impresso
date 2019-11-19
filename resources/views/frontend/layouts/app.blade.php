<!DOCTYPE html>
<html lang="{{App::getLocale()}}" xmlns="http://www.w3.org/1999/xhtml">
@section('htmlheader')
    @include('frontend.layouts.partials.htmlheader')
@show
<body class="loaded">
    <div class="application">
        <div class="application__wrap">
            @yield('main-content')
        </div>
    </div>
@section('footer')
    @php
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
    @endphp
    @if ($controller == 'HomeController' && $action == "index")
        @include('frontend.layouts.partials.footer')
    @endif
@show
@section('popups')
    @include('frontend.layouts.partials.popups')
@show
@section('scripts')
    @include('frontend.layouts.partials.scripts')
@show
</body>

</html>

