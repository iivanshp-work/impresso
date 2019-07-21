@if ($jobs)
    @php
        $items = $jobs->toArray();
        $lastItem = end($items);
        $adPosition = rand(1, 4);
    @endphp
    @foreach($jobs as $key => $job)
        @if($key == $adPosition)
            <div data-page="{{$page}}" class="cards cards-jobs bg-violet-gradient">
                <p>Your CV makes money.<br />
                    What about you?</p>
                <span class="icon icon_top">Ad</span>
                <span class="icon icon_bottom"><img src="{{asset('img/icons/logo-impresso-labs.png')}}" alt="Ad"></span>
            </div>
            <!--<div>ADD google adwords // TODO???????</div>-->
        @endif
        <div data-page="{{$page}}" class="cards cards-jobs" @if(isset($lastItem['id']) && $job->id == $lastItem['id']) data-load-more-jobs="1" @endif>
            <div class="cards-jobs__avatar">
                @php
                    $imageColor = ($job->id % 13) + 1;
                @endphp
                <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="{{$job->job_title}}">
            </div>
            <div class="cards-jobs__detail">
                <a href="{{url('/jobs/' . $job->id)}}">{{$job->job_title}}</a>
                <div>
                    @if($job->short_description)<span>{{$job->short_description}}</span>@endif
                    @if($job->location_title)<span>{{$job->location_title}}</span>@endif
                </div>
                @if($job->company_title)<a href="{{url('/jobs/' . $job->id)}}" class="cards-jobs__company">@ {{$job->company_title}}</a>@endif
            </div>
        </div>
    @endforeach

@endif