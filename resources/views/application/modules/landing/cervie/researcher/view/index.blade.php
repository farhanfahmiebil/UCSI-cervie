@extends(Config::get('routing.application.modules.landing.cervie.layout').'.structure.index')

@section('main-content')

  {{-- Introduction --}}
  @include($page['sub'].'introduction')

@endsection
