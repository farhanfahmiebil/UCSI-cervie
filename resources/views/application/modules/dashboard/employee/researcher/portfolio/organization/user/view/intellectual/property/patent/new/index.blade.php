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
            <h4 class="card-title">Patent Information</h4>
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

              <!-- patent title -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="patent_title">Patent Title</label>
                  <input type="text" class="form-control" id="patent_title" name="patent_title" value="{{ old('patent_title') }}" placeholder="">
                </div>
              </div>
              <!-- end patent title -->

            </div>
            <!-- end row 1 -->

            <!-- row 2-->
            <div class="row pt-3">

              <!-- patent no -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="patent_no">Patent No.</label>
                  <input type="text" class="form-control" id="patent_no" name="patent_no" value="{{ old('patent_no') }}" placeholder="">
                </div>
              </div>
              <!-- end patent no -->

              <!-- field invention -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="patent_field_invention_category_id">Field Invention</label>
                  <select class="form-control select2" id="patent_field_invention_category_id" name="patent_field_invention_category_id">
                    <option value="">--Please Select--</option>
                    {{-- Check General Patent Field Invention Category Exist --}}
                    @if(count($data['general']['patent']['field']['invention']['category'])>0)

                      {{-- Get General Patent Field Invention Category Data --}}
                      @foreach($data['general']['patent']['field']['invention']['category'] as $key=>$value)
                        <option value="{{ $value->patent_field_invention_category_id }}" {{ ((old('patent_field_invention_category_id') == $value->patent_field_invention_category_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Patent Field Invention Category Data --}}

                    @endif
                    {{-- End Check General Patent Field Invention Category Exist --}}
                  </select>
                </div>
              </div>
              <!-- end field invention -->

            </div>
            <!-- end row 2 -->

            <!-- row 3 -->
            <div id="group_patent_field_invention_category_other" class="row">

              <!-- patent field invention category other -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="patent_field_invention_category_other">Other - Field Invention (Please State)</label>
                  <input type="text" class="form-control" id="patent_field_invention_category_other" name="patent_field_invention_category_other" value="{{ old('patent_field_invention_category_other') }}" placeholder="">
                </div>
              </div>
              <!-- end patent field invention category other -->

            </div>
            <!-- end row 3 -->

            <!-- row 4 -->
            <div class="row pt-3">

              <!-- date filing -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_filing">Date Filing</label>
                  <input type="date" class="form-control" id="date_filing" name="date_filing" value="{{ old('date_filing') }}" placeholder="">
                </div>
              </div>
              <!-- end date filing -->

              <!-- date approval -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_approval">Date Approval</label>
                  <input type="date" class="form-control" id="date_approval" name="date_approval" value="{{ old('date_approval') }}" placeholder="">
                </div>
              </div>
              <!-- end date approval -->

            </div>
            <!-- end row 4 -->

            <!-- row 5 -->
            <div class="row pt-3">

              <!-- currency code -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="currency_code_id">Currency Code</label>
                  <select class="form-control select2" name="currency_code_id">
                    <option value="">--Please Select--</option>
                    {{-- Check General Currency Code Exist --}}
                    @if(count($data['general']['currency']['code'])>0)

                      {{-- Get General Currency Code Data --}}
                      @foreach($data['general']['currency']['code'] as $key=>$value)
                        <option value="{{ $value->currency_code_id }}" {{ ((old('currency_code_id') == $value->currency_code_id)?'selected':'') }}>({{ $value->code }}) {{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Currency Code Data --}}

                    @endif
                    {{-- End Check General Currency Code Exist --}}
                  </select>
                </div>
              </div>
              <!-- end currency code -->

              <!-- patent amount -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="amount">Patent Amount</label>
                  <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="">
                </div>
              </div>
              <!-- end patent amount -->

            </div>
            <!-- end row 5 -->

            <!-- row 6 -->
            <div class="row pt-3">

              <!-- representation category -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="representation_category_id">Patent Level</label>
                  <select class="form-control select2" id="representation_category_id" name="representation_category_id">
                    <option value="">--Please Select--</option>
                    {{-- Check General Representation Category Exist --}}
                    @if(count($data['general']['representation']['category'])>0)

                      {{-- Get General Representation Category Data --}}
                      @foreach($data['general']['representation']['category'] as $key=>$value)
                        <option value="{{ $value->representation_category_id }}" {{ ((old('representation_category_id') == $value->representation_category_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Representation Category Data --}}

                    @endif
                    {{-- End Check General Representation Category Exist --}}
                  </select>
                </div>
              </div>
              <!-- end representation category -->

              <!-- country -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country_id">Country</label>
                  <select class="form-control select2" id="country_id" name="country_id[]">
                    <option value="">--Please Select--</option>
                    {{-- Check if Country exist --}}
                    @if(count($data['general']['country']) > 0)

                      @php
                        // Get old values for Country (array) if they exist
                        $selected_sdg = old('country_id', []);
                      @endphp

                      {{-- Iterate through available Country --}}
                      @foreach($data['general']['country'] as $key=>$value)
                        <option value="{{ $value->country_id }}"
                          {{-- Check if this value was previously selected --}}
                          {{ in_array($value->country_id,$selected_sdg) ? 'selected' : '' }}>
                          {{ $value->country }}
                        </option>
                      @endforeach

                    @endif
                  </select>

                </div>
              </div>
              <!-- end country -->

            </div>
            <!-- end row 6 -->

            <!-- row 7 -->
            <div class="row pt-3">

              <!-- currency code -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status_id">Status</label>
                  <select class="form-control select2" name="status_id">
                    <option value="">--Please Select--</option>
                    {{-- Check General Status Exist --}}
                    @if(count($data['general']['status'])>0)

                      {{-- Get General Status Data --}}
                      @foreach($data['general']['status'] as $key=>$value)
                        <option value="{{ $value->status_id }}" {{ ((old('status_id') == $value->status_id)?'selected':'') }}>{{ ucwords($value->status_name) }}</option>
                      @endforeach
                      {{-- End Get General Status Data --}}

                    @endif
                    {{-- End Check General Status Exist --}}
                  </select>
                </div>
              </div>
              <!-- end currency code -->

            </div>
            <!-- end row 7 -->

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

  /**************************************************************************************
    Patent Field Invention Category
  **************************************************************************************/

      //Toggle Patent Field Invention Category
      togglePatentFieldInventionCategory();

      //Representation Category On Change
      $('#patent_field_invention_category_id').on('change',function(){

        //Toggle Representation Category
        togglePatentFieldInventionCategory();

      });

      function togglePatentFieldInventionCategory(){

        // Get the selected value from the representation category dropdown
        var selected_value = $('#patent_field_invention_category_id').val();

        // Get the selected text (name) from the dropdown
        var selected_text = $('#patent_field_invention_category_id option:selected').text();

        //Set Placeholder
        var placeholderOption = '<option value="">--Please Select--</option>';

        if (selected_text === 'Other'){

          //Slide Down
          $('#group_patent_field_invention_category_other').removeClass('d-none').slideDown();

        }else{

          //Slide Up
          $('#group_patent_field_invention_category_other').slideUp(500,function(){
            $(this).addClass('d-none');
          });

          //Set Null
          $('#patent_field_invention_category_other').val('');
        }

      }

      //Toggle Representation Category
      toggleRepresentationCategory();

      //Representation Category On Change
      $('#representation_category_id').on('change',function(){

        //Toggle Representation Category
        toggleRepresentationCategory();

      });

      function toggleRepresentationCategory(){

        // Get the selected value from the representation category dropdown
        var selected_value = $('#representation_category_id').html();

        // Get the selected text (name) from the dropdown
        var selected_text = $('#representation_category_id option:selected').text();

        //Set Placeholder
        var placeholderOption = '<option value="">--Please Select--</option>';
        //Trigger Change on Select2

        // Check if it's "International" or "National" (assuming 2 is International and 1 is National)
        if(selected_text == 'International'){ // Assuming '2' is International

          // $('#country_id').attr('multiple','multiple');
          //Remove First Option
          $('#country_id option[value=""]').remove();

          //Trigger Change Select
          $('#country_id').val(null).trigger('change');

          //Check Old Country
          @if(old('country_id'))

            // Retrieve old values for country_id from Laravel
            var old_countries = @json(old('country_id'));

            //Trigger Change on Select2
            $('#country_id').select2(
              {
                multiple:true
              }
            ).val(old_countries);

          @else

            //Trigger Change on Select2
            $('#country_id').select2(
              {
                multiple:true
              }
            )

          @endif

        }else
        if(selected_text == 'National'){ // Assuming '1' is National

          // Check if the placeholder is already added, if not, add it
          if($('#country_id option[value=""]').length === 0){

            // Restore the "Please Select" option
            $('#country_id').prepend(placeholderOption);
          }

          //Trigger Change Select
          $('#country_id').val(null).trigger('change');

          //Check Old Country
          @if(old('country_id'))

            // Retrieve old values for country_id from Laravel
            var old_countries = @json(old('country_id'));

            //Trigger Change on Select2
            $('#country_id').select2(
              {
                multiple:false
              }
            ).val(old_countries);

          @else

            //Trigger Change on Select2
            $('#country_id').select2(
              {
                multiple:false
              }
            )

          @endif

        }

      }

</script>
