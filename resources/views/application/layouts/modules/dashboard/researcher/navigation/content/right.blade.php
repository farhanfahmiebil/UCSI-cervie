<!-- content - right -->
<div class="col-lg-2 col-sm-12 flex-column d-flex stretch-card">

  <!-- row -->
  <div class="row flex-grow">

    <!-- col -->
    <div class="col-sm-12 grid-margin stretch-card">

      <!-- card -->
      <div class="card">

        <!-- card body -->
        <div class="card-body">

          <style media="screen">
            .nav-pills .nav-link{
              padding:1.5rem 1.75rem;
              text-align:left;
            }
          </style>
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
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['general_information'],['employee_id'=> request()->route('employee_id')]) }}" class="nav-link text-danger">General Information</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['qualification'],['employee_id'=> request()->route('employee_id')]) }}" class="nav-link text-danger">Qualifications</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['researcher']['sidebar']['right']['publication'],['employee_id'=> request()->route('employee_id')]) }}" class="nav-link text-danger">Publications</a>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Grants</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Postgraduate Supervision</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Awards</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Recognitions</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stewardships</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Consultancies</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Intellectual Property</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Commercialization</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Community Engagement</button>
                <button class="nav-link text-danger" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Linkages</button>

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
