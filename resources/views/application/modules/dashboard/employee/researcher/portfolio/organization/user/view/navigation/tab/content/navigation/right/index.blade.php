{{-- Get Navigation Category Sub --}}
@foreach($data['navigation']['category']['sub'] as $key=>$value)

  <!-- stats tile -->
  <a href="#" class="stats-tile d-flex align-items-center {{ ((request()->segment('13') == strtolower($value->navigation_category_sub_code))?'tile-red':'border') }}">

    <!-- icon -->
    <div class="sale-icon icon-box md rounded-5 me-3 border">
      <i class="{{ $value->navigation_category_sub_icon }} font-2x {{ ((request()->segment('13') == strtolower($value->navigation_category_sub_code))?'text-red':'text-dark') }}"></i>
    </div>
    <!-- end icon -->

    <!-- title -->
    <div class="sale-details {{ ((request()->segment('13') == strtolower($value->navigation_category_sub_code))?'text-white':'text-dark') }}">
      <h5>{{ $value->navigation_category_sub_name }}</h5>
    </div>
    <!-- end title -->

  </a>
  <!-- End stats tile -->

@endforeach
{{-- End Get Navigation Category Sub --}}
