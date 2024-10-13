@extends(Config::get('routing.application.modules.dashboard.candidate.layout').'.structure.authorization')

@section('main-content')

  <!-- container wrapper -->
  <div class="content-wrapper d-flex align-items-center auth px-0">

    <!-- row -->
    <div class="row w-100 mx-0">

      <!-- col -->
      <div class="col-lg-4 mx-auto">

        <!-- auth form light -->
        <div class="auth-form-light text-center py-5 px-4 px-sm-5">

          <!-- logo -->
          <div class="brand-logo">
            <img src="{{ asset('images/logo/usci_group/logo_with_text_color.png') }}" alt="logo">
          </div>
          <!-- end logo -->

          <!-- description -->
          <h4>Reset Your Password</h4>
          <h6 class="font-weight-light">Please Enter Your Email</h6>
          <!-- end description -->

          <!-- form -->
          <form class="pt-3">
            <div class="form-group">
              <input type="email" class="form-control form-control-lg" id="email" placeholder="Email">
            </div>
            <div class="mt-3">
              <a class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn text-white" href="../../index.html">Sent Email</a>
            </div>
            <div class="text-center mt-4 font-weight-light">
              Already Remember Your Password? <br>
              <a href="{{ route($hyperlink['page']['login']) }}" class="text-primary">Back to Login</a>
            </div>
          </form>
          <!-- end form -->

        </div>
        <!-- end auth form light -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end container wrapper -->

@endsection
