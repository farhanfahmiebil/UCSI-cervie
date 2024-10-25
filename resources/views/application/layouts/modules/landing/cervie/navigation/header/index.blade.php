<!-- header -->
<header>

  <!-- navbar -->
  <nav class="navbar navbar-top-default navbar-expand-lg static-nav black nav-radius transparent-bg {{ ((request()->segment(1) == 'home')?'bottom-nav':'') }} box-nav not-full no-animation">

    <!-- container -->
    <div class="container radius nav-box-shadow">
      <a class="logo link" href="javascript:void(0)">
        <img src="{{ asset('images/logo/ucsi_education/logo_with_text_color.png') }}" alt="logo" title="Logo">
      </a>
      <div class="collapse navbar-collapse d-none d-lg-block">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item"> <a href="#home" class="scroll nav-link link">Home {{ request()->segment(1) }}</a>
          </li>
          <li class="nav-item"> <a href="#introduction" class="scroll nav-link link">About</a>
          </li>
          <li class="nav-item"> <a href="#achievement" class="scroll nav-link link">Achievement</a>
          </li>
          <li class="nav-item"> <a href="#our_faculties" class="scroll nav-link link">Faculty</a>
          </li>
          <li class="nav-item"> <a href="#researcher" class="scroll nav-link link">Researcher</a>
          </li>
          <li class="nav-item"> <a href="#contact" class="scroll nav-link link">Contact</a>
          </li>
        </ul>
      </div>

      <!-- side menu open button -->
      <a class="menu_bars d-inline-block menu-bars-setting menu-inner" id="sidemenu_toggle">
        <div class="menu-lines">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </a>
    </div>
    <!-- end container -->

  </nav>
  <!-- end navbar -->

  <!-- side menu -->
  <div class="side-menu">
      <div class="inner-wrapper nav-icon">
          <span class="btn-close link" id="btn_sideNavClose"></span>
          <nav class="side-nav w-100">
              <div class="navbar-nav">
                  <a class="nav-link link scroll active" href="#home">Home</a>
                  <a class="nav-link link scroll" href="#introduction">About</a>
                  <a class="nav-link link scroll" href="#achievement">Achievement</a>
                  <a class="nav-link link scroll" href="#our_faculties">Faculty</a>
                  <a class="nav-link link scroll" href="#clients">Clients</a>
                  <a class="nav-link link scroll" href="#researcher">Researcher</a>
                  <a class="nav-link link scroll" href="#contact">Contact</a>
                  <a class="nav-link link" href="/authorization/employee/login">Researcher Login</a>
                  <a class="nav-link link" href="/authorization/employee/login">Employee Login</a>
              </div>
          </nav>

          <div class="side-footer text-white w-100">
              <ul class="social-icons-simple">
                  <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-facebook-f color-white"></i> </a> </li>
                  <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-instagram color-white"></i> </a> </li>
                  <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-twitter color-white"></i> </a> </li>
              </ul>
              <p class="text-white">© UCSI Education {{ Carbon\Carbon::now()->format("Y") }}</p>
          </div>
      </div>
  </div>
  <a id="close_side_menu" href="javascript:void(0);"></a>
  <!-- end side menu -->

</header>
<!-- end header -->
