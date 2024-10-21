<!-- tab header -->
<div class="tab-header">

  <!-- tab previous button -->
  <button class="previous btn btn-dark"><i class="bi bi-chevron-double-left"></i></button>
  <!-- end tab previous button -->

  <!-- tab navigation -->
  <ul class="nav nav-tabs scrollable-nav" id="customTab2" role="tablist">
    @foreach($data['navigation']['category']['main'] as $key=>$value)
      <li class="nav-item" role="presentation">
        <a class="nav-link {{ in_array(strtolower($value->navigation_category_code), [request()->segment(11), request()->segment(11).'_'.request()->segment(12)]) ? 'active' : '' }}"
           id="tab-{{ $value->navigation_category_id }}"
           href="{{ route($hyperlink['page']['back'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}"
           role="tab"
           aria-controls="{{ strtolower($value->navigation_category_id) }}"
           aria-selected="{{ (request()->tab_category == strtolower($value->navigation_category_code) ? 'true' : 'false') }}">
           {{ $value->navigation_category_name }}
        </a>
      </li>
    @endforeach
  </ul>
  <!-- end tab navigation -->

  <!-- tab next button -->
  <button class="next btn btn-dark"><i class="bi bi-chevron-double-right"></i></button>
  <!-- end tab next button -->

</div>
<!-- end tab header -->
