@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  {{-- Overall Summary --}}
  @include($page['sub'].'.content_summary')

  {{-- Researcher Summary --}}
  @include($page['sub'].'.content_researcher_summary')

  {{-- Publication --}}
  @include($page['sub'].'.content_publication')

@endsection
