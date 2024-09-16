@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.authorization')

@section('main-content')

  <!-- container scroller -->
  <div class="container-scroller">

    <!-- container fluid -->
    <div class="container-fluid page-body-wrapper full-page-wrapper">

      <!-- content wrapper -->
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="{{ asset('images/logo/ucsi_education/logo_with_text_color.png') }}" alt="logo">
              </div>
              <h4>Welcome back!</h4>

              <h6 class="font-weight-light">Happy to see you again!</h6>

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

              <form class="pt-3" action="{{ route($hyperlink['page']['process']) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputEmail">Employee ID / Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="email" name="email" value="" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" class="form-control" value="" />
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                  <input type="hidden" name="authorization_token" value="{{ $authorization_token['guard'] }}">
                  <input type="hidden" name="authorization_code" value="{{ $authorization_token['database'] }}">
                  <input type="hidden" name="user_type" value="Researcher">
                  <button type="submit" class="btn btn-block btn-danger text-white btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
                <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register-2.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">© UCSI University {{ Carbon\Carbon::now()->format("Y") }}  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- end content wrapper -->

    </div>
    <!-- end container fluid -->

  </div>
  <!-- end container scroller -->

@endsection
