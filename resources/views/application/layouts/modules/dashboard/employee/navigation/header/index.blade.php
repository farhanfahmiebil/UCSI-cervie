<!-- page header -->
<div class="page-header">

  <!-- toggle sidebar -->
  <div class="toggle-sidebar" id="toggle-sidebar">
    <i class="bi bi-list"></i>
  </div>
  <!-- end toggle sidebar -->

  <!-- header actions container -->
  <div class="header-actions-container">

    {{-- Search
    @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.search') --}}

    {{-- Announcement
    @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.announcement') --}}

    {{-- Message
    @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.message') --}}

    <!-- end header profile -->
    <div class="header-profile d-flex align-items-center">
      <div class="dropdown">
        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
          <span class="user-name d-none d-md-block">{{ Auth::user()->name }}</span>
          <span class="avatar">
            <img class="border border-secondary border-3" src="{{ asset(Auth::user()->getAvatar()) }}" alt="Admin Panel" />
            <span class="status online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
          <div class="header-profile-actions">
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['profile']) }}">Profile</a>
            <!-- <a href="account-settings.html">Settings</a> -->
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['logout']) }}">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- end header profile -->

  </div>
  <!-- end header actions container -->

</div>
<!-- end page header -->
