@if ($professionals)
    @if ($show_fake_profiles)
        @foreach($professionals as $professional)
            @php
                $lastItem = end($professionals);
            @endphp
            <div data-page="{{$page}}" class="fake-professionals-cards cards cards-professionals" @if($lastItem && $professional == $lastItem) data-load-more-professionals="1" @endif>
                <div class="cards-professionals__header">
                    <a class="fake-professionals-cards__link" href="{{url('/profile?show_pending_popup=1')}}">
                        <img src="{{asset('img/users/' . $professional . '.svg')}}"/>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        @php
            $items = $professionals->toArray();
            $lastItem = end($items);
        @endphp
        @foreach($professionals as $professional)
            <div data-page="{{$page}}" class="cards cards-professionals" @if(isset($lastItem['id']) && $professional->id == $lastItem['id']) data-load-more-professionals="1" @endif>
                <div class="cards-professionals__header">
                    <div class="cards-professionals__avatar @if($professional->is_verified) checked @endif">
                        <a href="{{url('/profile/' . $professional->id)}}" class="avatar">
                            @if($professional->photo)
                                <img src="{{url('/files/' . $professional->photo . '?s=200')}}" alt="@if($professional->name){{$professional->name}}@else{{$professional->email}}@endif">
                            @else
                                @php
                                    $imageColor = ($professional->id % 6) + 1;
                                @endphp
                                <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="@if($professional->name){{$professional->name}}@else{{$professional->email}}@endif">
                            @endif
                        </a>
                    </div>
                    <div class="cards-professionals__info">
                        <a href="{{url('/profile/' . $professional->id)}}">@if($professional->name){{$professional->name}}@else{{$professional->email}}@endif</a>
                        <div class="d-flex justify-content-between">
                            @if($professional->job_title)<span>{{$professional->job_title}}</span>@endif
                            @if($professional->location_title)<span>{{$professional->location_title}}</span>@endif
                        </div>
                        @if($professional->company_title)<span>@ {{$professional->company_title}}</span>@endif
                    </div>
                </div>
                <ul class="cards-professionals__desc">
                    @if($professional->top_skills)
                        @php
                            $topSkills = explode("\n", trim($professional->top_skills));
                            array_map('trim', $topSkills);
                            if (!empty($topSkills) && count($topSkills) == 1 && isset($topSkills[0]) && ($topSkills[0] == "" || $topSkills[0] == " ")) {
                                $topSkills = null;
                            }
                        @endphp
                        @if(!empty($topSkills))
                            <li>
                                <span>Top Skills / Area of Interest</span>
                                <ul class="list-type-circle">
                                    @foreach($topSkills as $skill)
                                        @if(trim($skill))
                                            <li>{{$skill}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                    @if($professional->impress)
                        <li>
                            <span>IMPRESSIVE BIO:</span>
                            <div class="border-violet">{{$professional->impress}}</div>
                        </li>
                    @endif
                    @if($professional->educations_verified->count() || $professional->certifications_verified->count())
                        <li>
                            @if($professional->educations_verified->count())
                                @foreach($professional->educations_verified as $education)
                                    @if($education->title)<p>{{$education->title}}@if($education->speciality)({{$education->speciality}})@endif<span><img src="{{asset('img/icons/checked.svg')}}" alt="checked"></span></p>@endif
                                @endforeach
                            @endif
                                @if($professional->certifications_verified->count())
                                    @foreach($professional->certifications_verified as $certificate)
                                        @if($certificate->title)<p>{{$certificate->title}} <span><img src="{{asset('img/icons/checked.svg')}}" alt="checked"></span></p>@endif
                                    @endforeach
                                @endif
                        </li>
                    @endif
                </ul>
                @php
                    $meetup = $professional->meetup();
                    $user = Auth::user();
                @endphp
                @if (!$meetup || ($meetup && $meetup->status == 3) || ($meetup && $meetup->status == 4)) {{--failed-declined meetup--}}
                    <a href="{{url('/profile/' . $professional->id . '/meetup')}}" class="btn btn-violet btn-meetup">Meetup</a>
                @elseif ($meetup && $meetup->status == 2)
                    @if ($user->id == $meetup->user_id_invited)
                        <a href="@if ($meetup->invitingUser && $meetup->invitingUser->phone)tel:{{$meetup->invitingUser->phone}}@else{{"#"}}@endif" class="btn btn-violet btn-meetup-connected">Call to Meetup</a>
                    @else
                        <a href="@if ($meetup->invitedUser && $meetup->invitedUser->phone)tel:{{$meetup->invitedUser->phone}}@else{{"#"}}@endif" class="btn btn-violet btn-meetup-connected">Call to Meetup</a>
                    @endif
                @elseif ($meetup && $meetup->status == 1 && $meetup->user_id_inviting == $user->id)
                    <button type="button" class="btn btn-gray btn-meetup-send">Meetup invite sent</button>
                @elseif ($meetup && $meetup->status == 1 && $meetup->user_id_invited == $user->id)
                    <a href="{{url('/profile/' . $professional->id . '?open_check_popup=1')}}" class="btn btn-violet btn-meetup" data-meetup-new-meetup="">Check invite</a>
                @endif
            </div>
        @endforeach
    @endif
@endif
