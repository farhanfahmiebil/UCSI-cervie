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

    <style media="screen">


    </style>
    <!-- body -->
    <body id="bg-vanta" class="login-container">

      {{-- Main Content --}}
      @yield('main-content')

  	</body>
    <!-- end body -->

    <script>
    VANTA.NET({
      el: "#bg-vanta",
      mouseControls: true,
      touchControls: true,
      gyroControls: false,
      minHeight: 200.00,
      minWidth: 200.00,
      scale: 1.00,
      scaleMobile: 1.00,
      color: 0xffb7cc,
      backgroundColor: 0xd71515
    })
    </script>

</html>
<!-- end html -->
