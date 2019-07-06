@if ($jobs)
    @foreach($jobs as $job)
        <div class="cards cards-jobs">
            <div class="cards-jobs__avatar">
                @php
                    $imageColor = rand(1, 13);
                @endphp
                <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="{{$job->job_title}}">
            </div>
            <div class="cards-jobs__detail">
                <a href="{{url('/jobs/' . $job->id)}}">{{$job->job_title}}</a>
                <div>
                    @if($job->short_description)<span>{{$job->short_description}}</span>@endif
                    <span>{{$job->location_title}}</span>
                </div>
                @if($job->company_title)<a href="{{url('/jobs/' . $job->id)}}" class="cards-jobs__company">@ {{$job->company_title}}</a>@endif
            </div>
        </div>
    @endforeach
    <div class="cards cards-jobs bg-violet-gradient">
        <p>Your CV makes money.<br />
            What about you?</p>
        <span class="icon icon_top">Ad</span>
        <span class="icon icon_bottom"><img src="img/icons/logo-impresso-labs.png" alt=""></span>
    </div>
@endif