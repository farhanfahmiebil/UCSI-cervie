@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-8 col-sm-12 flex-column d-flex stretch-card">

    {{-- Overall Summary --}}
    @include($page['sub'].'.content_summary')

    {{-- Researcher Summary --}}
    @include($page['sub'].'.content_researcher_summary')

    {{-- Publication --}}
    @include($page['sub'].'.content_publication')



  </div>
  <!-- end content -->


@endsection
