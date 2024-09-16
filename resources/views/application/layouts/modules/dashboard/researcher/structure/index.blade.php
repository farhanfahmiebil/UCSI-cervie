<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.header.favicon.index')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.header.title.index')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.header.meta.index')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.header.style.index')

      {{-- Script --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.header.script.index')

    </head>

    <!-- body -->
    <body>

    <!-- container scroller -->
    <div class="container-scroller">

      {{-- Navigation - Header --}}
      @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.header.index')

      <!-- container fluid -->
  		<div class="container-fluid page-body-wrapper">

        <!-- main panel -->
  			<div class="main-panel">

          <!-- content wrapper -->
					<div class="content-wrapper">

            <!-- row -->
            <div class="row">

              {{-- Navigation - Content - Left --}}
              @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.content.left')

              <!-- content -->
              <div class="col-lg-8 col-sm-12 flex-column d-flex stretch-card">

                {{-- Main Content --}}
                @yield('main-content')

              </div>
              <!-- end div -->

              {{-- Navigation - Content - Right --}}
              @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.content.right')

            </div>
            <!-- end row -->

					</div>
					<!-- end content wrapper -->

          {{-- Footer --}}
          @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.footer.content.index')

  			</div>
  			<!-- end main panel -->

  		</div>
  		<!-- end container fluid -->

    </div>
		<!-- end container scroller -->

    {{-- Script --}}
    @include(Config::get('routing.application.modules.dashboard.researcher.layout').'.footer.script.index')

  </body>
  <!-- end body -->

</html>
<!-- end html -->
