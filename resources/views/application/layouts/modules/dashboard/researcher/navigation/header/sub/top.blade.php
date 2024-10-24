<!-- top navbar -->
<nav class="navbar top-navbar col-lg-12 col-12 p-0 bg-danger">

  <!-- container fluid -->
  <div class="container-fluid">

    <!-- navbar menu wrapper -->
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

      <ul class="navbar-nav navbar-nav-left">

        <li class="nav-item dropdown  d-lg-flex d-none">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('images/logo/ucsi_education/logo_with_text_color_white.png') }}" alt="logo"></a>
        </li>

      </ul>
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <h3></h3>
      </div>
      <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name text-white">{{ Auth::user()->name }}</span>
              <span class="online-status"></span>
              <img src="{{ asset('images/avatar/anonymous.png') }}" alt="profile">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <!-- <a class="dropdown-item">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a> -->
                <a class="dropdown-item" href="{{ route($hyperlink['navigation']['authorization']['researcher']['header']['account']['logout']) }}">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>

            </div>
          </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
    <!-- end navbar menu wrapper -->

  </div>
  <!-- end container fluid -->

</nav>
<!-- end top navbar -->
