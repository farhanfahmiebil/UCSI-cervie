@extends(Config::get('routing.application.modules.error.layout').'.structure.index')

@section('page-title')
 Error 500
@endsection

@section('main-content')

  <!-- section -->
  <section class="position-relative overflow-hidden bg-white">

    <!-- container -->
    <div class="container pt-11 pb-8 position-relative z-index-1">

      <!-- row -->
      <div class="row pb-5 justify-content-center align-items-center">

        <!-- col -->
        <div class="col-12 col-lg-8 text-center position-relative">

          <!-- content -->
          <div class="position-relative pb-4">

            <!-- content position -->
            <div class="position-relative z-index-1">

              <!-- title -->
              <h3 class="text-primary">Error</h3>
              <!-- end title -->

              <!-- error code -->
              <h1 class="mb-2 fw-bolder" style="font-size: 10rem;">500</h1>
              <!-- end error code -->

              <!-- description -->
              <h2 class="mb-4 fs-1">Not Implemented</h2>
              <!-- end description -->

              <!-- information -->
              <p class="mb-4 px-lg-8">We're sorry but it looks<br />is not implemented yet.</p>
              <!-- end information -->

            </div>
            <!-- end content position -->

            <!-- hyperlink to home -->
            <div class="pt-4">
              <a href="#" class="btn btn-primary">
                  Back to Home</a>
            </div>
            <!-- end hyperlink to home -->

          </div>
          <!-- end content -->

        </div>
        <!-- end col -->

      </div>
      <!-- end row -->

    </div>
    <!-- end container -->

  </section>
  <!-- end section -->

@endsection
