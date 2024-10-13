<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.favicon.authorization')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.title.authorization')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.meta.authorization')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.style.authorization')

      {{-- Script --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.script.authorization')

    </head>

    <!-- body -->
    <body class="login-container" id="test">

      {{-- Main Content --}}
      @yield('main-content')

  	</body>
    <!-- end body -->

</html>
<!-- end html -->
