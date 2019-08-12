@if ($jobs)
    @php
        $countItems = $jobs->count();
        $items = $jobs->toArray();
        $lastItem = end($items);
        $to = $countItems > 1 ? $countItems - 1 : 1;
        $adPosition = rand(1, $to);
    @endphp
    @foreach($jobs as $key => $job)
        @if($key == $adPosition && $jobAd)
            <div data-page="{{$page}}" class="cards cards-jobs bg-violet-gradient">
                <p>{!!$jobAd->text!!}</p>
                <span class="icon icon_top">Ad</span>
                <span class="icon icon_bottom"><img src="{{asset('img/icons/logo-impresso-labs.png')}}" alt="Ad"></span>
            </div>
        @endif
        <div data-page="{{$page}}" class="cards cards-jobs" @if(isset($lastItem['id']) && $job->id == $lastItem['id']) data-load-more-jobs="1" @endif>
            <div class="cards-jobs__avatar">
                @php
                    $imageColor = ($job->id % 13) + 1;
                @endphp
                <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="{{$job->job_title}}">
            </div>
            <div class="cards-jobs__detail">
                <a href="{{--url('/jobs/' . $job->id)--}}javascript:void(0);">{{$job->job_title}}</a>
                <div class="cards-jobs__desc">
                    @if($job->short_description)<span>{{$job->short_description}}</span>@endif
                    @if($job->location_title)<span>{{$job->location_title}}</span>@endif
                </div>
                @if($job->company_title)<a href="{{--url('/jobs/' . $job->id)--}}javascript:void(0);" class="cards-jobs__company">@ {{$job->company_title}}</a>@endif
            </div>
        </div>
    @endforeach

@endif
