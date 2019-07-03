<div class="wrap logo-and-nav">
  <a href="{{url('/')}}" class="toplogo">
      <img src="{{ asset('/la-assets/img/logo.svg') }}" alt="logo">
  </a>
  <div class="nav-and-baners">
      <div>
          <div id="adaptmenuicon" class="menu__icon">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
          </div>
          @php
	          use App\Models\TopMenu;
	          $menus = TopMenu::where("parent", 0)->orderBy('hierarchy', 'asc')->get();
	        @endphp
	        @if($menus)
	  				<nav id="top-nav" class="top-nav">
              <ul class="main-menu">
            		@foreach($menus as $menu)
		              <li><a class="{{--lastFirstUpper--}}" href="@if(strpos($menu->url, "http") !== false){{$menu->url}}@else{{url($menu->url) }}@endif">{{uclwords($menu->name)}}</a></li>
		            @endforeach
              </ul>
          	</nav>
	        @endif
          @php 
          	use App\Models\Banner;
          	$heroBanner = Banner::bannersByPosition("header", 1);
          	if($heroBanner){ 
          		$heroBanner = reset($heroBanner);
						}
          @endphp
          @if($heroBanner)
						<div class="top-baner">
						@if($heroBanner["html"] || $heroBanner["image"])
						<div class="banner">
							@if($heroBanner["link"])
								<a href="{{$heroBanner["link"]}}">
							@endif
							@if(trim($heroBanner["html"]))
								{!!$heroBanner["html"]!!}
							@elseif($heroBanner["image"])
								<img style="max-width: 100%;" src = "{{ url('files') . "/" . $heroBanner["image"]["hash"] . '/' . $heroBanner["image"]["name"] . ""}}" alt = "" class = "">
							@endif
							@if($heroBanner["link"])
								</a>
							@endif
						</div>
						@endif
					</div>
					@endif
      </div>
      <div class="additional">
          <div class="goroskop">
              <a target="_blank" href="http://orakul.com/horoscope/astrologic/general/aries/today.html" class="lastFirstUpper">@lang('main.header_goroskop')</a>
          </div>
          @php 
          	use App\Models\Tax;
          	$taxi = Tax::taxesByCities();
          	$firstTaxi = null;
          	
          	use Illuminate\Support\Facades\Cookie;
          	$taxiRegionID = Cookie::get('taxi_region_id');
						if(!$taxiRegionID && $taxi){
							$taxiKeys = array_keys($taxi);
							$taxiRegionID = $taxiKeys[0];
						}
          	if($taxi){
          		$firstTaxi = reset($taxi);
          		$firstTaxi = reset($firstTaxi["items"]);
          	}
          	
          @endphp
          
          @if($taxi)        
	          <div class="drop-down-top">
	              {{--<div class="drop-down-rec">
	                  <span class="oil-name">{{$firstTaxi["title"]}} - {{$firstTaxi["phone"]}}</span>
	              </div>--}}
	              <div class="but">
	                  <a href="#" class="lastFirstUpper" onclick="show('oil-more')">@lang('main.homepage_taxi')</a>
	              </div>
	              <div id="oil-more" class="show-more">
	                  <p>@lang('main.header_taxi_region'):
	                  	
		                  <a href="#" class="city-list" onclick="show('list-cities')">
												@foreach($taxi as $key => $item)
													@if($key == $taxiRegionID)<span class="regions_title">{{$item["title"]}}</span>@endif
												@endforeach
											</a>
		                  <div id="list-cities" class = "list-cities-list">
		                  	@foreach($taxi as $key => $item)
													<a data-region_title="{{$item["title"]}}" data-region_id="{{$key}}" href="javascript:;" @if($key == $taxiRegionID)class="activecity"@endif>{{$item["title"]}}</a>
												@endforeach
		                  </div>
	                  </p>
	                  @foreach($taxi as $key => $item)
	                  <table @if($key == $taxiRegionID) style="display:table"; @else style="display:none"; @endif  id="region_taxi_wrapper_{{$key}}" class="region_taxi_wrapper">
	                      <tr>
	                        <td>@lang('main.header_taxi_name')</td>
	                        <td>@lang('main.header_taxi_phone')</td>
	                      </tr>
	                      @foreach($item["items"] as $key => $item2)
							  					<tr>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["title"]}} @if($item2["link"]) </a> @endif</td>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["phone"]}}@if($item2["link"]) </a> @endif</td>
		                      </tr>
	                      @endforeach
	                  </table>
	                  @endforeach
	                  <p><a class="more-button" href="/taxi/">@lang('main.header_taxi_more_link')</a></p>
	              </div>
	          </div>
          @endif
          
          @php 
          	use App\Models\Lawyer;
          	$lawyer = Lawyer::lawyersByCities();
          	$lawyerRegionID = Cookie::get('lawyer_region_id');
						if(!$lawyerRegionID && $lawyer){
							$lawyerKeys = array_keys($lawyer);
							$lawyerRegionID = $lawyerKeys[0];
						}
          @endphp
          
          @if($lawyer)        
	          <div class="drop-down-top">
	              <div class="but">
	                  <a href="#" class="lastFirstUpper" onclick="show('lawyer-more')">@lang('main.homepage_adv')</a>
	              </div>
	              <div id="lawyer-more" class="show-more">
	                  <p>@lang('main.header_adv_region'):
	                  	
		                  <a href="#" class="city-list" onclick="show('list-cities2')">
												@foreach($lawyer as $key => $item)
													@if($key == $lawyerRegionID)<span class="regions_title">{{$item["title"]}}</span>@endif
												@endforeach
											</a>
		                  <div id="list-cities2" class = "list-cities-list">
		                  	@foreach($lawyer as $key => $item)
													<a data-region_title="{{$item["title"]}}" data-region_id="{{$key}}" href="javascript:;" @if($key == $lawyerRegionID)class="activecity"@endif>{{$item["title"]}}</a>
												@endforeach
		                  </div>
	                  </p>
	                  @foreach($lawyer as $key => $item)
	                  <table @if($key == $lawyerRegionID) style="display:table"; @else style="display:none"; @endif  id="region_lawyer_wrapper_{{$key}}" class="region_lawyer_wrapper">
	                      <tr>
	                        <td>@lang('main.header_adv_name')</td>
	                        <td>@lang('main.header_adv_phone')</td>
	                      </tr>
	                      @foreach($item["items"] as $key => $item2)
							  					<tr>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["title"]}} @if($item2["link"]) </a> @endif</td>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["phone"]}}@if($item2["link"]) </a> @endif</td>
		                      </tr>
	                      @endforeach
	                  </table>
	                  @endforeach
	                  <p><a class="more-button" href="/lawyers/">@lang('main.header_adv_more_link')</a></p>
	              </div>
	          </div>
          @endif
          
          @php 
          	use App\Models\Notary;
          	$notary = Notary::notaryByCities();
          	$notaryRegionID = Cookie::get('notary_region_id');
						if(!$notaryRegionID && $notary){
							$notaryKeys = array_keys($notary);
							$notaryRegionID = $notaryKeys[0];
						}
          @endphp
          
          @if($notary)        
	          <div class="drop-down-top">
	              <div class="but">
	                  <a href="#" class="lastFirstUpper" onclick="show('notary-more')">@lang('main.homepage_not')</a>
	              </div>
	              <div id="notary-more" class="show-more">
	                  <p>@lang('main.header_adv_region'):
		                  <a href="#" class="city-list" onclick="show('list-cities3')">
												@foreach($notary as $key => $item)
													@if($key == $notaryRegionID)<span class="regions_title">{{$item["title"]}}</span>@endif
												@endforeach
											</a>
		                  <div id="list-cities3" class = "list-cities-list">
		                  	@foreach($notary as $key => $item)
													<a data-region_title="{{$item["title"]}}" data-region_id="{{$key}}" href="javascript:;" @if($key == $notaryRegionID)class="activecity"@endif>{{$item["title"]}}</a>
												@endforeach
		                  </div>
	                  </p>
	                  @foreach($notary as $key => $item)
	                  <table @if($key == $notaryRegionID) style="display:table"; @else style="display:none"; @endif  id="region_notary_wrapper_{{$key}}" class="region_notary_wrapper">
	                      <tr>
	                        <td>@lang('main.header_not_name')</td>
	                        <td>@lang('main.header_not_phone')</td>
	                      </tr>
	                      @foreach($item["items"] as $key => $item2)
							  					<tr>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["title"]}} @if($item2["link"]) </a> @endif</td>
		                        <td>@if($item2["link"]) <a href="{{$item2["link"]}}"> @endif {{$item2["phone"]}}@if($item2["link"]) </a> @endif</td>
		                      </tr>
	                      @endforeach
	                  </table>
	                  @endforeach
	                  <p><a class="more-button" href="/notaries/">@lang('main.header_not_more_link')</a></p>
	              </div>
	          </div>
          @endif
          
          @php 
          	use App\Models\Data;
          	$currency = Data::getCurrency();
          @endphp
					@if($currency)
	          <div class="drop-down-top">
	              <div class="drop-down-rec">
	                  <span class="money-val doll">{{$currency['usd']['buy']}}@if($currency['usd']['delta'] > 0)<span class="money-up"></span> @elseif($currency['usd']['delta'] < 0) <span class="money-down"></span> @endif</span>
	                  <span class="money-val euro">{{$currency['eur']['buy']}}@if($currency['eur']['delta'] > 0)<span class="money-up"></span> @elseif($currency['eur']['delta'] < 0) <span class="money-down"></span> @endif</span>
	                  <span class="money-val rubl">{{number_format($currency['rub']['buy'], 2)}}@if($currency['rub']['delta'] > 0)<span class="money-up"></span> @elseif($currency['rub']['delta'] < 0) <span class="money-down"></span> @endif</span>
	              </div>
	              <div class="but">
	                  <a href="#" class="lastFirstUpper" onclick="show('money-more')">@lang('main.header_currency')</a>
	              </div>
	              <div id="money-more" class="show-more">
	                  <table>
	                      <tr>
	                          <td></td>
	                          <td>@lang('main.header_currency_buy')</td>
	                          <td>@lang('main.header_currency_sale')</td>
	                          <td>@lang('main.header_currency_nbu')</td>
	                      </tr>
	                      <tr>
	                          <td>USD</td>
	                          <td>{{$currency['usd']['buy']}}</td>
	                          <td>{{$currency['usd']['sale']}}</td>
	                          <td>{{$currency['usd']['nbu']}}</td>
	                      </tr>
	                      <tr>
	                          <td>EUR</td>
	                          <td>{{$currency['eur']['buy']}}</td>
	                          <td>{{$currency['eur']['sale']}}</td>
	                          <td>{{$currency['eur']['nbu']}}</td>
	                      </tr>
	                      <tr>
	                          <td>RUB</td>
	                          <td>{{$currency['rub']['buy']}}</td>
	                          <td>{{$currency['rub']['sale']}}</td>
	                          <td>{{$currency['rub']['nbu']}}</td>
	                      </tr>
	                  </table>
	              </div>
	          </div>
          @endif
          @php 
          	use App\Models\Region;
          	$weatherRegions = Region::where("weather_id", "<>", "")->get();
          	if($weatherRegions){
          		$weatherRegions = $weatherRegions->toArray();
          	}
          	
          	$weatherRegionID = Cookie::get('weather_region_id');
						if(!$weatherRegionID && $weatherRegions){
							$weatherRegionID = $weatherRegions[0]["id"];
						}
          @endphp
          <div class="drop-down-top">
              {{--<div class="drop-down-rec">
                  <span class="weather-ico">
                      <img src="{{ asset('/la-assets/img/weather/010-rain-3.png') }}" alt="rain">
                  </span>
                  <span class="weather-val">+3 &deg;C</span>
              </div>--}}
              <div class="but">
                  <a href="#" class="lastFirstUpper" onclick="show('weather-more')">@lang('main.header_weather')</a>
              </div>
              <div id="weather-more" class="show-more">
                  <p id="weather_region_wrapper">@lang('main.header_adv_region'):
		                  <a href="#" class="city-list" onclick="show('list-cities-weather')">
												@foreach($weatherRegions as $key => $item)
													@if($item["id"] == $weatherRegionID)<span class="regions_title">{{$item["name"]}}</span>@endif
												@endforeach
											</a>
		                  <div id="list-cities-weather" class = "list-cities-list">
		                  	@foreach($weatherRegions as $key => $item)
													<a data-weather_id="{{$item["weather_id"]}}" data-region_title="{{$item["name"]}}" data-region_id="{{$item["id"]}}" href="javascript:;" @if($item["id"] == $weatherRegionID)class="activecity"@endif>{{$item["name"]}}</a>
												@endforeach
		                  </div>
	                  </p>
	               	<div id="SinoptikInformer" class="SinoptikInformer type1c1">
									  <div class="">
									    <div class="">
								        <div id="siCont0" class="siBodyContent">
								          <div class="siLeft" id="weather_si_left">
								            <div id="weatherIco0"></div>
								            <div class="siT" id="siT0"></div>
								          </div>
								          <div class="siInf" id="weather_si_inf">
								            <p>вологість: <span id="vl0"></span></p>
								            <p>тиск: <span id="dav0"></span></p>
								            <p>вітер: <span id="wind0"></span></p>
								          </div>
								        </div>
								      </div>
									  </div>
									</div>
									<div id="more-regions-weather-wrapper">
										<iframe width="300" height="112" scrolling="no" frameborder="0" src="//pinformer.sinoptik.ua/pinformer4.php?lang=ua" marginheight="0" marginwidth="0" id="sinoptik_container" rel="nofollow"></iframe>
									</div>
									<div class="more-regions-weather">
										<a class="more_region_weather" href="javascript:;">
											Більше регіонів
										</a>
									</div>
									<div class="weather_script">
										@foreach($weatherRegions as $key => $item)
											@if($item["id"] == $weatherRegionID)
												<link href="//sinst.fwdcdn.com/css/informers2.css?v=1" rel="stylesheet">
												<script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities={{$item["weather_id"]}}&amp;lang=ua"></script>
											@endif
										@endforeach
									</div>
              </div>
              {{--
              <div id="weather-more" class="show-more">
              	<iframe width="300" height="112" scrolling="no" frameborder="0" src="//pinformer.sinoptik.ua/pinformer4.php?lang=ua" marginheight="0" marginwidth="0" id="sinoptik_container" rel="nofollow"></iframe>
              	<div id="SinoptikInformer" style="width:240px;" class="SinoptikInformer type1c1">
							  <div class="siHeader">
							    <div class="siLh">
							      <div class="siMh">
							        <a onmousedown="siClickCount();" class="siLogo" href="https://ua.sinoptik.ua/" target="_blank" rel="nofollow" title="Погода"> 
							        </a>
							        Погода <span id="siHeader"></span>
							      </div>
							    </div>
							  </div>
							  <div class="siBody">
							    <a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-київ" title="Погода у Києві" target="_blank">
							      <div class="siCity">
							        <div class="siCityName"><span>Київ</span></div>
							        <div id="siCont0" class="siBodyContent">
							          <div class="siLeft">
							            <div class="siTerm"></div>
							            <div class="siT" id="siT0"></div>
							            <div id="weatherIco0"></div>
							          </div>
							          <div class="siInf">
							            <p>вологість: <span id="vl0"></span></p>
							            <p>тиск: <span id="dav0"></span></p>
							            <p>вітер: <span id="wind0"></span></p>
							          </div>
							        </div>
							      </div>
							    </a>
							    <div class="siLinks">Погода на 10 днів від <a href="https://ua.sinoptik.ua/погода-київ/10-днів" title="Погода на 10 днів" target="_blank" onmousedown="siClickCount();">sinoptik.ua</a></div>
							  </div>
							  <div class="siFooter">
							    <div class="siLf">
							      <div class="siMf"></div>
							    </div>
							  </div>
							</div>
							<script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities=303010783&amp;lang=ua"></script>
							
              </div>--}}
          </div>
      </div>
  </div>


</div>