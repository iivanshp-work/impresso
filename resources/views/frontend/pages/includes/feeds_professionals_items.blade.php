@if ($professionals)
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
            <a href="https://www.impressolabs.io/meetups/" class="btn btn-border disabled">Meetup</a>
        </div>
    @endforeach
@endif
