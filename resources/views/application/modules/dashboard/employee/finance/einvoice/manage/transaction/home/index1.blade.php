@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- row -->
<div class="row gx-3">

  {{-- Check Module Company Exist --}}
  @if(count($data['company']['einvoice']['api']['available']))

    {{-- Get Employee Access Module --}}
    @foreach($data['company']['einvoice']['api']['available'] as $key=>$value)

      <div class="module_company col-lg-3 col-sm-6 col-12" data-id="{{ $value->company_id }}">
        <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">

            <div class="col-2 icon-box sm">
              @php


              @endphp


            </div>
            <div class="col-6 sale-details text-white">
              <h4>{{ $value->company_name }}</h4>
            </div>
        </div>
      </div>

    @endforeach
    {{-- End Get Module Company Exist --}}

    <!-- user access -->
    <div class="user_access col-12 d-none">

      <div class="card">

        <div class="card-body">

          <!-- spinner -->
          <div class="loader row justify-content-center d-none">
            <div class="spinner-border text-red" role="status"></div>
          </div>
          <!-- end spinner -->

          <!-- row -->
          <div class="result row d-none"></div>
          <!-- end row -->

        </div>

      </div>

    </div>
    <!-- end user access -->
  @else

    <div class="col-lg-12 col-sm-12 col-12">
      <div class="stats-tile d-flex align-items-center position-relative tile-primary">
        <div class="icon-box xxl me-3">
          <i class="bi bi-x-circle-fill font-3x text-white align-content-end"></i>
        </div>
        <div class="sale-details text-white pt-2">
          <h5>There is No Module Assigned By You. Please Contact CSD.</h5>
        </div>
      </div>
    </div>

  @endif
  {{-- End Check Employee Access Module Exist --}}

</div>
<!-- end row -->


@endsection
