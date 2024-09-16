@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  {{-- Overall Summary --}}
  @include($page['sub'].'.content_statistic')

  {{-- Publication --}}
  @include($page['sub'].'.content_list')

<script type="text/javascript">

  $(document).ready(function(){

    /**************************************************************************************
      Session
    **************************************************************************************/
    @if(Session('message'))

    Swal.fire({
      title: "{{ ucwords(Session::get('alert_type')) }}",
      text: "{{ ucwords(Session::get('message')) }}",
      icon: "{{Session::get('alert_type')}}",
      confirmButtonColor: "#ee5b5b"

    });

    @endif

  });

</script>

@endsection