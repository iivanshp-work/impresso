@if ($professionals)
    @php
        $items = $professionals->toArray();
        $lastItem = end($items);
    @endphp
    @foreach($professionals as $professional)
        <div class="cards cards-professionals" @if(isset($lastItem['id']) && $professional->id == $lastItem['id']) data-load-more-professionals="1" @endif>
            <div class="cards-professionals__header">
                <div class="cards-professionals__avatar @if($professional->is_verified) checked @endif">
                    <a href="{{url('/profile/' . $professional->id)}}" class="avatar">
                        @if($professional->photo)
                            <img src="{{url('/files/' . $professional->photo)}}" alt="@if($professional->name){{$professional->name}}@else{{$professional->email}}@endif">
                        @else
                            @php
                                $imageColor = rand(1, 6);
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
                        $topSkills = explode("\n", $professional->top_skills);
                        array_map('trim', $topSkills);
                    @endphp
                    @if(!empty($topSkills))
                        <li>
                            <span>Top Skills / Area of Interest</span>
                            <ul class="list-type-circle">
                                @foreach($topSkills as $skill)
                                    <li>{{$skill}}</li>
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
                @if(0)
                    <li>
                        <p>Bachelor of Science (Physiotherapy) <span><img src="img/icons/checked.svg" alt="checked"></span></p>
                        <p>University of Copenhagen <span><img src="img/icons/checked.svg" alt="checked"></span></p>
                    </li>
                @endif
            </ul>
            <a href="{{url('/profile/' . $professional->id . '#meetup')}}" class="btn btn-border disabled">Meetup</a>
        </div>
    @endforeach
@endif