<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  {{-- Favicon --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.favicon.index')

  {{-- Title --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.title.index')

  {{-- Meta --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.meta.index')

  {{-- Style --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.style.index')

  {{-- Script --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.script.index')

</head>

  <!-- body -->
  <body data-spy="scroll" data-target=".navbar-nav" data-offset="90">

    <!-- laoder -->
    <div class="loader" id="loader-fade">
      <div class="loader-container">
        <div class="circle"></div>
      </div>
    </div>
    <!-- end laoder -->

    {{-- Navigation - Header --}}
    @include(Config::get('routing.application.modules.landing.cervie.layout').'.navigation.header.index')

    {{-- Main Content --}}
    @yield('main-content')


    {{-- Navigation - Footer --}}
    @include(Config::get('routing.application.modules.landing.cervie.layout').'.footer.content.index')



    <!--Animated Cursor-->
    <div id="animated-cursor">
        <div id="cursor">
            <div id="cursor-loader"></div>
        </div>
    </div>
    <!--Animated Cursor End-->

    {{-- Script --}}
    @include(Config::get('routing.application.modules.landing.cervie.layout').'.footer.script.index')

  </body>
  <!-- end body -->

</html>
<!-- end html -->
