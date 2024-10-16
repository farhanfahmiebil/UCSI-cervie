@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row 1 -->
    <div class="row">

      {{-- Patent --}}
      @include($page['sub'].'.patent')

    </div>
    <!-- end row 1 -->

    <!-- row 2 -->
    <div class="row">

      {{-- Licensing
      @include($page['sub'].'.licensing') --}}

    </div>
    <!-- end row 2 -->

    <!-- row 3 -->
    <div class="row">

      {{-- Copyright
      @include($page['sub'].'.copyright') --}}

    </div>
    <!-- end row 3 -->

    <!-- row 4 -->
    <div class="row">

      {{-- Trademark
      @include($page['sub'].'.trademark') --}}

    </div>
    <!-- end row 4 -->

  </div>
  <!-- end content -->

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
