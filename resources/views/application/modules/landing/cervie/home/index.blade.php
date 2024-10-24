@extends(Config::get('routing.application.modules.landing.cervie.layout').'.structure.index')

@section('main-content')

  {{-- Welcome --}}
  @include($page['sub'].'welcome')

  {{-- Introduction --}}
  @include($page['sub'].'introduction')

  {{-- Banner --}}
  @include($page['sub'].'banner')

  {{-- Achievement --}}
  @include($page['sub'].'achievement')

  {{-- Organization --}}
  @include($page['sub'].'organization')

  {{-- Researcher --}}
  @include($page['sub'].'researcher')

@endsection
