<!-- content - navigation left -->
<div class="col-lg-2 col-sm-12 flex-column d-flex stretch-card">

  <!-- row -->
  <div class="row flex-grow">

    <!-- col -->
    <div class="col-sm-12 grid-margin stretch-card">

      <!-- card -->
      <div class="card">

        <!-- card body -->
        <div class="card-body">

          <!-- avatar -->
          <div class="row">
            <div class="col-sm-12">
              <img src="{{ asset('images/avatar/anonymous.png') }}" class="rounded mx-auto d-block img-fluid" alt="anonymous">
            </div>
          </div>
          <!-- end avatar -->

          <!-- researcher profile -->
          <div class="row mt-4">
            <div class="col-lg-12">
              <h3 class="font-weight-bold text-dark">{{ Auth::user()->name }}</h3>
              <h3 class="text-grey">

                {{-- Check Employee Salutation --}}
                @if(isset(Auth::user()->employee) && isset(Auth::user()->employee->salutation))

                  {{-- Count Employee Salutation --}}
                  @if(count(Auth::user()->employee->salutation->getSalutation(['column' => ['employee_id' => Auth::id()]])) >= 1)

                    {{-- Get Employee Salutation Data --}}
                    @foreach(Auth::user()->employee->salutation->getSalutation(['column' => ['employee_id' => Auth::id()]]) as $key => $value)
                        {{ $value->salutation_name }}
                    @endforeach
                    {{-- End Get Employee Salutation Data --}}

                  @endif
                  {{-- End Count Employee Salutation --}}

                @endif
                {{-- End Check Employee Salutation --}}

              </h3>
            </div>

          </div>
          <!-- end researcher profile -->

          <!-- researcher email -->
          <div class="row mt-4">

            <div class="col-lg-12">
              <h3 class="font-weight-bold text-dark"><i class="mdi mdi-email"></i> Email</h3>
              <h6 class="text-grey">{{ Auth::user()->mail }}</h6>
            </div>

          </div>
          <!-- end researcher email -->

          <!-- researcher information -->
          <div class="row mt-4">
            <div class="col-lg-12">
              <h3 class="font-weight-bold text-dark"><i class="mdi mdi-domain"></i> Faculty</h3>
              <h6 class="text-grey">{{ Auth::user()->getResearcher(Auth::id())->organization_name }}</h6>
            </div>
          </div>
          <!-- end researcher information -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

    <div class="col-sm-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <div class="d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Visits Today</h4>
                <div class="dropdown">
                  <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
                  <a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="profileDropdownvisittoday"><i class="mdi mdi-dots-horizontal"></i></a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdownvisittoday">
                    <a class="dropdown-item">
                      <i class="mdi mdi-grease-pencil text-primary"></i>
                      Edit
                    </a>
                    <a class="dropdown-item">
                      <i class="mdi mdi-delete text-primary"></i>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
              <p class="mt-1">Calculated in last 30 days</p>
              <div class="d-lg-flex align-items-center justify-content-between">
                <h1 class="font-weight-bold text-dark">4332</h1>
                <div class="mb-3">
                  <button type="button" class="btn btn-outline-light text-dark font-weight-normal">Day</button>
                  <button type="button" class="btn btn-outline-light text-dark font-weight-normal">Month</button>
                </div>
              </div>
              <canvas id="visitorsToday" width="544" height="272" style="display: block; width: 544px; height: 272px;" class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

</div>
<!-- end content - navigation left -->
