@if ($promos)
    @php
        $countItems = $promos->count();
        $items = $promos->toArray();
        $lastItem = end($items);
    @endphp
    @foreach($promos as $key => $promo)
        <div data-page="{{$page}}" class="promos-image" @if(isset($lastItem['id']) && $promo->id == $lastItem['id']) data-load-more-promos="1" @endif>
            <img src="{{url('/files/' . $promo->image . '')}}" alt="{{$promo->title}}">
        </div>
    @endforeach
@endif
