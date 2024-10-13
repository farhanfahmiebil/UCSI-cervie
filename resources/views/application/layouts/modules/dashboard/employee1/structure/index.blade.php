<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.favicon.index')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.title.index')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.meta.index')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.style.index')

      {{-- Script --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.script.index')

    </head>

    <!-- body -->
    <body>

    <!-- container scroller -->
    <div class="container-scroller">

      {{-- Navigation - Header --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.index')

      <!-- container fluid -->
  		<div class="container-fluid page-body-wrapper">

        <!-- main panel -->
  			<div class="main-panel">
          <!-- content wrapper -->
					<div class="content-wrapper">

            {{-- Main Content --}}
            @yield('main-content')

					</div>
					<!-- end content wrapper -->
          
          {{-- Footer --}}
          @include(Config::get('routing.application.modules.dashboard.employee.layout').'.footer.content.index')

  			</div>
  			<!-- end main panel -->

  		</div>
  		<!-- end container fluid -->

    </div>
		<!-- end container scroller -->

    </body>
    <!-- end body -->

</html>
<!-- end html -->
