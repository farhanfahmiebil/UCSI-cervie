<!-- content - right -->
<div class="col-lg-2 col-sm-12 flex-column d-flex stretch-card content-navigation-right">

  <!-- row -->
  <div class="row flex-grow">

    <!-- col -->
    <div class="col-sm-12 grid-margin stretch-card">

      <!-- card -->
      <div class="card">

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row">

            <!-- col -->
            <div class="col-lg-12">

              <!-- nav pill -->
              <div class="nav nav-pills flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                {{-- Check Navigation Category Exist --}}
                @if(count($access['navigation']['category']))

                  {{-- Get Navigation Category --}}
                  @foreach($access['navigation']['category'] as $value)

                    @php
                      // Lowercase and explode category
                      $category = explode('_', strtolower($value->navigation_category_code));

                      // Determine the route
                      $route = isset($hyperlink['navigation']['authorization']['researcher']['sidebar']['right'][strtolower($value->navigation_category_code)])
                        ?route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right'][strtolower($value->navigation_category_code)])
                        :'#';

                      // Determine background class
                      $navigation_category['is_active'] = (Request::segment(3) == $category[0] && (count($category) == 1 || Request::segment(4) == $category[1]));
                      $navigation_category['card'] = $navigation_category['is_active']?'bg-danger text-white':'shadow-sm bg-light rounded border border-light';
                      $navigation_category['icon'] = $navigation_category['is_active']?'btn-light':'btn-primary';
                      $navigation_category['label'] = $navigation_category['is_active']?'text-white':'text-dark';
                    @endphp

                    <a href="{{ ((!empty($value->route))?route($value->route):'') }}" class="card mt-3 w-100 text-decoration-none {{ $navigation_category['card'] }}">
                      <div class="card-body p-3 my-3 d-flex align-items-center">
                        <button class="btn btn-rounded btn-icon {{ $navigation_category['icon'] }}">
                          <i class="{{ $value->navigation_category_icon }}"></i>
                        </button>
                        <h4 class="card-title mb-0 ms-1 {{ $navigation_category['label'] }}">{{ $value->navigation_category_name }}</h4>
                      </div>
                    </a>

                  @endforeach
                  {{-- End Get Navigation Category --}}

                @endif
                {{-- End Check Navigation Category Exist --}}

              </div>
              <!-- end nav pill -->

            </div>
            <!-- end col -->

          </div>
          <!-- end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

</div>
<!-- end content - right -->
