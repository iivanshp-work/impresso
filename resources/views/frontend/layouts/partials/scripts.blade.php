<script src="{{ asset('/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('/js/components/slick.js') }}"></script>
<script src="{{ asset('/js/custom.js?v=' . getenv('ASSETS_VERSION')) }}"></script>
<script src="{{ asset('/js/custom-dev.js?v=' . getenv('ASSETS_VERSION')) }}"></script>
<script src="//www.gstatic.com/firebasejs/3.6.8/firebase.js"></script>
<script src="{{ asset('/js/firebase_subscribe.js?v=' . getenv('ASSETS_VERSION')) }}"></script>
@stack('scripts')
