@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  {{-- Overall Summary --}}
  @include($page['sub'].'.content_statistic')

  {{-- Publication --}}
  @include($page['sub'].'.content_list')

@endsection
