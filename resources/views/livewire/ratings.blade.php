<div>
    <div class="rating rating-sm rating-half mb-2 w-fit  mx-1 ">
        <div  class="mask mask-star-2 mask-half-1 " aria-label="0.5 star" aria-current="{{$str > 0 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-2 " aria-label="1 star" aria-current="{{$str == 1 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-1 " aria-label="1.5 star"  aria-current="{{$str > 1 && $str < 2? 'true': 'false'}}" ></div>
        <div  class="mask mask-star-2 mask-half-2 " aria-label="2 star" aria-current="{{$str == 2 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-1 " aria-label="2.5 star" aria-current="{{$str > 2 && $str < 3? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-2 " aria-label="3 star" aria-current="{{$str == 3 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-1 " aria-label="3.5 star" aria-current="{{$str > 3 && $str < 4 ?'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-2 " aria-label="4 star" aria-current="{{$str == 4 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-1 " aria-label="4.5 star" aria-current="{{$str > 4 && $str < 5 ? 'true': 'false'}}"></div>
        <div  class="mask mask-star-2 mask-half-2 " aria-label="5 star" aria-current="{{$str == 5  ? 'true': 'false'}}"></div>
    </div>
    {{$str}}
</div>

    {{-- {{$course->rate()}} <br> --}}

