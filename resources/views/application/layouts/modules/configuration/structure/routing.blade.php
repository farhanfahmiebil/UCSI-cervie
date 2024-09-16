<!DOCTYPE html>
<html lang="en">
  <head>

    {{-- Favicon --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.favicon.routing')

		{{-- Title --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.title.routing')

		{{-- Meta --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.meta.routing')

		{{-- CSS --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.css.routing')

    </script>

  </head>
  <body class="bg-light">

    <!-- container -->
    <div class="container-fluid pt-5">

      {{-- Main Content --}}
      @yield('main-content')

    </div>
    <!-- end container -->

  </body>

</html>
