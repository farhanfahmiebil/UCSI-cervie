<!DOCTYPE html>
<html lang="en">
  <head>

    {{-- Favicon --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.favicon.index')

		{{-- Title --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.title.index')

		{{-- Meta --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.meta.index')

		{{-- CSS --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.css.index')

		{{-- JS --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.header.js.index')

    </script>

  </head>
  <body>

    <!-- container -->
    <div class="container">

      {{-- Main Content --}}
      @yield('main-content')

    </div>
    <!-- end container -->

    {{-- JS --}}
		@include(Config::get('routing.application.modules.configuration.layout').'.footer.js.index')

  </body>

</html>
