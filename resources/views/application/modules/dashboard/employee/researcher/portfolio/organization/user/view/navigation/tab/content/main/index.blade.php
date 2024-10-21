@php
$value = collect($data['navigation']['category']['main'])->first(function ($item) {
    return in_array(strtolower($item->navigation_category_code), [request()->segment(11), request()->segment(11).'_'.request()->segment(12)]);
});
@endphp

<!-- tab pane -->
<div class="tab-pane fade {{ $value ? 'show active' : 'show' }}" id="{{ request()->tab_category ?? 'default-tab' }}" role="tabpanel">

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

                  {{-- If Navigation Category Sub Exist --}}
                  @if(count($data['navigation']['category']['sub']) > 1)

                    {{-- Sub Navigation Tab Pointer --}}
                    @include($page['navigation']['tab']['pointer'])

                  @endif
                  {{-- End If Navigation Category Sub Exist --}}

                </div>
                <!-- end content -->

                {{-- If Navigation Category Sub Exist --}}
                @if(count($data['navigation']['category']['sub'])>1)

                  <!-- content navigation right -->
                  <div class="col-sm-3 col-12 order-sm-2 order-1">

                    {{-- Sub Navigation Tab Right --}}
                    @include($page['navigation']['tab']['right'])

                  </div>
                  <!-- end content navigation right -->

                @endif
                {{-- End If Navigation Category Sub Exist --}}

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
