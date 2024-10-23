@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- form -->
  <form action="{{ route($hyperlink['page']['create']) }}" enctype="multipart/form-data" method="POST">
  @csrf

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
              <h4 class="card-title">Academic Qualification Information</h4>
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

              <!-- row 1 -->
              <div class="row">

                <!-- qualification id -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="qualification_id">Qualification</label>
                    <select class="form-control select2" id="qualification_id" name="qualification_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Qualification Exist --}}
                      @if(count($data['general']['qualification'])>0)

                        {{-- Get General Qualification Data --}}
                        @foreach($data['general']['qualification'] as $key=>$value)
                          <option value="{{ $value->qualification_id }}" {{ ((old('qualification_id') == $value->qualification_id)?'selected':'') }}>{{ $value->qualification_name }}</option>
                        @endforeach
                        {{-- End Get General Qualification Data --}}

                      @endif
                      {{-- End Check General Qualification Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end qualification id -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div id="group_qualification_other" class="row">

                <!-- qualification other -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="qualification_other">Other Qualification (Please Specify)</label>
                    <input type="text" class="form-control" id="qualification_other" name="qualification_other" value="{{ old('qualification_other') }}" placeholder="Other Qualification Name">
                  </div>
                </div>
                <!-- end qualification other -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- institution -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="institution_name">University/College/Other</label>
                    <input type="text" class="form-control" id="institution_name" name="institution_name" value="{{ old('institution_name') }}" placeholder="Name">
                  </div>
                </div>
                <!-- end institution -->

              </div>
              <!-- end row 3 -->

              <!-- row 4 -->
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
                        <label for="is_current_progress" class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="is_current_progress" name="is_current_progress" value="1" {{ old('is_current_progress') ? 'checked' : ''}}>
                          Currently Study
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>

                    <input type="text" class="form-control" id="year_end" name="year_end" value="{{ old('year_end') }}" placeholder="YYYY">
                  </div>
                </div>
                <!-- end year end -->

              </div>
              <!-- end row 4 -->

              {{-- Evidence Need --}}
              @if($data['cervie']['researcher']['table']['control']->evidence_need)

              <hr>

                <!-- card title -->
                <h4 class="card-title">Evidence</h4>
                <!-- end card title -->

                <!-- row 1 -->
                <div class="row">

                  <!-- table responsive -->
                  <div class="table-responsive">

                    <label for="file" class="form-label"><strong>File Upload Must be (.pdf)</strong></label>

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

                      <!-- tbody -->
                      <tbody>
                        <tr>
                          <td class="row-number">1</td>
                          <td>
                            <div class="form-group">
                              <label for="document_name">File Name for Evidence</label>
                              <input type="text" class="form-control" name="document_name[]">
                            </div>
                            <div class="form-group">
                              <input type="file" class="form-control" name="document[]">
                            </div>
                          </td>
                          <td>
                          &nbsp;
                          </td>
                        </tr>
                      </tbody>
                      <!-- end tbody -->

                    </table>
                    <!-- end table -->

                    <div class="row text-center pt-3">

                      <div class="col-12">
                        <button type="button" class="btn btn-primary add-new-file"><i class="mdi mdi-plus"></i>Add New File</button>
                      </div>
                    </div>

                  </div>
                  <!-- end table responsive -->

                </div>
                <!-- end row 1 -->

                <!-- script for dynamic row numbering and file operations -->
                <script type="text/javascript">

                  /**************************************************************************************
                    Document On Load
                  **************************************************************************************/
                  $(document).ready(function(){

                    // Initial check to hide the button if there are already 2 rows
                    checkFileCount();

                    /*  Add New File Row
                    **************************************************************************************/
                    $('.add-new-file').click(function(){

                      // Add a new row to the table
                      var new_row =  '';
                          new_row += '<tr>';
                          new_row += '<td class="row-number"></td>';
                          new_row += '<td>';
                          new_row += '<div class="form-group">';
                          new_row += '<label for="document_name">File Name for Evidence</label>';
                          new_row += '<input type="text" class="form-control" name="document_name[]">';
                          new_row += '</div>';
                          new_row += '<div class="form-group">';
                          new_row += '<input type="file" class="form-control" name="document[]">';
                          new_row += '</div>';
                          new_row += '</td>';
                          new_row += '<td>';
                          new_row += '<a href="#" class="btn btn-danger remove-file">';
                          new_row += '<i class="mdi mdi-trash-can text-white"></i>';
                          new_row += '</a>';
                          new_row += '</td>';
                          new_row += '</tr>';

                      $('table tbody').append(new_row);

                      // Recalculate row numbers and check the file count
                      recalculateRowNumbers();
                      checkFileCount();
                    });

                    /*  Remove File Row
                    **************************************************************************************/
                    $(document).on('click','.remove-file',function(e){
                      e.preventDefault();
                      $(this).closest('tr').remove();

                      // Recalculate row numbers after a row is removed
                      recalculateRowNumbers();
                      checkFileCount();
                    });

                    /*  Recalculate Row Numbers
                    **************************************************************************************/
                    function recalculateRowNumbers(){
                      // Loop through each row and update the "No" column
                      $('table tbody tr').each(function(index){
                        $(this).find('.row-number').text(index + 1);
                      });
                    }

                    /*  Check File Count and Hide/Show Add Button
                    **************************************************************************************/
                    function checkFileCount(){
                      var file_count = $('table tbody tr').length;
                      var is_single = '{{ $data['cervie']['researcher']['table']['control']->evidence_single_only }}';
                      var limit = '{{ $data['cervie']['researcher']['table']['control']->evidence_upload_count }}';

                      if(is_single !== 1){
                        if(file_count >= limit){
                          $('.add-new-file').hide(); // Hide the add button if file count is 2 or more
                        }else{
                          $('.add-new-file').show(); // Show the add button if file count is less than 2
                        }
                      }
                    }

                    // Initial recalculation and file count check in case of pre-existing rows
                    recalculateRowNumbers();
                    checkFileCount();

                  });
                </script>
                <!-- end script for dynamic row numbering and file operations -->

              @endif
              {{-- End Evidence Need --}}

            </div>
            <!-- card body -->

            <!-- card footer -->
            <div class="card-footer">

              <!-- form control -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light"><i class="mdi mdi-arrow-left"></i>Back</a>
                  <input type="hidden" name="form_token" value="{{ $form_token['create'] }}">
                  <button type="submit" class="btn btn-danger text-white me-2"><i class="mdi mdi-plus"></i>Create</button>
                </div>

              </div>
              <!-- end form control -->

            </div>
            <!-- end card footer -->

          </div>
          <!-- end card -->

        </div>
        <!-- end col -->

      </div>
      <!-- end row -->

    </div>
    <!-- end content -->

  </form>
  <!-- end form -->

  <!-- Script for dynamic row numbering and file operations -->
  <script type="text/javascript">

    /**************************************************************************************
      Document On Load
    **************************************************************************************/
    $(document).ready(function(){

      /**************************************************************************************
        Is Current Progress
      **************************************************************************************/
      $('#is_current_progress').on('click',function(){
        if($(this).is(':checked')){
          //If the checkbox is checked, clear the Year End input and disable it
          $('#year_end').val('').attr('disabled', true);
        }else {
          //If the checkbox is unchecked, enable the Year End input
          $('#year_end').attr('disabled', false);
        }
      });

      /**************************************************************************************
        Date End
      **************************************************************************************/
      $('#year_end').on('input',function(){
        if($(this).val()){
          // If a Year is entered, uncheck the 'Is Current Progress' checkbox
          $('#is_current_progress').prop('checked',false);
        }else{
          // If Year End is cleared, allow 'Is Current Progress' to be checked
          $('#is_current_progress').prop('checked',true);
        }
      });

      //Slide Up with custom duration and easing
      $('#group_qualification_other').slideUp(500,'swing',function(){
        $(this).addClass('d-none');  // Add d-none after sliding up is complete
      });

      /*  Qualification on Change
      **************************************************************************************/
      $('#qualification_id').on('change',function(){

        //Check on Change Value
        switch($(this).val()){

          //Other
          case 'Q15':

            //Slide Down with custom duration and easing
            $('#group_qualification_other').removeClass('d-none').slideDown(500, 'swing');  // 500ms duration with 'swing' easing

          break;

          //Default
          default:

            //Slide Up with custom duration and easing
            $('#group_qualification_other').slideUp(500,'swing',function(){
              $(this).addClass('d-none');  // Add d-none after sliding up is complete
            });

          break;

        }

      });

      /*  Year Start and End Validation
      **************************************************************************************/
      $('#year_start,#year_end').on('input',function(){
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
        var year_pattern = /^\d{0,4}$/; // Allows 0 to 4 digits

        if(!year_pattern.test(data.input.year)){
          $('#' + data.input.id).val(data.input.year.slice(0,-1));
        }

        if(data.input.year.length === 4){
          var year_value = parseInt(data.input.year,10);
          if(year_value < 1900 || year_value > 2100){
            alert('Please enter a year between 1900 and 2100.');
            $('#' + data.input.id).val(''); // Clear the input if it's out of range
          }
        }
      }

    });
  </script>

@endsection
