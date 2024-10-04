@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-12 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card body -->
          <div class="card-body">

            <!-- card title -->
            <h4 class="card-title">View Area Interest</h4>
            <!-- end card title -->

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

            <!-- form -->
            <form action="{{ route($hyperlink['page']['update']) }}" method="POST">
              @csrf

              <!-- row 1 -->
              <div class="row">

                <!-- position -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Area Interest</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data['main']->name }}" placeholder="Name">
                  </div>
                </div>
                <!-- end position -->

              </div>
              <!-- end row 1 -->

              <!-- row 4 -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light">Back</a>
                  <input type="hidden" name="area_interest_id" value="{{ $data['main']->area_interest_id }}">
                  <input type="hidden" name="employee_id" value="{{ $data['main']->employee_id }}">
                  <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                  <button type="submit" class="btn btn-danger text-white me-2">Save</button>
                </div>

              </div>
              <!-- end row 4 -->

            </form>
            <!-- end form -->

          </div>
          <!-- card body -->

        </div>
        <!-- end card -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end content -->

  <script type="text/javascript">

    /**************************************************************************************
      Document On Load
    **************************************************************************************/
    $(document).ready(function($){

      /**************************************************************************************
        Session
      **************************************************************************************/
      @if(Session('message'))
        Swal.fire({
          title: "{{ ucwords(Session::get('alert_type')) }}",
          text: "{{ ucwords(Session::get('message')) }}",
          icon: "{{ strtolower(Session::get('alert_type')) }}"
        });
      @endif

    });

  </script>

@endsection
