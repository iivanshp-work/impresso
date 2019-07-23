@extends("frontend.layouts.app")

@section("htmlheader_title")
    Transaction History
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Transaction History</h4>
            <a href="{{url()->previous()}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
            <a href="{{url('/notifications')}}" class="header__icon-right">
                <img src="{{asset('img/icons/bell.svg')}}" alt="" />
                @php
                    $user = Auth::user();
                    $hasNewNotifications = $user->has_new_notifications;
                @endphp
                @if($hasNewNotifications)
                    <img src="{{asset('img/icons/exclamation-mark.svg')}}" alt="" class="bell-exclamation">
                @endif
            </a>
        </header>
        <main class="dashboard">
            <h1 class="title text-center">{{$user->credits_count}} {{getenv('CREDITS_LABEL')}}</h1>
            @if($userTransactions)
                @foreach($userTransactions as $userTransaction)
                    <div class="cards dashboard__card">
                        <div class="dashboard__header">
                            <span class="dashboard__date">{{Carbon::parse($userTransaction->created_at)->format('j M, Y')}}</span>
                            <span class="arrow-down"><img src="{{asset('img/icons/arrow-down.svg')}}" alt="arrow-down" /></span>
                            <div class="dashboard__info" data-id="{{$userTransaction->id}}" data-type="{{$userTransaction->type}}">
                                <a href="#" class="dashboard__avatar">
                                    @php
                                        $imageColor = ($userTransaction->id % 13) + 1;
                                    @endphp
                                    <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="" />
                                </a>
                                <div class="dashboard__text">
                                    @if($userTransaction->type == 'user_validation')
                                        <a href="javascript:void(0);">{{'Impresso Labs'}}</a>
                                    @elseif($userTransaction->type == 'purchase')
                                        <a href="javascript:void(0);">{{'Your Purchase'}}</a>
                                    @elseif($userTransaction->type == 'share')
                                        <a href="javascript:void(0);">{{'Impresso Labs'}} <span>Share</span></a>
                                    @elseif($userTransaction->type == 'validation_education')
                                        @if($userTransaction->education)
                                            <a href="javascript:void(0);">{{ str_limit($userTransaction->education->title, 15) }} <span>Education Validation</span></a>
                                        @else
                                            <a href="javascript:void(0);">Education Validation</a>
                                        @endif
                                    @elseif($userTransaction->type == 'validation_certificate')
                                        @if($userTransaction->certificate)
                                            <a href="javascript:void(0);">{{ str_limit($userTransaction->certificate->title, 15) }} <span>Certificate Validation</span></a>
                                        @else
                                            <a href="javascript:void(0);">Certificate Validation</a>
                                        @endif
                                    @elseif($userTransaction->type == 'other')
                                        <a href="javascript:void(0);">{{'Impresso Labs'}}</a>
                                    @endif
                                    {{--@if($userTransaction->user)
                                        @if($userTransaction->user->type == getenv('USERS_TYPE_ADMIN'))
                                            <a href="javascript:void(0);">{{'Impresso Labs'}}</a>
                                        @else
                                            <a href="{{url('/profile/' . $userTransaction->user->id)}}">{{$userTransaction->user->name}} @if($userTransaction->user->job_title)<span>{{$userTransaction->user->job_title}}</span>@endif</a>
                                        @endif
                                    @endif--}}
                                    <small>{{Carbon::parse($userTransaction->created_at)->format('H:i')}}</small>
                                </div>
                                <p>@if($userTransaction->amount > 0)+@elseif($userTransaction->amount < 0)-@endif @if($userTransaction->amount >= 0){{$userTransaction->amount}} @else {{str_replace('-', '', (string)$userTransaction->amount)}} @endif {{getenv('CREDITS_LABEL')}}</p>
                            </div>
                        </div>
                        <div class="dashboard__body">
                            @if($userTransaction->type == 'user_validation')
                                <p>You have received {{$userTransaction->amount}} XIMs for joining IMPRESSO.</p>
                            @elseif($userTransaction->type == 'purchase')
                                <p>You have purchased {{$userTransaction->amount}} XIMs.</p>
                            @elseif($userTransaction->type == 'share')
                                <p>Share IMPRESSO</p>
                            @elseif($userTransaction->type == 'validation_education')
                                @if($userTransaction->education)
                                    <p>Education validation: {{$userTransaction->education->title}}</p>
                                @else
                                    <p>Education validation</p>
                                @endif
                            @elseif($userTransaction->type == 'validation_certificate')
                                @if($userTransaction->certificate)
                                    <p>Certificate validation: {{$userTransaction->certificate->title}}</p>
                                @else
                                    <p>Certificate validation</p>
                                @endif
                            @elseif($userTransaction->type == 'other')
                                <p>{{$userTransaction->notes}}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="title text-center">There are no records yet.</h1>
            @endif

        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
