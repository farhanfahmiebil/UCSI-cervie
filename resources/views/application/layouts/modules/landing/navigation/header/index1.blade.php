<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-transparent navbar-sticky">

  <!-- container -->
  <div class="container">

    <!-- navbar brand -->
    <a class="navbar-brand" href="index.html">
      <img src="{{ asset('images/logo/ucsi_hotel/index.png') }}" alt="Logo" class="img-fluid">
    </a>
    <!-- navbar brand -->

    <!-- navbar icons -->
    <div class="d-flex align-items-center order-lg-2 navbar-icons">

      <!-- navbar toggler -->
      <button class="navbar-toggler order-last ms-3 ms-lg-0" type="button" data-bs-toggle="offcanvas"
         data-bs-target="#restoMainNavbar" aria-controls="restoMainNavbar" aria-expanded="false"
         aria-label="Toggle navigation">
         <span class="navbar-toggler-line"></span>
         <span class="navbar-toggler-line-end"></span>
      </button>
      <!-- end navbar toggler -->

      <!-- navbar nav -->
      <div class="navbar-nav flex-row align-items-center">

        <div class="nav-item me-3 me-lg-0">
            <a class="nav-icon-link nav-link " href="login-register.html">SignIn</a>
        </div>

        <div class="nav-item me-lg-0 me-3">
            <a class="nav-icon-link nav-link" href="#offcanvasCart" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasCart">
                <div class="d-flex align-items-center">
                    <span>Bag</span>
                    <span class="cart-badge">(2)</span>
                </div>
            </a>
        </div>

        <div class="position-lg-relative me-4 me-lg-0 nav-item">
          <a data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" class="nav-link">
            <i class="bi bi-search"></i>
          </a>
          <div id="dropdown-search" class="dropdown-menu w-100 position-absolute dropdown-menu-lg-end dropdown-search p-4">

            <h5 class="mb-3">Tell us what you're looking for</h5>

            <form>
              <input type="text" class="form-control form-control-lg" placeholder="Example: Dinner, Wine, Pizza">
              <div class="d-grid pt-2">
                <button type="button" class="btn btn-primary">Search</button>
              </div>
            </form>

            <div class="pt-2">
              <div class="dropdown-header">Popular searches</div>
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#!" class="dropdown-item">Egg & spinach</a>
                </li>
                <li>
                  <a href="#!" class="dropdown-item">Creamy soup</a>
                </li>
                <li>
                  <a href="#!" class="dropdown-item">Crunch veg salad</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
      <!-- end navbar nav -->

    </div>
    <!-- end navbar icons -->

   <!-- navbar offcanvas lg -->
    <div class="offcanvas offcanvas-end" id="restoMainNavbar">
      <div class="offcanvas-header">
        <button class="btn-close z-index-1" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav mx-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link  " data-bs-auto-close="outside" data-bs-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Home </a>
            <ul class="dropdown-menu dropdown-menu-start">
              <li><a class="dropdown-item" href="index.html">Default Parallax</a></li>
              <li><a class="dropdown-item" href="index-video-player.html">Video Player</a></li>
              <li><a class="dropdown-item" href="index-image-slider.html">Image Slider</a>
              </li>
              <li><a class="dropdown-item" href="index-dark-ui.html">Dark UI</a></li>
              <li><a class="dropdown-item" href="one-page.html">One Page</a></li>
              <li class="dropend">
                <a class="dropdown-item" data-bs-toggle="dropdown" data-bs-auto-close="outside" tabindex="-1" href="#">Menu Levels </a>
                <ul class="dropdown-menu">
                  <li class="dropend">
                    <a class="dropdown-item" data-bs-toggle="dropdown" data-bs-auto-close="outside" tabindex="-1" href="#">menu level 2 </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#"> menu level 3</a></li>
                      <li><a class="dropdown-item" href="#"> menu level 3</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Menu </a>
            <ul class="dropdown-menu dropdown-menu-start">
                <li><a class="dropdown-item" href="menu-simple.html">Menu simple</a></li>
                <li><a class="dropdown-item" href="menu-tiles.html">Menu tiles</a></li>
                <li><a class="dropdown-item" href="menu-grid.html">Menu grid</a></li>
            </ul>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link " data-bs-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Blog </a>
            <ul class="dropdown-menu dropdown-menu-start">
                <li><a class="dropdown-item" href="blog-sidebar-end.html">Sidebar end</a></li>
                <li><a class="dropdown-item" href="blog-sidebar-start.html">Sidebar start</a></li>
                <li><a class="dropdown-item" href="blog-masonry.html">Masonry</a></li>
                <li><a class="dropdown-item" href="blog-fullwidth.html">Full width</a></li>
                <li><a class="dropdown-item" href="blog-post.html">Single Page</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link " href="reservation.html">Reservation</a></li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link " data-bs-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Pages</a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="about.html">About</a></li>
                <li><a class="dropdown-item" href="gallery.html">Gallery</a></li>
                <li><a class="dropdown-item" href="contact.html">Contact us</a></li>
                <li><a class="dropdown-item" href="login-register.html">Login Register</a></li>
                <li><a class="dropdown-item" href="page-full-width.html">Page Full Width</a></li>
                <li><a class="dropdown-item" href="page-blank.html">Page blank</a></li>
                <li><a class="dropdown-item" href="error-404.html">Error 404</a></li>

                <li><a class="dropdown-item" href="page-sticky-sidebar.html">sticky sidebar</a></li>
                <li><a class="dropdown-item" href="page-sticky-footer.html">sticky footer </a></li>
                <li><a class="dropdown-item" href="typography.html">Typography</a></li>
                <li><a class="dropdown-item" href="elements.html">Elements</a></li>
            </ul>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link " data-bs-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Shop </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="shop-products.html">Products</a></li>
                <li><a class="dropdown-item" href="shop-checkout.html">Checkout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- end navbar offcanvas lg -->

  </div>
  <!-- end container -->

</nav>
<!-- end navigation -->
