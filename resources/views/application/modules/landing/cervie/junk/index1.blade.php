@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

  <!-- container -->
  <div class="container py-7 py-lg-10">

    <!-- navigation category -->
    <nav class="nav text-center d-flex justify-content-center filter-nav mb-4">
      <button class="is-checked btn-outline-secondary btn m-2 active border-width-2 rounded-pill" data-bs-toggle="pill" data-filter="*" data-bs-target=".isotope-grid">
          All
      </button>

      {{-- Check Data Outlet Menu Category Exist --}}
      @if(count($data['outlet']['menu']['category']['sub']) > 1)

        {{-- Get Data Outlet Menu Category Exist --}}
        @foreach($data['outlet']['menu']['category']['sub'] as $key=>$value)

          <button class="btn-outline-secondary btn m-2 border-width-2 rounded-pill" data-bs-toggle="pill" data-filter="{{ $value->category_sub_id }}" data-bs-target=".isotope-grid">
            {{ $value->category_sub_name }}
          </button>

        @endforeach
        {{-- End Get Data Outlet Menu Category Exist --}}

      @endif
      {{-- End Check Data Outlet Menu Category Exist --}}

    </nav>
    <!-- end navigation category -->

    <!-- category -->
    <div class="row g-2 isotope-grid" data-isotope='{"layoutMode": "masonry"}'>
        <div class="col-sm-6 col-lg-4 food grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="{{ asset('images/testing/4.jpg') }}" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">$6.5</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
        <div class="col-sm-6 col-lg-4 drink grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="{{ asset('images/testing/4.jpg') }}" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">$4.00</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
        <div class="col-sm-6 col-lg-4 drink grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="{{ asset('images/testing/4.jpg') }}" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">Starting $1.5</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->

        <div class="col-sm-6 col-lg-4 food grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="{{ asset('images/testing/4.jpg') }}" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">Glass $6.9 / Bottle $29</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
        <div class="col-sm-6 col-lg-4 food grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="assets/img/1140x480/2.jpg" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">Glass $6.9 / Bottle $29</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
        <div class="col-sm-6 col-lg-4 food grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="assets/img/800x600/3.jpg" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">$8.0</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
        <div class="col-sm-6 col-lg-4 drink grid-item">
            <div class="card-overlay position-relative overflow-hidden">
                <img class="img-fluid" src="assets/img/800x600/4.jpg" alt="..">
                <div class="card-overlay-box overlay-linear position-absolute start-0 top-0 w-100 h-100">
                    <div
                        class="card-overlay-box-content text-white position-relative d-flex h-100 justify-content-end flex-column p-4">
                        <span class="mb-1 h5">Food & Drink</span>
                        <span class="small">$12</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End menu card-col-->
    </div>
  </div>
  <!-- end container -->

  <section class="position-relative border-top">
      <div class="container pt-8 pb-9 pt-lg-9 position-relative z-index-1">
          <div class="row justify-content-between">
              <div class="col-md-6 col-xl-5 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="50">
                  <h1 class="display-4 mb-3">How may we Serve you?</h1>
                  <p class="pe-md-5 pe-lg-8 mb-0 text-muted">
                      Feel free to request reservation for one table or entire space for a large party or
                      event
                  </p>
              </div>
              <div class="col-md-6 col-lg-5">
                  <div class="row row-cols-md-2 mb-3">
                      <div class="col mb-3" data-aos="fade-up" data-aos-delay="50">
                          <h5 class="mb-3">Phone</h5>
                          <p class="lead"><a href="tel:+011234567890">(01) 123 456 7890</a></p>
                      </div>
                      <div class="col mb-3" data-aos="fade-up" data-aos-delay="100">
                          <h5 class="mb-3">Email</h5>
                          <p class="lead">
                              <a href="/cdn-cgi/l/email-protection#fe87918b8c939f9792be9a91939f9790d09d9193"><span><span class="__cf_email__" data-cfemail="f0899f85829d91999cb0949f9d91999ede939f9d">[email&#160;protected]</span></span></a>
                          </p>
                      </div>
                  </div>
                  <div class="row row-cols-md-2">
                      <div class="col" data-aos="fade-up" data-aos-delay="150">
                          <h5 class="mb-3">Opening Hours</h5>
                          <p class="mb-21">Tuesday - <small>10am - 5pm</small></p>
                          <p class="mb-2 border-top border-bottom py-2 mb-0">Sunday - <small>5pm - 11pm</small></p>
                          <p class="mb-0">Monday - <small>Close</small></p>
                      </div>
                      <div class="col" data-aos="fade-up" data-aos-delay="200">
                          <h5 class="mb-3">Reach us</h5>
                          <p class="mb-0">
                              124, Lorem Street, NY
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

@endsection
