<!-- section -->
<section id="home" class="p-0 particles-version center-block">

  <!-- title -->
  <h2 class="d-none">hidden</h2>
  <!-- end title -->

  <!-- vanta -->
  <div id="vanta_bg" class="bg-overlay bg-gradient"></div>
  <!-- end vanta -->

  <!-- not fullscreen -->
  <div class="not-fullscreen">

    <!-- col -->
    <div class="col-lg-12 text-center center-col">

      <!-- personal box -->
      <div class="personal-box">
        <div class="myphoto1">
          <img src="{{ asset('images/logo/ucsi_education/logo_with_text_color_white.png') }}" alt="image">
        </div>
        <div class="color-white">
          <h2>Welcome to CERVIE</h2>
        </div>
      </div>
      <!-- end personal box -->

    </div>
    <!-- end col -->

  </div>
  <!-- end not fullscreen -->

</section>
<!-- end section -->

{{-- Vanta --}}
@include(Config::get('routing.application.modules.landing.cervie.layout').'.plugin.vanta.index')

<script type="text/javascript">

  VANTA.BIRDS({
    el: "#vanta_bg",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00,
    scale: 1.00,
    scaleMobile: 1.00,
    backgroundColor: 0xd4c7b6,
    backgroundAlpha: 0.23
  })

</script>
