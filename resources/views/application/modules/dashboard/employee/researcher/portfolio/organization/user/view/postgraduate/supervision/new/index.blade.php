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
            <h4 class="card-title">Grant Information</h4>
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

              <!-- representation category id -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="representation_category_id">Grant Category</label>
                  <select class="form-control select2" id="representation_category_id" name="representation_category_id">
                    <option value="">-- Please Select --</option>

                    {{-- Check General Representation Category Exist --}}
                    @if(count($data['general']['representation']['category']) > 0)

                      {{-- Get General Representation Category Data --}}
                      @foreach($data['general']['representation']['category'] as $key=>$value)
                        <option value="{{ $value->representation_category_id }}" {{ ((old('representation_category_id') == $value->representation_category_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Representation Category Level Data --}}

                    @endif
                    {{-- End Check General Representation Category Level Exist --}}

                  </select>
                </div>
              </div>
              <!-- end grant category id -->

              <!-- project role -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="representation_role_id">Project Role</label>
                  <select class="form-control select2" id="representation_role_id" name="representation_role_id">
                    <option value="">-- Please Select --</option>

                    {{-- Check General Representation Role Exist --}}
                    @if(count($data['general']['representation']['role']) > 0)

                      {{-- Get General Representation Role Data --}}
                      @foreach($data['general']['representation']['role'] as $key=>$value)
                        <option value="{{ $value->representation_role_id }}" {{ ((old('representation_role_id') == $value->representation_role_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Representation Role Level Data --}}

                    @endif
                    {{-- End Check General Representation Role Level Exist --}}

                  </select>
                </div>
              </div>
              <!-- end project role -->

            </div>
            <!-- end row 1 -->

            <!-- row 2 -->
            <div class="row pt-3">

              <!-- date start -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_start">Date Start</label>
                  <input type="date" class="form-control" id="date_start" name="date_start" value="{{ old('date_start') }}" placeholder="">
                </div>
              </div>
              <!-- end date start -->

              <!-- date end -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_end">Date End</label>
                  <input type="date" class="form-control" id="date_end" name="date_end" value="{{ old('date_end') }}" placeholder="">
                </div>
              </div>
              <!-- end date end -->

            </div>
            <!-- end row 2 -->

            <!-- row 3 -->
            <div class="row pt-3">

              <!-- title  -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="">
                </div>
              </div>
              <!-- end title -->

            </div>
            <!-- end row 3 -->

            <!-- row 4 -->
            <div class="row pt-3">

              <!-- currency code  -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Currency</label>
                  <select class="form-control select2" id="currency_code_id" name="currency_code_id">
                    <option value="">-- Please Select --</option>

                    {{-- Check General Currency Code Exist --}}
                    @if(count($data['general']['currency']['code']) > 0)

                      {{-- Get General Currency Code Data --}}
                      @foreach($data['general']['currency']['code'] as $key=>$value)
                        <option value="{{ $value->currency_code_id }}" {{ ((old('currency_code_id') == $value->currency_code_id)?'selected':'') }}>{{ $value->name . ' (' . $value->currency_code_id . ')'}}</option>
                      @endforeach
                      {{-- End Get General Currency Code Data --}}

                    @endif
                    {{-- End Check General Currency Code Exist --}}

                  </select>

                </div>
              </div>
              <!-- end currency code -->

              <!-- quantum  -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Quantum</label>
                  <input type="number" class="form-control" id="quantum" name="quantum" value="{{ old('quantum') }}" placeholder="">
                </div>
              </div>
              <!-- end quantum -->

            </div>
            <!-- end row 4 -->

            <!-- row 5 -->
            <div class="row pt-3">

              <!-- sustainable development goal -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="sustainable_development_goal">Sustainable Development Goal</label>
                  <select class="form-control select2" name="sustainable_development_goal_id[]" multiple>
                    <option value="">--Please Select--</option>
                    {{-- Check if Sustainable Development Goals exist --}}
                    @if(count($data['general']['sustainable']['development']['goal']) > 0)

                      @php
                        // Get old values for sustainable development goals (array) if they exist
                        $selected_sdg = old('sustainable_development_goal_id', []);
                      @endphp

                      {{-- Get Sustainable Development Goals Data --}}
                      @foreach($data['general']['sustainable']['development']['goal'] as $key=>$value)
                        <option value="{{ $value->sustainable_development_goal_id }}"
                          {{-- Check if this value was previously selected --}}
                          {{ in_array($value->sustainable_development_goal_id,$selected_sdg) ? 'selected' : '' }}>
                          {{ $value->code }} - {{ $value->name }}
                        </option>
                      @endforeach
                      {{-- End Get Sustainable Development Goals Data --}}

                    @endif
                    {{-- End Check if Sustainable Development Goals exist --}}
                  </select>
                </div>
              </div>
              <!-- end sustainable development goal -->

            </div>
            <!-- end row 5 -->

            <!-- row 6 -->
            <div class="row pt-3">

              <!-- status  -->
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
              <!-- end status -->

            </div>
            <!-- end row 6 -->

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

            {{-- Team Member Need --}}
            @if($data['cervie']['researcher']['table']['control']->team_member_need)

            <hr>

            <!-- card title -->
            <h4 class="card-title">Team Member</h4>
            <!-- end card title -->

            <!-- row 1 -->
            <div class="row">

                <!-- table responsive -->
                <div class="table-responsive">

                    <!-- table -->
                    <table class="table" id="team-member-table">

                        <!-- thead -->
                        <thead class="bg-danger text-white mx-3">
                            @php
                                // Set Checkbox Status
                                $checkbox['status'] = false;
                            @endphp

                            {{-- Check Table Column Exist --}}
                            @if(isset($data['table']['column']['cervie']['researcher']['team']['member']) && count($data['table']['column']['cervie']['researcher']['team']['member']) >= 1)
                                {{-- Get Table Column Data --}}
                                @foreach($data['table']['column']['cervie']['researcher']['team']['member'] as $key => $value)
                                    {{-- Check if the column is of category 'checkbox' --}}
                                    @if(isset($value['category']) && $value['category'] == 'checkbox')
                                        @php
                                            // Set Checkbox Status
                                            $checkbox['status'] = true;
                                        @endphp
                                        <td>{!! $value['checkbox'] !!}</td>
                                    @else
                                        <td class="{{ isset($value['class']) ? $value['class'] : '' }}">
                                            {!! isset($value['icon']) ? $value['icon'] : '' !!}
                                            {{ isset($value['name']) ? $value['name'] : '' }}
                                        </td>
                                    @endif
                                @endforeach
                            @else
                                <th>Column Not Defined</th>
                            @endif
                        </thead>
                        <!-- end thead -->

                        <!-- tbody -->
                        <tbody>
                            <tr>
                                <td class="row-number">1</td>
                                <td>
                                    <div class="form-group">
                                        <label for="team_member_name">Name</label>
                                        <input type="text" class="form-control" name="team_member_name[]">
                                    </div>
                                    <div class="form-group">
                                        <label for="team_representation_role_id">Role</label><br>
                                        <select style="width:100%;" class="form-control select2" name="team_representation_role_id[]">
                                            <option value="">-- Please Select --</option>
                                            {{-- Check General Representation Category Exist --}}
                                            @if(count($data['general']['representation']['role']) > 0)
                                                {{-- Get General Representation Category Data --}}
                                                @foreach($data['general']['representation']['role'] as $key=>$value)
                                                    <option value="{{ $value->representation_role_id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
                            <button type="button" class="btn btn-primary add-new-team-member">Add New Team Member</button>
                        </div>
                    </div>

                </div>
                <!-- end table responsive -->

            </div>
            <!-- end row 1 -->

            <!-- script for dynamic row numbering and team member operations -->
            <script type="text/javascript">
                $(document).ready(function() {
                  /* Add New Team Member Row */
                $('.add-new-team-member').click(function() {
                    var new_row = '';
                    new_row += '<tr>';
                    new_row += '<td class="row-number"></td>';
                    new_row += '<td>';
                    new_row += '<div class="form-group">';
                    new_row += '<label for="team_member_name">Name</label>';
                    new_row += '<input type="text" class="form-control" name="team_member_name[]">';
                    new_row += '</div>';
                    new_row += '<div class="form-group">';
                    new_row += '<label for="representation_role_id">Role</label>';
                    new_row += '<select class="form-control select2" name="team_representation_role_id[]">';
                    new_row += '<option value="">-- Please Select --</option>';
                    @if(count($data['general']['representation']['role']) > 0)
                        @foreach($data['general']['representation']['role'] as $role)
                            new_row += '<option value="{{ $role->representation_role_id }}">{{ $role->name }}</option>';
                        @endforeach
                    @endif
                    new_row += '</select>';
                    new_row += '</div>';
                    new_row += '</td>';
                    new_row += '<td>';
                    new_row += '<a href="#" class="btn btn-danger remove-team-member">';
                    new_row += '<i class="bi bi-trash"></i>';
                    new_row += '</a>';
                    new_row += '</td>';
                    new_row += '</tr>';

                    $('#team-member-table tbody').append(new_row);
                    recalculateRowNumbers();
                    checkTeamMemberCount();
                    initializeSelect2();
                });

                    /* Remove Team Member Row */
                    $(document).on('click', '.remove-team-member', function(e) {
                        e.preventDefault();
                        $(this).closest('tr').remove();
                        recalculateRowNumbers();
                        checkTeamMemberCount();

                    });

                    /* Recalculate Row Numbers */
                    function recalculateRowNumbers() {
                        $('#team-member-table tbody tr').each(function(index) {
                            $(this).find('.row-number').text(index + 1);
                        });
                    }

                    /* Initialize Select2 */
                    function initializeSelect2() {
                        $('.select2').select2({
                            width: '100%', // Adjust width as needed
                            placeholder: '-- Please Select --',
                            allowClear: true
                        });
                    }

                    /* Check File Count and Hide/Show Add Button */
                    function checkTeamMemberCount() {
                        var team_member_count = $('#team-member-table tbody tr').length;
                        var limit = '{{ $data['cervie']['researcher']['table']['control']->team_member_count }}';

                        if (team_member_count >= limit) {
                            $('.add-new-team-member').hide();
                        } else {
                            $('.add-new-team-member').show();
                        }
                    }

                    // Initial Select2 Initialization
                    initializeSelect2();
                    // Initial recalculation in case of pre-existing rows
                    recalculateRowNumbers();
                    checkTeamMemberCount();

                });
            </script>
            <!-- end script for dynamic row numbering and team member operations -->

            @endif
            {{-- End Team Member Need --}}


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
