@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row 1 -->
    <div class="row">

      {{-- Statistic --}}
      @include($page['sub'].'.statistic')

    </div>
    <!-- end row 1 -->

    <!-- row 2 -->
    <div class="row">

      {{-- Publication --}}
      @include($page['sub'].'.publication')

    </div>
    <!-- end row 2 -->

  </div>
  <!-- end content -->

  {{-- Pop Alert --}}
  @include($hyperlink['navigation']['layout']['dashboard']['researcher']['modal']['pop_alert'])

  <script type="text/javascript">

    /**************************************************************************************
      Document On Load
    **************************************************************************************/
    $(document).ready(function($){

      /**************************************************************************************
        Session
      **************************************************************************************/
      @if(Session('message'))
        Swal.fire({
          title: '{{ ucwords(Session::get('alert_type')) }}',
          text: '{{ ucwords(Session::get('message')) }}',
          icon: '{{ strtolower(Session::get('alert_type')) }}'
        });
      @endif

    });
  </script>

@endsection
