{{-- Get Navigation Category --}}
@foreach($data['navigation']['category']['main'] as $key=>$value)

  <!-- tab pane -->
  <div class="tab-pane fade {{ ((request()->tab_category == strtolower($value->navigation_category_code))?'show active':'') }}"
       id="{{ request()->tab_category ?? 'default-tab' }}" role="tabpanel">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-12">

                <!-- row -->
                <div class="row justify-content-center mt-5">

                  <!-- content -->
                  <div class="{{ ((!count($data['navigation']['category']['sub']))?'col-12':'col-sm-9 col-12 order-sm-1 order-2') }}">
{{ count($data['navigation']['category']['sub']) }}
                    {{-- Sub Navigation Tab --}}
                    @include($hyperlink['page']['navigation']['main'].'.main.'.request()->tab_category)

                  </div>
                  <!-- end content -->

                  @if(count($data['navigation']['category']['sub'])>1)
                  <!-- content navigation right -->
                  <div class="col-sm-3 col-12 order-sm-2 order-1">


                    {{-- Get Navigation Category --}}
                    @foreach($data['navigation']['category']['main'] as $key=>$value)
                    @endforeach
                    {{-- Sub Navigation Tab Main --}}
                    @include($hyperlink['page']['navigation']['main'].'.tab.content.navigation.right.general_information')




                  </div>
                  <!-- end content navigation right -->
                  @endif

                </div>
                <!-- end row -->

              </div>
              <!-- end col -->

            </div>
            <!-- end row -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end tab pane -->

@endforeach
{{-- End Get Navigation Category --}}
