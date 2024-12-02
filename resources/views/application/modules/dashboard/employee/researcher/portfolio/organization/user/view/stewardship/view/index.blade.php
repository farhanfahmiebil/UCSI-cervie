<!-- form -->
<form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" enctype="multipart/form-data" method="POST">
@csrf

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row -->
    <div class="row">

      <!-- alert -->
      <div class="col-12">

        {{-- Check Table Control Evidence Need Exist --}}
        @if($data['cervie']['researcher']['table']['control']->evidence_need)

          {{-- Check Data Evidence Exist --}}
          @if(!$data['evidence'])

          <div class="alert alert-warning" role="alert">
            There is no Evidence to be displayed as Public, This Record will be mark as Pending
          </div>

          @endif
          {{-- End Check Data Evidence Exist --}}

        @endif
        {{-- End Check Table Control Evidence Need Exist --}}


        {{-- Check Data Main --}}
        @if($data['main']->need_verification)

        <div class="alert alert-warning" role="alert">
          This Record is still Pending for Administrator to make Verification
        </div>

        @if(count(get_object_vars($data['cervie']['researcher']['log']['stewardship'])) === 0)
        <div class="alert alert-warning" role="alert">
          <i class="bi bi-check-circle me-2"></i> This record is new entry
        </div>
        @endif


        {{-- Check if 'membership' is set and not null --}}
        @if(!empty($data['cervie']['researcher']['log']['stewardship']) && isset($data['cervie']['researcher']['log']['stewardship']->updated_at) && $data['cervie']['researcher']['log']['stewardship']->updated_at != null)
              <div class="alert alert-warning" role="alert">
                  <h4 class="card-title text-white">Old Values</h4>
                  <ol class="list-group list-group-numbered">
                      @if(isset($data['cervie']['researcher']['log']['stewardship']->representation_category_name))
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold">Stewardship Type</div>
                                  {{ $data['cervie']['researcher']['log']['stewardship']->representation_category_name }}
                              </div>
                          </li>
                      @endif

                      @if(isset($data['cervie']['researcher']['log']['stewardship']->conferring_body))
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold">Conferring Body</div>
                                  {{ $data['cervie']['researcher']['log']['stewardship']->conferring_body }}
                              </div>
                          </li>
                      @endif

                      @if(isset($data['cervie']['researcher']['log']['stewardship']->title))
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold">Stewardship Title</div>
                                  {{ $data['cervie']['researcher']['log']['stewardship']->title }}
                              </div>
                          </li>
                      @endif

                      @if(isset($data['cervie']['researcher']['log']['stewardship']->date_award))
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold">Date Stewardship Received</div>
                                  {{ \Carbon\Carbon::parse($data['cervie']['researcher']['log']['stewardship']->date_award)->format('d-m-Y') }}
                              </div>
                          </li>
                      @endif
                  </ol>
              </div>
          @endif
          {{-- End Check Data Log --}}

          {{-- Check Data Evidence --}}
          @if(count($data['cervie']['researcher']['log']['evidence']) >= 1 && $data['cervie']['researcher']['log']['evidence']->pluck('need_verification')->contains(true))
          <div class="alert alert-warning" role="alert">
            <h4 class="card-title text-white">New Evidence</h4>
            <ol class="list-group list-group-numbered">
              @foreach($data['cervie']['researcher']['log']['evidence'] as $key=>$value)
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">File Name</div>
                  {{$value->file_name . '.' . $value->file_extension}}
                </div>
              </li>
              @endforeach
            </ol>
          </div>

          @endif
          {{-- End Check Data Evidence --}}


          @else
          <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle me-2"></i> Record Verified
          </div>


        @endif
        {{-- End Check Data Main --}}

      </div>
      <!-- end alert -->

      <!-- col -->
      <div class="col-12 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card body -->
          <div class="card-body">

            <!-- card title -->
            <h4 class="card-title">Stewardship Information</h4>
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
                  <label for="representation_category_id">Stewardship Type</label>
                  <select class="form-control select2" id="representation_category_id" name="representation_category_id">
                    <option value="">-- Please Select --</option>

                    {{-- Check General Representation Category Exist --}}
                    @if(count($data['general']['representation']['category']) > 0)

                      {{-- Get General Representation Category Data --}}
                      @foreach($data['general']['representation']['category'] as $key=>$value)
                        <option value="{{ $value->representation_category_id }}" {{ (($data['main']->representation_category_id == $value->representation_category_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Representation Category Level Data --}}

                    @endif
                    {{-- End Check General Representation Category Level Exist --}}

                  </select>
                </div>
              </div>
              <!-- end representation category id -->

              <!-- date award -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_award">Date Stewardship Received</label>
                  <input type="date" class="form-control" id="date_award" name="date_award" value="{{ \Carbon\Carbon::parse($data['main']->date_award)->format('Y-m-d') }}" placeholder="">
                </div>
              </div>
              <!-- end date award -->

            </div>
            <!-- end row 1 -->

            <!-- row 2 -->
            <div class="row pt-3">

              <!-- conferring body -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="conferring_body">Conferring Body</label>
                  <input type="text" class="form-control" id="conferring_body" name="conferring_body" value="{{ $data['main']->conferring_body }}" placeholder="">
                </div>
              </div>
              <!-- end conferring body -->

              <!-- title -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Stewardship Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $data['main']->title }}" placeholder="Award Title">
                </div>
              </div>
              <!-- end title -->

            </div>
            <!-- end row 2 -->

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
                  <table class="table table-bordered">

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

                              <th>{!! $value['checkbox'] !!}</th>

                            @else

                              {{-- Check if 'class' is set and apply it --}}
                              @if(isset($value['class']) && !empty($value['class']))
                                <th class="{{ $value['class'] }}">
                              @else
                                <th>
                              @endif

                                  {{-- Output the icon and name --}}
                                  {!! isset($value['icon']) ? $value['icon'] : '' !!}
                                  {{ isset($value['name']) ? $value['name'] : '' }}

                                </th>

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

                    {{-- Check Data Evidence Exist --}}
                    @if($data['evidence'])

                      {{-- Get Data Evidence --}}
                      @foreach($data['evidence'] as $key=>$value)

                        <tr id="{{ $value->evidence_id }}">

                          <td>{{ ($key+1) }}</td>
                          <td>{{ $value->file_name.'.'.$value->file_extension }}</td>
                          <td>
                            @if(Storage::exists($asset['document'].$value->file_id.'.'.$value->file_extension))

                              <!-- hyperlink -->
                              <a href="{{ $hyperlink['document'].$value->file_id.'.'.$value->file_extension }}" class="btn btn-info" target="_blank">
                                <i class="bi bi-link"></i>
                              </a>
                              <!-- end hyperlink -->

                              <!-- remove file -->
                              <a href="#" data-href="{{ route($hyperlink['page']['delete']['evidence'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$data['main']->stewardship_id,'evidence_id'=>$value->evidence_id,'file_id'=>$value->file_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-evidence btn btn-danger text-white">
                                <i class="bi bi-trash"></i>
                              </a>
                              <!-- end remove file -->

                            @else
                            <p>-</p>
                            @endif
                          </td>

                        </tr>

                      @endforeach

                    @else

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

                    @endif
                    {{-- End Check Data Evidence Exist --}}

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
                  function checkFileCount() {
                    console.log($('table tbody tr').length);
                    var fileCount = $('table tbody tr').length;
                    var is_single = '{{ $data['cervie']['researcher']['table']['control']->evidence_single_only }}';
                    var limit = '{{ $data['cervie']['researcher']['table']['control']->evidence_upload_count }}';

                    if(is_single !== 1){
                      if(fileCount >= limit){
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
                                        <th>{!! $value['checkbox'] !!}</th>
                                    @else
                                        <th class="{{ isset($value['class']) ? $value['class'] : '' }}">
                                            {!! isset($value['icon']) ? $value['icon'] : '' !!}
                                            {{ isset($value['name']) ? $value['name'] : '' }}
                                        </th>
                                    @endif
                                @endforeach
                            @else
                                <th>Column Not Defined</th>
                            @endif
                        </thead>
                        <!-- end thead -->

                        {{-- Check Data Team Members Exist --}}
                        @if($data['team_member'])

                          {{-- Get Data Team Members --}}
                          @foreach($data['team_member'] as $key => $value)
                              <tr id="{{ $value->team_member_id }}">
                                  <td>{{ ($key + 1) }}</td>
                                  <td>{{ $value->name }}</td>
                                  <td>{{ $value->representation_role_name }}</td>
                                  <td>
                                      @if($key != 0)
                                          <a href="#" class="btn btn-warning remove-team-member">
                                            <i class="bi bi-x-lg"></i>
                                          </a>
                                      @endif
                                      <!-- remove file -->
                                      <a href="#" data-href="{{ route($hyperlink['page']['delete']['team']['member'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$data['main']->stewardship_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-team-member btn btn-danger text-white">
                                        <i class="bi bi-trash"></i>
                                      </a>
                                      <!-- end remove file -->

                                  </td>
                              </tr>
                          @endforeach
                          {{-- End Get Data Team Members --}}

                        @else
                          <tr>
                              <td class="row-number">1</td>
                              <td colspan="2">
                                  <div class="form-group">
                                      <label for="team_member_name">Name</label>
                                      <input type="text" class="form-control" name="team_member_name[]">
                                  </div>
                                  <div class="form-group">
                                      <label for="representation_role_id">Role</label>
                                      <select class="form-control select2" name="team_representation_role_id[]">
                                          <option value="">-- Please Select --</option>
                                          @if(count($data['general']['representation']['role']) > 0)
                                              @foreach($data['general']['representation']['role'] as $role)
                                                  <option value="{{ $role->representation_role_id }}">{{ $role->name }}</option>
                                              @endforeach
                                          @endif
                                      </select>
                                  </div>
                              </td>
                              <td>&nbsp;</td>
                          </tr>
                        @endif
                        {{-- End Check Data Team Members Exist --}}



                    </table>
                    <!-- end table -->

                    <div class="row text-center pt-3">
                      <div class="col-12">
                        <button type="button" class="btn btn-primary add-new-team-member">
                          <i class="mdi mdi-plus"></i> Add New Team Member
                        </button>
                      </div>
                    </div>

                </div>
                <!-- end table responsive -->

            </div>
            <!-- end row 1 -->

            <!-- script for dynamic row numbering and team member operations -->
            <script type="text/javascript">

              $(document).ready(function(){

                /* Add New Team Member Row */
                $('.add-new-team-member').click(function(){
                    var new_row = '';
                    new_row += '<tr>';
                    new_row += '<td class="row-number"></td>';
                    new_row += '<td colspan="2">';
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
                    new_row += '<i class="bi bi-x-lg"></i>';
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
                <input type="hidden" id="id" name="id" value="{{ $data['main']->stewardship_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                <a data-href="{{ route($hyperlink['page']['delete']['main'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn-delete-main btn btn-danger text-white me-2"><i class="bi bi-trash"></i>Delete Record</a>
                <button type="submit" class="btn btn-danger text-white me-2"> <i class="bi bi-check-circle"></i> Save & Verify</button>
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
      Session
    **************************************************************************************/
    // @if(Session('message'))
    //   Swal.fire({
    //     title: '{{ ucwords(Session::get('alert_type')) }}',
    //     text: '{{ ucwords(Session::get('message')) }}',
    //     icon: '{{ strtolower(Session::get('alert_type')) }}'
    //   });
    // @endif

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-main"]').on('click',function(event){

      //Set Parent Row
      var id = $('#id').val();
// console.log(id)
      //Set Form Token
      var form_token = '{{ $form_token["delete"] }}';

      //Set Hyperlink
      var hyperlink  = $(this).data('href');
          hyperlink += '?id='+id;
          hyperlink += '&form_token='+form_token;

      //Set Alert
      Swal.fire({
        title:'Are you sure you want to Delete? Once deleted, it cannot be recovered.',
        showDenyButton:true,
        confirmButtonText:'Yes',
        denyButtonText:'Cancel',
        icon:'error'
      }).then((result) => {

        //If Confirmed
        if(result.isConfirmed){

          //Redirect
          window.location.href = hyperlink;

        }else

        //If Denied
        if(result.isDenied){

          //Alert Message
          Swal.fire('Cancel','','');
        }

      });
    });

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-evidence"]').on('click',function(event){

      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');

      //Set Alert
      Swal.fire({
        title:'Are you sure you want to Delete? Once deleted, it cannot be recovered.',
        showDenyButton:true,
        confirmButtonText:'Yes',
        denyButtonText:'Cancel',
        icon:'error'
      }).then((result) => {

        //If Confirmed
        if(result.isConfirmed){

          //Redirect
          window.location.href = $(this).data('href');

        }else

        //If Denied
        if(result.isDenied){

          //Alert Message
          Swal.fire('Cancel','','');
        }

      });
    });

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

  });
</script>