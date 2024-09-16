<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.error.layout').'.header.favicon.index')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.error.layout').'.header.title.index')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.error.layout').'.header.meta.index')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.error.layout').'.header.style.index')

    </head>

    <!-- body -->
    <body class="error-screen" id="test">

      <!-- preloader-->
      <div class="preloader"></div>
      <!-- end preloader -->

      <!-- main -->
      <main id="main" class="pt-5">

        @yield('main-content')

      </main>
      <!-- end main -->

      {{-- Footer --}}
      @include(Config::get('routing.application.modules.error.layout').'.footer.content.index')

      {{-- Script --}}
      @include(Config::get('routing.application.modules.error.layout').'.footer.script.index')

  	</body>
    <!-- end body -->

</html>
<!-- end html -->
