@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">

<!-- card header -->
<div class="card-header">
  <h3>
    <i class="bi bi-check-circle-fill text-success"></i> Data Has Been Syncronized
  </h3>
</div>
<!-- end card header -->

<!-- error -->
@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<!-- end error -->

<!-- card body -->
<div class="card-body">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-12">

        <!-- table responsive -->
        <div class="table-responsive">

          <!-- table -->
          <table class="table">

            <!-- thead -->
            <thead>
              <tr>

                {{-- Check Data Column Exist --}}
                @if(count($data['column']) >= 1)

                  {{-- Get Data Column Exist --}}
                  @foreach($data['column'] as $value)
                    <th>{{ $value }}</th>
                  @endforeach
                  {{-- End Get Data Column Exist --}}

                @endif
                {{-- End Check Data Column Exist --}}

              </tr>
            </thead>
            <!-- end thead -->

            <!-- tbody -->
            <tbody>
              <tr>

                @php

                  //Set Synchronize Status
                  $synchronize['status'] = 0;

                @endphp

                {{-- Check Data Main Exist --}}
                @if(count($data['main']) >= 1)

                  {{-- Get Data Main Exist --}}
                  @foreach($data['main'] as $key=>$value)

                    {{-- Check Key Matched Synchronize --}}
                    @if($key == 'synchronize')

                      @php

                        //Set Synchronize Status
                        $synchronize['status'] = $value;

                      @endphp

                      <td class="text-center">

                        {{-- Check Synchronize True --}}
                        @if($value == 1)
                          <i class="bi bi-check-circle-fill font-2x text-success"></i>

                        {{-- Check Synchronize False --}}
                        @else
                          <i class="bi bi-x-circle-fill font-2x text-danger"></i>
                        @endif
                        {{-- End Check Synchronize True --}}

                      </td>

                    @else
                      <td>{{ $value }}</td>
                    @endif
                    {{-- End Check Key Matched Synchronize --}}

                  @endforeach
                  {{-- End Get Data Main Exist --}}

                @endif
                {{-- End Check Data Main Exist --}}

              </tr>
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

  </div>
  <!-- end card body -->

</div>
<!-- end card -->

<!-- control -->
<div class="d-flex gap-2 justify-content-end">
  <input type="hidden" name="name" value="{{ $data['search'] }}">
  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-dark">Back to List</a>
</div>
<!-- end control -->

@endsection
