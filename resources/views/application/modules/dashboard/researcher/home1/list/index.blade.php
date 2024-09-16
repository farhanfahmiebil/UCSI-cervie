@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-8 col-sm-12 flex-column d-flex stretch-card">

    {{-- Overall Summary --}}
    @include($page['sub'].'.content_statistic')

    {{-- Publication --}}
    @include($page['sub'].'.content_list')

  </div>
  <!-- end content -->


@endsection
