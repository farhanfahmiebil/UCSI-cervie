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
      @include(Config::get('routing.application.modules.error.layout').'.header.style.error')

    </head>

    <!-- body -->
    <body>

      <!-- container -->
      <div class="container"></div>
      <!-- end container -->
      
      @yield('main-content')

  	</body>
    <!-- end body -->

</html>
<!-- end html -->
