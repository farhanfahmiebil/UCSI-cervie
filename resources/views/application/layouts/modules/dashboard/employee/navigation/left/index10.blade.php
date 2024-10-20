<!-- sidebar wrapper -->
<nav class="sidebar-wrapper">

  <!-- sidebar brand -->
  <div class="brand">
    <a href="index.html" class="logo">
      <img src="{{ asset('images/logo/ucsi_group/logo_bg_transparent_with_text_white.png') }}" class="d-none d-md-block me-4" alt="USCI Hotel" />
      <img src="{{ asset('images/logo/ucsi_group/logo_only_bg_transparent.png') }}" class="d-block d-md-none me-4" alt="USCI Hotel" />
    </a>
  </div>
  <!-- end sidebar brand -->

  <!-- sidebar quicklinks -->
  <div class="sidebar-quick-links">
    <h6 class="fw-light mt-5 mb-3 text-center text-white">
      Quick Links
    </h6>
    <div class="quick-links">
      <a href="{{ route($hyperlink['navigation']['authorization']['employee']['sidebar']['quick_link']['account']['profile']) }}" class="shade-dark" data-bs-toggle="tooltip" data-bs-title="Profile"
        data-bs-custom-class="custom-tooltip-red">
        <i class="bi bi-person-fill"></i>
      </a>
      <a href="#" class="shade-dark" data-bs-toggle="tooltip" data-bs-title="Settings"
        data-bs-custom-class="custom-tooltip-red">
        <i class="bi bi-nut"></i>
      </a>
      <a href="#" class="shade-red" data-bs-toggle="tooltip" data-bs-title="Calendar"
        data-bs-custom-class="custom-tooltip-red">
        <i class="bi bi-calendar4"></i>
      </a>
    </div>
  </div>
  <!-- end sidebar quicklinks -->

  <!-- sidebar menu -->
  <div class="sidebar-menu">

    <!-- sidebar menu scroll -->
    <div class="sidebarMenuScroll">
      <ul>

        <!-- home -->
        <li class="active-page-link">
          <a href="{{ route($hyperlink['navigation']['authorization']['employee']['sidebar']['home']) }}">
            <i class="bi bi-house"></i>
            <span class="menu-text">Home</span>
          </a>
        </li>
        <!-- end home -->

        @php
          $navigation['module'] = false;
        @endphp

        {{-- Check Module Company Exist --}}
        @if(count($access['module']['company']))

          {{-- Get Module Company --}}
          @foreach($access['module']['company'] as $navigation['access']['company']['main'])

            <!-- module company -->
            <li class="pt-3 border-bottom">
              <a href="{{ route($hyperlink['navigation']['authorization']['employee']['sidebar']['home']) }}">
                <i class="{{ $navigation['access']['company']['main']->module_company_icon }}"></i>
                <span class="menu-text">{{ strtoupper($navigation['access']['company']['main']->module_company_name) }}</span>
              </a>
            </li>
            <!-- end module company -->

            {{-- Check Module Main Exist --}}
            @if(count($access['module']['main']) > 0)

              {{-- Get Module Main --}}
              @foreach($access['module']['main'] as $navigation['module']['main'])

                {{-- Check Module Company ID Matched --}}
                @if($navigation['module']['main']->module_company_id == $navigation['access']['company']['main']->module_company_id)

                  <!-- module -->
                  <li class="{{ ((count($access['module']['sub']) >=1 )?'sidebar-dropdown':'') }}">
                    <a href="#">
                      <i class="{{ $navigation['module']['main']->module_icon }}"></i>
                      <span class="menu-text">{{ $navigation['module']['main']->module_name }}</span>
                    </a>

                    <!-- module sub -->
                    <div class="sidebar-submenu">

                      <ul>

                        {{-- Check Module Sub Exist --}}
                        @if(count($access['module']['sub']) >= 1)

                          {{-- Get Module Sub --}}
                          @foreach($access['module']['sub'] as $navigation['module']['sub'])

                            {{-- Check Module ID Matched --}}
                            @if($navigation['module']['main']->module_company_id == $navigation['access']['company']['main']->module_company_id)

                              <!-- module sub -->
                              <li>
                                <a href="{{ route($hyperlink['navigation']['authorization']['employee']['sidebar']['home']) }}">
                                  <i class="{{ $navigation['module']['sub']->module_sub_icon }}"></i>
                                  <span class="menu-text">{{ $navigation['module']['sub']->module_sub_name }}</span>
                                </a>
                              </li>
                              <!-- end module sub -->

                            @endif
                            {{-- End Check Module ID Matched --}}

                          @endforeach
                          {{-- End Get Module Sub --}}

                        @endif
                        {{-- End Check Module Sub Exist --}}

                      </ul>

                    </div>
                    <!-- end module sub -->

                  </li>
                  <!-- end module -->

                @endif
                {{-- End Check Module Main Exist --}}

              @endforeach
              {{-- End Get Module Main --}}

            @endif
            {{-- End Check Module Main Exist --}}

          @endforeach
          {{-- End Get Module Company --}}

        @endif
        {{-- End Check Module Company Exist --}}

        @if(!$navigation['module'])
        @if(in_array(Auth::id(),array('414591','41503','40459','41576','41460','DEVELOPER')))

          <!-- setup -->
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="bi bi-tools"></i>
              <span class="menu-text">Setup</span>
            </a>
            <div class="sidebar-submenu" style="display: none;">
              <ul>

                <!-- user access -->
                <li>
                  <a href="#">Status</a>
                </li>
                <!-- end user access -->

              </ul>
            </div>
          </li>
          <!-- end setup -->

        <!-- security -->
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="bi bi-shield-lock"></i>
            <span class="menu-text">Security</span>
          </a>
          <div class="sidebar-submenu" style="display: none;">
            <ul>

              <!-- user access -->
              <li>
                <a href="#">User Access</a>
              </li>
              <!-- end user access -->

              <!-- access log -->
              <li>
                <a href="#">Access Logs</a>
              </li>
              <!-- end access log -->

            </ul>
          </div>
        </li>
        <!-- end security -->

        @endif


        <!-- user -->
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="bi bi-person-square"></i>
            <span class="menu-text">Users</span>
          </a>
          <div class="sidebar-submenu" style="display: none;">
            <ul>

              <!-- employee -->
              <li>
                <a href="{{route(config('routing.application.modules.dashboard.employee.name').'.users.employee.list')}}">Employee</a>
              </li>
              <!-- end employee -->

            </ul>
          </div>
        </li>
        <!-- end user -->


        <!-- <li class="sidebar-dropdown">
					<a href="#">
						<i class="bi bi-box-seam"></i>
						<span class="menu-text">UI Elements</span>
						<span class="badge red">250+</span>
					</a>
					<div class="sidebar-submenu" style="display: none;">
						<ul>
							<li>
								<a href="accordions.html">Accordions</a>
							</li>
							<li>
								<a href="alerts.html" class="current-page">Alerts</a>
							</li>
							<li>
								<a href="buttons.html">Buttons</a>
							</li>
							<li>
								<a href="badges.html">Badges</a>
							</li>
							<li>
								<a href="cards.html">Cards</a>
							</li>
							<li>
								<a href="advanced-cards.html">Advanced Cards</a>
							</li>
							<li>
								<a href="carousel.html">Carousel</a>
							</li>
							<li>
								<a href="dropdowns.html">Dropdowns</a>
							</li>
							<li>
								<a href="icons.html">Icons</a>
							</li>
							<li>
								<a href="list-items.html">List Items</a>
							</li>
							<li>
								<a href="modals.html">Modals</a>
							</li>
							<li>
								<a href="offcanvas.html">Off Canvas</a>
							</li>
							<li>
								<a href="progress.html">Progress Bars</a>
							</li>
							<li>
								<a href="spinners.html">Spinners</a>
							</li>
							<li>
								<a href="tabs.html">Tabs</a>
							</li>
							<li>
								<a href="tooltips.html">Tooltips</a>
							</li>
							<li>
								<a href="typography.html">Typography</a>
							</li>
						</ul>
					</div>
				</li> -->
        @endif

      </ul>
    </div>
    <!-- end sidebar menu scroll -->

  </div>
  <!-- end sidebar menu -->

</nav>
<!-- end sidebar wrapper -->
