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
            <div class="col-lg-12">
              <div class="nav nav-pills flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                {{-- Check Navigation Category Exist --}}
                {{-- @if(count($access['navigation']['category'])) --}}

                  {{-- Get Navigation Category --}}
                  {{-- @foreach($access['navigation']['category'] as $value) --}}
                  {{-- @endforeach --}}
                  {{-- End Get Navigation Category --}}

                {{-- @endif --}}
                {{-- End Check Navigation Category Exist --}}
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['home'],['employee_id'=> request()->route('employee_id')]) }}" class="nav-link text-danger">Dashboard</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['general_information']) }}" class="nav-link {{ ((Request::segment(3) == 'general' && Request::segment(4) == 'information')?'text-white bg-danger':'text-danger') }}">General Information</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['qualification']) }}" class="nav-link {{ ((Request::segment(3) == 'qualification')?'text-white bg-danger':'text-danger') }}">Qualifications</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['publication']) }}" class="nav-link {{ ((Request::segment(3) == 'publication')?'text-white bg-danger':'text-danger') }}">Publications</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['grant']) }}" class="nav-link {{ ((Request::segment(3) == 'grant')?'text-white bg-danger':'text-danger') }}">Grants</a>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Postgraduate Supervision</button>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['award']) }}" class="nav-link {{ ((Request::segment(3) == 'award')?'text-white bg-danger':'text-danger') }}">Awards</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['stewardship']) }}" class="nav-link {{ ((Request::segment(3) == 'stewardship')?'text-white bg-danger':'text-danger') }}">Stewardships</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['recognition']) }}" class="nav-link {{ ((Request::segment(3) == 'recognition')?'text-white bg-danger':'text-danger') }}">Recognition</a>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Consultancies</button>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['intellectual_property']) }}" class="nav-link {{ ((Request::segment(3) == 'intellectual' && Request::segment(4) == 'property')?'text-white bg-danger':'text-danger') }}">Intellectual Property</a>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Commercialization</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Community Engagement</button>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['linkage']) }}" class="nav-link {{ ((Request::segment(3) == 'linkage' && Request::segment(4) == 'linkage')?'text-white bg-danger':'text-danger') }}">Linkages</a>

              </div>
            </div>
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
