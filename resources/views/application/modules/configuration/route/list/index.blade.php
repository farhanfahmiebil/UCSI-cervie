@extends(Config::get('routing.application.modules.configuration.layout').'.structure.routing')

@section('main-content')

  <!-- row -->
  <div class="row">

    <!-- col -->
    <div class="col-md-12">

      <!-- table responsive -->
      <div class="table-responsive-sm">

        <!-- table -->
        <table class="table-xs table-bordered">

          <!-- thead -->
          <thead class="thead-light">
            <tr>
              <th class="col-md-3">Route</th>
              <th class="col-md-12">Controller</th>
              <th>Name</th>
            </tr>
          </thead>
          <!-- end thead -->

          <!-- tbody -->
          <tbody>

            {{-- Check Data Main --}}
            @if($data['main'])

              {{-- Get Data Main --}}
              @foreach($data['main'] as $key=>$value)

                <tr>
                  <td>{{ $value->uri }}</td>
                  <td>{{ ((isset($value->action['controller']))?$value->action['controller']:'-') }}</td>
                  <td>{{ (isset($value->action['as'])?$value->action['as']:'-') }}</td>
                </tr>

              @endforeach
              {{-- Get Data Main --}}

            @endif
            {{-- End Check Data Main --}}

          </tbody>
          <!-- end tbody -->

        </table>
        <!-- end table -->

      </div>
      <!-- end table responsive -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

@endsection
