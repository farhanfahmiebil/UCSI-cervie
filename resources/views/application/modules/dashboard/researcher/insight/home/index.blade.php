@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  {{-- Publication --}}
  @include($page['sub'].'publication')

  {{-- Grant --}}
  @include($page['sub'].'grant')




@endsection
