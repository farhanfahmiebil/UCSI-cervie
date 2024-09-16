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

    <!-- page wrapper -->
		<div class="page-wrapper">

      {{-- Navigation - Header --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.index')

			<!-- main container -->
			<div class="main-container">

        {{-- Navigation - Left --}}
        @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.left.index')

				<!-- content wrapper scroll -->
				<div class="content-wrapper-scroll">

          {{-- Breadcrumb --}}
					@include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.content.breadcrumb')

					<!-- content wrapper -->
					<div class="content-wrapper">

            {{-- Main Content --}}
            @yield('main-content')

					</div>
					<!-- end content wrapper -->

				</div>
				<!-- end content wrapper scroll -->

        {{-- Footer --}}
        @include(Config::get('routing.application.modules.dashboard.employee.layout').'.footer.content.index')

			</div>
			<!-- end main container -->

		</div>
		<!-- end page wrapper -->

    {{-- Script --}}
    @include(Config::get('routing.application.modules.dashboard.employee.layout').'.footer.script.index')

    </body>
    <!-- end body -->

</html>
<!-- end html -->
