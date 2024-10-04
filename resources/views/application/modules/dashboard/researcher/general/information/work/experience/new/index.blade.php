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
            <h4 class="card-title">New Work Experience</h4>
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
            <form action="{{ route($hyperlink['page']['create']) }}"  enctype="multipart/form-data" method="POST">
              @csrf

              <!-- row 1 -->
              <div class="row">

                <!-- company name -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Name">
                  </div>
                </div>
                <!-- end company name -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- designation -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}" placeholder="Position Name">
                  </div>
                </div>
                <!-- end designation -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- year start -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="year_start">Year Start <small>(Example:20XX)</small></label>
                    <input type="text" class="form-control" id="year_start" name="year_start" value="{{ old('year_start') }}" placeholder="YYYY">
                  </div>
                </div>
                <!-- end year start -->

                <!-- year end -->
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="d-flex bd-highlight">
                      <div class="flex-grow-1 bd-highlight">
                        <label for="year_end">Year End
                          <small>(Example:20XX)</small>
                        </label>
                      </div>
                      <div class="bd-highlight">
                        <label for="is_working_here" class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="is_working_here" value="1" {{ old('is_working_here') ? 'checked' : ''}}>
                          Currently Working Here
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>

                    <input type="text" class="form-control" id="year_end" name="year_end" value="{{ old('year_end') }}" placeholder="YYYY">
                  </div>
                </div>
                <!-- end year end -->

              </div>
              <!-- end row 3 -->

              <hr>

              <!-- card title -->
              <h4 class="card-title">Evidence</h4>
              <!-- end card title -->

              <!-- row 4 -->
              <div class="row">

                <!-- file upload -->
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="file" class="form-label">File Upload (.pdf)</label>
                    <input class="form-control" type="file" name="file" id="file">
                  </div>

                </div>
                <!-- end file upload -->

              </div>
              <!-- end row 4 -->

              <!-- row 5 -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light">Back</a>
                  <input type="hidden" name="form_token" value="{{ $form_token['create'] }}">
                  <button type="submit" class="btn btn-danger text-white me-2">Create</button>
                </div>
              </div>
              <!-- end row 5 -->

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
    $(document).ready(function() {

      /*  Year Start
      **************************************************************************************/
      $('#year_start').on('input', function() {
        // Validate Year
        validateYear({
          'input': {
            'id': $(this).attr('id'),
            'year': $(this).val()
          }
        });
      });

      /*  Year End
      **************************************************************************************/
      $('#year_end').on('input', function() {
        // Validate Year
        validateYear({
          'input': {
            'id': $(this).attr('id'),
            'year': $(this).val()
          }
        });
      });

      /*  Validate Year
      **************************************************************************************/
      function validateYear(data) {
        // Regular expression to match a 4-digit year
        var year_pattern = /^\d{0,4}$/; // Allows 0 to 4 digits

        // Check if the input matches the pattern
        if (!year_pattern.test(data.input.year)) {
          // If invalid, remove the last character
          $('#' + data.input.id).val(data.input.year.slice(0, -1));
        }

        // Optional: Check for valid year range
        if (data.input.year.length === 4) {
          var year_value = parseInt(data.input.year, 10);
          if (year_value < 1900 || year_value > 2100) {
            alert('Please enter a year between 1900 and 2100.');
            $('#' + data.input.id).val(''); // Clear the input if it's out of range
          }
        }
      }

    });
  </script>

@endsection
