<div class="col-1">
  		@php 
      	use App\Models\Banner;
      	$banners = Banner::bannersByPosition("left_before_radio_tv",10);
      @endphp
      @if($banners)
				<div class="wrapper-banner margintop0">
				@foreach($banners as $banner)
      		@if($banner["html"] || $banner["image"])
					<div class="banner">
						@if($banner["link"])
							<a href="{{$banner["link"]}}">
						@endif
						@if($banner["html"])
							{!!$banner["html"]!!}
						@elseif($banner["image"])
							<img style="max-width: 100%;" src = "{{ url('files') . "/" . $banner["image"]["hash"] . '/' . $banner["image"]["name"] . ""}}" alt = "" class = "">
						@endif
						@if($banner["link"])
								</a>
							@endif
					</div>
					@endif
      	@endforeach
				</div>
			@endif
      <div class="mediablock">
          <h2 id="but-rd" class="block-header media" onclick="show('list-radio')">@lang('main.homepage_radio')</h2>
          <h2 id="but-tv" class="block-header media active" onclick="show('list-tv')">@lang('main.homepage_tv')</h2>
          <div id="list-radio" class="media-list-content">
            @if($radios)        
	            @foreach($radios as $radio)
	              <p>
									<a href="{{$radio["link"]}}">
		              @if($radio["logo"])
		                <img src = "{{ url('files') . "/" . $radio["logo"]["hash"] . '/' . $radio["logo"]["name"] . "?s=16"}}" alt = "{{$radio["title"]}}" class = "">
		              @endif
		              <span>{{$radio["title"]}}</span>
		              </a>
	              </p>
	            @endforeach
		       	@else
         			<p>@lang('main.homepage_no_records')</p>
		        @endif
          </div>
          <div id="list-tv" class="media-list-content">
        		@if($tvs)    
		            @foreach($tvs as $tv)
			            <p>
										<a href="{{$tv["link"]}}">
			              @if($tv["logo"])
			                <img src = "{{ url('files') . "/" . $tv["logo"]["hash"] . '/' . $tv["logo"]["name"] . "?s=16"}}" alt = "{{$tv["title"]}}" class = "">
			              @endif
			              {{$tv["title"]}}
			              </a>
			            </p>
		            @endforeach
         		@else
         			<p>@lang('main.homepage_no_records')</p>
		        @endif
          </div>
      </div>
			
			@php 
      	$banners = Banner::bannersByPosition("left_before_links",10);
      @endphp
      @if($banners)
				<div class="wrapper-banner">
				@foreach($banners as $banner)
      		@if($banner["html"] || $banner["image"])
					<div class="banner">
						@if($banner["link"])
							<a href="{{$banner["link"]}}">
						@endif
						@if($banner["html"])
							{!!$banner["html"]!!}
						@elseif($banner["image"])
							<img style="max-width: 100%;" src = "{{ url('files') . "/" . $banner["image"]["hash"] . '/' . $banner["image"]["name"] . ""}}" alt = "" class = "">
						@endif
						@if($banner["link"])
								</a>
							@endif
					</div>
					@endif
      	@endforeach
				</div>
			@endif
			@if($leftLinks)
				<div class="siteslist">
	        @foreach($leftLinks as $leftLinkHeadline)
            <h3 class="sitelist-header">{{$leftLinkHeadline["title"]}}</h3>
            @if($leftLinkHeadline["links"])
            	@foreach($leftLinkHeadline["links"] as $link)
                <a target="_blank"  href="{{$link["link"]}}">{{$link["title"]}}</a>
              @endforeach
            @endif
	        @endforeach
        </div>
      @endif
      @php 
      	$banners = Banner::bannersByPosition("left_after_links",10);
      @endphp
      @if($banners)
				<div class="wrapper-banner">
				@foreach($banners as $banner)
      		@if($banner["html"] || $banner["image"])
					<div class="banner">
						@if($banner["link"])
							<a href="{{$banner["link"]}}">
						@endif
						@if($banner["html"])
							{!!$banner["html"]!!}
						@elseif($banner["image"])
							<img style="max-width: 100%;" src = "{{ url('files') . "/" . $banner["image"]["hash"] . '/' . $banner["image"]["name"] . ""}}" alt = "" class = "">
						@endif
						@if($banner["link"])
								</a>
							@endif
					</div>
					@endif
      	@endforeach
				</div>
			@endif
  </div>