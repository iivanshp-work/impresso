<footer class="footer">
    <div class="footer__fixed">
        <div class="footer__body">
            <a href="{{url(getenv('BASE_LOGEDIN_PAGE'))}}">
                <img src="{{ asset('img/icons/folder.svg') }}" alt="feeds">
            </a>
            <a data-share-open-btn="" href="">
                <img src="{{ asset('img/icons/share.svg') }}" alt="share">
            </a>
            <a href="{{url('/profile')}}">
                <img src="{{ asset('img/icons/user.svg') }}" alt="profile">
            </a>
            <a href="{{url('/transaction-history')}}">
                @php
                    use App\User;
                    $user = Auth::user();
                @endphp
                {{$user->credits_count}} {{getenv('CREDITS_LABEL')}}
            </a>
        </div>
    </div>
</footer>
