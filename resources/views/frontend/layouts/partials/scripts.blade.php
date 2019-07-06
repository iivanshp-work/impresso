<script src="{{ asset('/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('/js/components/slick.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/custom-dev.js?v=' . getenv('ASSETS_VERSION')) }}"></script>
@stack('scripts')
