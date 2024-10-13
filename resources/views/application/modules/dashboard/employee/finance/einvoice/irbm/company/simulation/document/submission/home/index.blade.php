@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- row -->
<div class="row gx-3">

  <!-- col -->
  <div class="col-md-12">

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Document Submission Version 1.0 (Non-Signing)
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row">

          <!-- single and Multiple -->
          <a href="{{ route($hyperlink['page']['document']['submission']['single']['signature']['without']) }}" class="module_category col-lg-3 col-sm-6 col-12" data-id="UCSI_GROUP_FINANCE">
            <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
              <div class="icon-box xxl me-3">
                <i class="bi bi-receipt h1 text-white"></i>
              </div>
              <div class="sale-details text-white">
                <h4>Single Document</h4>
                <h6>Send One Or Batch Customer Invoice</h6>
              </div>
            </div>
          </a>
          <!-- end single and Multiple -->

          <!-- document batch -->
          <a href="{{ route($hyperlink['page']['document']['submission']['consolidate']['signature']['without']) }}" class="module_category col-lg-3 col-sm-6 col-12" data-id="UCSI_GROUP_FINANCE">
            <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
              <div class="icon-box xxl me-3">
                <i class="bi bi-receipt h1 text-white"></i>
              </div>
              <div class="sale-details text-white">
                <h4>Document Submission</h4>
                <h6>(Consolidate)</h6>
              </div>
            </div>
          </a>
          <!-- end document batch -->

        </div>
        <!--end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<!-- row -->
<div class="row gx-3">

  <!-- col -->
  <div class="col-md-12">

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Document Submission Version 1.1 (Signing)
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row">

          <!-- single and Multiple -->
          <a href="{{ route($hyperlink['page']['document']['submission']['single']['signature']['with']) }}" class="module_category col-lg-3 col-sm-6 col-12" data-id="UCSI_GROUP_FINANCE">
            <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
              <div class="icon-box xxl me-3">
                <i class="bi bi-receipt h1 text-white"></i>
              </div>
              <div class="sale-details text-white">
                <h4>Single Document</h4>
                <h6>Send One Or Batch Customer Invoice</h6>
              </div>
            </div>
          </a>
          <!-- end single and Multiple -->

          <!-- document batch -->
          <a href="{{ route($hyperlink['page']['document']['submission']['consolidate']['signature']['with']) }}" class="module_category col-lg-3 col-sm-6 col-12" data-id="UCSI_GROUP_FINANCE">
            <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
              <div class="icon-box xxl me-3">
                <i class="bi bi-receipt h1 text-white"></i>
              </div>
              <div class="sale-details text-white">
                <h4>Document Submission</h4>
                <h6>(Consolidate)</h6>
              </div>
            </div>
          </a>
          <!-- end document batch -->

        </div>
        <!--end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->


@endsection
