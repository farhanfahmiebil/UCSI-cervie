<!-- form -->
<form action="{{ route($hyperlink['page']['create'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" enctype="multipart/form-data" method="POST">
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
            <h4 class="card-title">Work Experience Information</h4>
            <!-- end card title -->

            <hr>

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
            <div class="row pt-3">

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
            <div class="row pt-3">

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
            <div class="row pt-3">

              <!-- date start -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="year_start">Year Start <small>(Example:20XX)</small></label>
                  <input type="text" class="form-control" id="year_start" name="year_start" value="{{ old('year_start') }}" placeholder="YYYY">
                </div>
              </div>
              <!-- end date start -->

              <!-- date end -->
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
                        <input type="checkbox" class="form-check-input" id="is_working_here" name="is_working_here" value="1" {{ old('is_working_here') ? 'checked' : ''}}>
                        Currently Working Here
                        <i class="input-helper"></i>
                      </label>
                    </div>
                  </div>

                  <input type="text" class="form-control" id="year_end" name="year_end" value="{{ old('year_end') }}" placeholder="YYYY">
                </div>
              </div>
              <!-- end date end -->

            </div>
            <!-- end row 3 -->

            {{-- Evidence Need --}}
            @if($data['cervie']['researcher']['table']['control']->evidence_need)

              <hr>

              <!-- card title -->
              <h4 class="card-title">Evidence</h4>
              <!-- end card title -->

              <hr>

              <!-- row 1 -->
              <div class="row pt-3">

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
                          <div class="form-group py-3">
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
                      <button type="button" class="btn btn-primary add-new-file"><i class="bi bi-plus"></i>Add New File</button>
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
                        new_row += '<i class="bi bi-trash text-white"></i>';
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
                        // console.log(file_count +'-'+ limit);
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
                <a href="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-light"><i class="bi bi-arrow-left"></i>Back</a>
                <input type="hidden" name="employee_id" value="{{ request()->employee_id }}">
                <input type="hidden" name="organization_id" value="{{ request()->organization_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['create'] }}">
                <button type="submit" class="btn btn-danger text-white me-2"><i class="bi bi-plus"></i>Create</button>
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

<script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function(){

    /**************************************************************************************
      Is Current Position
    **************************************************************************************/
    $('#is_current_position').on('click',function(){
      if($(this).is(':checked')){
        //If the checkbox is checked, clear the Date End input and disable it
        $('#date_end').val('').attr('disabled', true);
      }else{
        //If the checkbox is unchecked, enable the Date End input
        $('#date_end').attr('disabled', false);
      }
    });

    /**************************************************************************************
      Date End
    **************************************************************************************/
    $('#date_end').on('input',function(){
      if($(this).val()){
        // If a date is entered, uncheck the 'Is Lifetime' checkbox
        $('#is_current_position').prop('checked', false);
      }else{
        // If Date End is cleared, allow 'Is Lifetime' to be checked
        $('#is_current_position').prop('checked', true);
      }
    });
  });

</script>