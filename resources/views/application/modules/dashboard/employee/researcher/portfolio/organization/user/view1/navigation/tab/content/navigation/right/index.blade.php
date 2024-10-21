{{-- Get Navigation Category Sub --}}
@foreach($data['navigation']['category']['sub'] as $key=>$value)

  <!-- stats tile -->
  <div class="stats-tile d-flex align-items-center {{ ((strtolower($value->navigation_category_sub_code) == request()->route('tab_category_sub'))?'tile-red':'border')}}">

    <!-- icon -->
    <div class="sale-icon icon-box md rounded-5 me-3">
      <i class="{{ $value->navigation_category_sub_icon }} font-2x text-red"></i>
    </div>
    <!-- end icon -->

    <!-- title -->
    <div class="sale-details {{ ((strtolower($value->navigation_category_sub_code) == request()->route('tab_category_sub'))?'text-white':'text-dark')}}">
      <h5>{{ $value->navigation_category_sub_name }}</h5>
    </div>
    <!-- end title -->

  </div>
  <!-- End stats tile -->

@endforeach
{{-- End Get Navigation Category Sub --}}
