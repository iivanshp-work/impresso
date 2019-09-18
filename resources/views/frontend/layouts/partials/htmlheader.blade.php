<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1" />
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') - @endif{{ LAConfigs::getByKey('sitename') }}</title>
    <meta name="description" content="@hasSection('meta_description')@yield('meta_description') @endif{{ LAConfigs::getByKey('site_description') }}">
    <meta name="keywords" content="@hasSection('meta_keywords')@yield('meta_keywords') @endif{{ LAConfigs::getByKey('site_keywords') }}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/la-assets/favicon.ico') }}" type="image/x-icon">
    <!-- fonts google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <!-- main style -->
    <link href="{{ asset('css/style.css?v=' . getenv('ASSETS_VERSION')) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom-dev.css?v=' . getenv('ASSETS_VERSION')) }}" rel="stylesheet" type="text/css">
    <script>
        var base_url = '{{url('/')}}';
        var google_api_key = '{{getenv('GOOGLE_API_KEY')}}';
        var user_id = '{{Auth::id()}}';
        var share_url = '{{getenv('SHARE_URL')}}';
    </script>
    @stack('styles')
</head>

