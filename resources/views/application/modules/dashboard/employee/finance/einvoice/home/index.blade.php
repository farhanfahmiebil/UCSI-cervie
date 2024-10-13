@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- row -->
<div class="row gx-3">

  {{-- Check Employee Access Module Sub Exist --}}
  @if(count($data['employee']['user']['access']['module']['sub']) > 0)

    {{-- Check Employee Access Module Sub Data--}}
    @foreach($data['employee']['user']['access']['module']['sub'] as $key=>$value)

      <div class="module col-lg-3 col-sm-6 col-12" data-id="">
        <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
          <div class="icon-box xxl me-3">

            <img src="#" alt="" style="width:160px">

          </div>
          <div class="sale-details text-white">
            <h4> <a href="">{{ $value->module_sub_name }}</a></h4>
          </div>
        </div>
      </div>

    @endforeach
    {{-- End Get Employee Access Module Sub Data --}}

  @endif
  {{-- End Check Employee Access Module Sub Exist --}}

</div>
<!-- end row -->

@endsection
