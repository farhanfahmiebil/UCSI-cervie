@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.authorization')

@section('main-content')

  <!-- container -->
  <div class="container">

    <!-- form -->
    <form class="pt-3" action="{{ route($hyperlink['page']['process']) }}"  method="POST">
      {{ csrf_field() }}

      <!-- login box -->
      <div class="login-box rounded-2 p-5">

        <!-- login form -->
        <div class="login-form">

          <!-- logo -->
          <a href="index.html" class="login-logo mb-3 justify-content-center">
            <img src="{{ asset('images/logo/ucsi_education/logo_with_text_color.png') }}" alt="USCI Education Logo" />
          </a>
          <!-- end logo -->

          <!-- title -->
          <h5 class="my-5 text-center">Login to Account.</h5>
          <!-- end title -->

          <!-- error -->
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <!-- end error -->

          <!-- email -->
          <div class="mb-3">
            <label class="form-label">Your Employee ID</label>
            <input type="text" name="email" class="form-control" value="" />
          </div>
          <!-- end email -->

          <!-- password -->
          <div class="mb-3">
            <label class="form-label">Your Password</label>
            <input type="password" name="password" class="form-control" value="" />
          </div>
          <!-- end password -->

          <!-- form control -->
          <div class="d-flex align-items-center justify-content-between">

            <!-- <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
              <label class="form-check-label" for="rememberPassword">Remember Me</label>
            </div> -->

            <input type="hidden" name="authorization_token" value="{{ $authorization_token['guard'] }}">
            <input type="hidden" name="authorization_code" value="{{ $authorization_token['database'] }}">
            <!-- <a href="forgot-password.html" class="text-red text-decoration-underline">Lost password?</a> -->
          </div>
          <!-- end form control -->

          <!-- button login -->
          <div class="d-grid py-3">
            <button type="submit" class="btn btn-lg btn-danger">
              Login
            </button>
          </div>
          <!-- end button login -->

        </div>
        <!-- end login form -->

      </div>
      <!-- end login box -->

    </form>
    <!-- end form -->

  </div>
  <!-- end container -->

@endsection
