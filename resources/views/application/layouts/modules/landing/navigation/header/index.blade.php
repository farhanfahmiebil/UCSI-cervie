<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-transparent navbar-sticky">

  <!-- container -->
  <div class="container">

    <!-- navbar brand -->
    <a class="navbar-brand" href="index.html">
      <img src="{{ asset('images/logo/ucsi_hotel/index.png') }}" alt="Logo" class="img-fluid">
    </a>
    <!-- navbar brand -->

    @if(!in_array(Request::segment(5),array('register','checkout')))

      @if(!in_array(Request::segment(7),array('register','checkout')))
      <!-- navbar icons -->
      <div class="d-flex align-items-center order-lg-2 navbar-icons">

        <!-- navbar nav -->
        <div class="navbar-nav flex-row align-items-center">

          <div class="nav-item me-lg-0 me-3">
            <a class="nav-icon-link nav-link" href="#offcanvasCart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart">
              <div class="d-flex align-items-center">
                <span>
                  <i id="cart-icon" class="bi bi-cart"></i> Cart
                </span>
                <span class="cart-badge">( <span id="cart-total"></span> )</span>
              </div>
            </a>
          </div>

        </div>
        <!-- end navbar nav -->

      </div>
      <!-- end navbar icons -->

      @endif

    @endif

   <!-- navbar offcanvas lg -->
    <div class="offcanvas offcanvas-end" id="restoMainNavbar">

      <div class="offcanvas-header">
        <button class="btn-close z-index-1" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body">
        <ul class="navbar-nav mx-auto">

          <li class="dropdown nav-item h3">
            <a href="#" class="nav-link">
              <h2>{{ strtoupper($data['outlet']['store']->outlet_name) }}</h2>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <!-- end navbar offcanvas lg -->

  </div>
  <!-- end container -->

</nav>
<!-- end navigation -->
