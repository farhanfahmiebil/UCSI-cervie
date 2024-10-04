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
            <h4 class="card-title">View Work Experience</h4>
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

                <!-- company name -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $data['main']->company_name }}" placeholder="Name">
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
                    <input type="text" class="form-control" id="designation" name="designation" value="{{ $data['main']->designation }}" placeholder="Position Name">
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
                    <input type="text" class="form-control" id="year_start" name="year_start" value="{{ $data['main']->year_start }}" placeholder="YYYY">
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
                          <input type="checkbox" class="form-check-input" name="is_working_here" value="1" {{ (($data['main']->is_working_here)?'checked':'') }}>
                          Currently Working Here
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>

                    <input type="text" class="form-control" id="year_end" name="year_end" value="{{ $data['main']->year_end }}" placeholder="YYYY">
                  </div>
                </div>
                <!-- end year end -->

              </div>
              <!-- end row 3 -->

              <!-- row 4 -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light">Back</a>
                  <input type="hidden" name="id" value="{{ $data['main']->work_experience_id }}">
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
            <h4 class="card-title">Evidence</h4>
            <!-- end card title -->

            <!-- row 1 -->
            <div class="row">

              <!-- col -->
              <div class="col-12">

                <!-- table responsive -->
                <div class="table-responsive">

                  <!-- table -->
                  <table class="table">

                    <!-- thead -->
                    <thead>

                      @php

                        //Set Checkbox Status
                        $checkbox['status'] = false;

                      @endphp

                      {{-- Check Table Column Exist --}}
                      @if(isset($data['table']['column']['cervie']['researcher']['evidence']) && count($data['table']['column']['cervie']['researcher']['evidence']) >= 1)

                        {{-- Get Table Column Data --}}
                        @foreach($data['table']['column']['cervie']['researcher']['evidence'] as $key => $value)

                            {{-- Check if the column is of category 'checkbox' --}}
                            @if(isset($value['category']) && $value['category'] == 'checkbox')

                              @php

                                //Set Checkbox Status
                                $checkbox['status'] = true;

                              @endphp

                              <td>{!! $value['checkbox'] !!}</td>

                            @else

                              {{-- Check if 'class' is set and apply it --}}
                              @if(isset($value['class']) && !empty($value['class']))
                                <td class="{{ $value['class'] }}">
                              @else
                                <td>
                              @endif

                                {{-- Output the icon and name --}}
                                {!! isset($value['icon']) ? $value['icon'] : '' !!}
                                {{ isset($value['name']) ? $value['name'] : '' }}

                              </td>

                            @endif
                            {{-- End Check if the column is of category 'checkbox' --}}

                        @endforeach
                        {{-- End Get Table Column Data --}}

                      @else
                        <th>Column Not Defined</th>
                      @endif
                      {{-- End Check Table Column Data Exist --}}

                    </thead>
                    <!-- end thead -->

                    <tbody>
                    {{-- Check Data Document Exist --}}
                    @if($data['document'])

                      @foreach($data['document'] as $key=>$value)

                        <tr id="{{ $value->evidence_id }}">

                          <td>{{ ($key+1) }}</td>
                          <td>{{ $value->file_name.'.'.$value->file_extension }}</td>
                          <td>
                            @if(Storage::exists($asset['document'].$value->file_name.'.'.$value->file_extension))

                              <!-- hyperlink -->
                              <a href="{{ $hyperlink['document'].$value->file_name.'.'.$value->file_extension }}" class="btn btn-primary">
                                <i class="mdi mdi-link"></i>
                              </a>
                              <!-- end hyperlink -->

                              <!-- hyperlink -->
                              <button data-id="{{ $value->table_id }}" class="btn_reupload btn btn-primary">
                                <i class="mdi mdi-upload"></i>
                              </button>
                              <!-- end hyperlink -->

                              <!-- remove file -->
                              <a href="" class="btn btn-danger text-white">
                                <i class="mdi mdi-trash-can"></i>
                              </a>
                              <!-- end remove file -->

                            @else
                            <p>-</p>
                            @endif
                          </td>

                        </tr>

                        <tr id="{{ $value->evidence_id }}_reupload" class="d-none">

                          <td colspan="{{ count($data['table']['column']['cervie']['researcher']['evidence']) }}">
                            <form class="" action="{{ route($hyperlink['page']['reupload']) }}" enctype="multipart/form-data" method="POST">
                              @csrf

                              <div class="form-group">
                                <label for="file" class="form-label">Reupload File No. {{ ($key+1) }}</label>
                                <input class="form-control" type="file" name="file">
                              </div>

                              <div class="form-group text-end">
                                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                                <input type="hidden" name="work_experience_id" value="{{ $data['main']->work_experience_id }}">
                                <button type="button" class="btn_reupload_cancel btn btn-primary" name="button">Cancel</button>
                                <input type="submit" class="btn btn-danger text-white" name="" value="Reupload">
                              </div>

                            </form>
                          </td>
                        </tr>

                      @endforeach

                    @else

                    @endif
                    {{-- End Check Data Document Exist --}}

                    </tbody>

                  </table>
                  <!-- end table -->

                </div>
                <!-- end table responsive -->

              </div>
              <!-- end col -->

            </div>
            <!-- end row 1 -->

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

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-12 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card body -->
          <div class="card-body pb-0">

            <div class="row text-center">

              <form action="{{ route($hyperlink['page']['update']) }}" method="POST">

                <div class="col-12">
                  <div class="">
                    <div class="form-group">
                      <input type="hidden" name="id" value="{{ $data['main']->work_experience_id }}">
                      <input type="hidden" name="form_token" value="{{ $form_token['delete'] }}">
                      <button type="submit" class="btn btn-danger text-white me-2">Delete this Data</button>
                    </div>
                  </div>
                </div>

              </form>

            </div>

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

      var parent_row;

      /**************************************************************************************
        Session
      **************************************************************************************/
      @if(Session('message'))
        Swal.fire({
          title: '{{ ucwords(Session::get('alert_type')) }}',
          text: '{{ ucwords(Session::get('message')) }}',
          icon: '{{ strtolower(Session::get('alert_type')) }}'
        });
      @endif

      /*  Year Start
      **************************************************************************************/
      $('#year_start').on('input',function(){
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
      $('#year_end').on('input',function(){
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

      $('.btn_reupload').on('click', function() {

          // Get Parent Row
          parent_row = $(this).closest('tr').attr('id');

          // Check if Parent Row Exists
          if (parent_row) {

              // Find the target based on the parent row ID
              var target = $('#' + parent_row + '_reupload');

              // Check if the target exists
              if (target.length) {

                  // Toggle the 'd-none' class on the target element
                  target.toggleClass('d-none');

                  // Find the icon inside the button
                  var icon = $(this).find('i');

                  // Toggle between the mdi-upload and mdi-check classes
                  if (icon.hasClass('mdi-upload')) {
                      icon.removeClass('mdi-upload').addClass('mdi-close-box');
                  } else {
                      icon.removeClass('mdi-check').addClass('mdi-upload');
                  }

              } else {
                  console.log('Target element not found: #' + parent_row + '_reupload');
              }

          } else {
              console.log('Parent row ID not found');
          }

      });


      $('.btn_reupload_cancel').on('click',function(){

        console.log(parent_row);

        //Check Parent Row Exist
        if(parent_row){

          // Use jQuery to check and ensure the id exists
          var target = $('#' + parent_row + '_reupload');

          // Check if the target exists and remove the 'd-none' class
          if(target.length){
            target.addClass('d-none');
          }else{
            console.log('Target element not found: #' + parent_row + '_upload');
          }

          // Find the corresponding reupload button in the same row
          var reupload_button = $('#' + parent_row).find('.btn_reupload');

          // Find the icon inside the reupload button and reset it to mdi-upload
          var icon = reupload_button.find('i');
          if (icon.hasClass('mdi-close-box')) {
              icon.removeClass('mdi-close-box').addClass('mdi-upload');
          }

        }else{
          console.log('Parent row ID not found');
        }

        //Set Parent Row Empty
        parent_row = '';

      });


    });
  </script>

@endsection
