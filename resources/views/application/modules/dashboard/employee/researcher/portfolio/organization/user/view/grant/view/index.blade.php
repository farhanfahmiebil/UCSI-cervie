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

        @if(count(get_object_vars($data['cervie']['researcher']['log']['grant'])) === 0)
        <div class="alert alert-warning" role="alert">
          <i class="bi bi-check-circle me-2"></i> This record is new entry
        </div>
        @endif


        {{-- Check if 'grant' is set and not null --}}
        @if(!empty($data['cervie']['researcher']['log']['grant']) && isset($data['cervie']['researcher']['log']['grant']->updated_at) && $data['cervie']['researcher']['log']['grant']->updated_at != null)
            <div class="alert alert-warning" role="alert">
                <h4 class="card-title text-white">Old Values</h4>
                <ol class="list-group list-group-numbered">
                    {{-- Check if 'representation_category_name' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->representation_category_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Grant Category</div>
                                {{ $data['cervie']['researcher']['log']['grant']->representation_category_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'representation_role_name' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->representation_role_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Project Role</div>
                                {{ $data['cervie']['researcher']['log']['grant']->representation_role_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'date_start' and 'date_end' are set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->date_start) && isset($data['cervie']['researcher']['log']['grant']->date_end))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date Start to Date End</div>
                                {{ \Carbon\Carbon::parse($data['cervie']['researcher']['log']['grant']->date_start)->format('d-m-Y') }} to
                                {{ \Carbon\Carbon::parse($data['cervie']['researcher']['log']['grant']->date_end)->format('d-m-Y') }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'grant_title' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->grant_title))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Grant Title</div>
                                {{ $data['cervie']['researcher']['log']['grant']->grant_title }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'currency_code_id' and 'currency_code_name' are set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->currency_code_id) && isset($data['cervie']['researcher']['log']['grant']->currency_code_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Currency</div>
                                {{ $data['cervie']['researcher']['log']['grant']->currency_code_id }} -
                                {{ $data['cervie']['researcher']['log']['grant']->currency_code_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'quantum' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->quantum))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Quantum</div>
                                {{ $data['cervie']['researcher']['log']['grant']->quantum }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'sustainable_development_goal' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->sustainable_development_goal))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">SDG</div>
                                {{ $data['cervie']['researcher']['log']['grant']->sustainable_development_goal }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if 'status_name' is set --}}
                    @if(isset($data['cervie']['researcher']['log']['grant']->status_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Status</div>
                                {{ ucwords($data['cervie']['researcher']['log']['grant']->status_name) }}
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

        {{-- Check Data Team Member --}}
        @if(count($data['cervie']['researcher']['log']['team']['member']) >= 1 && $data['cervie']['researcher']['log']['team']['member']->pluck('need_verification')->contains(true))
        <div class="alert alert-warning" role="alert">
          <h4 class="card-title text-white">New Team Member(s)</h4>
          <ol class="list-group list-group-numbered">
            @foreach($data['cervie']['researcher']['log']['team']['member'] as $key=>$value)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Name: {{$value->name}}</div>
                Role: {{$value->role}}
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

                      {{-- Get General Grant Category Data --}}
                      @foreach($data['general']['representation']['category'] as $key=>$value)
                        <option value="{{ $value->representation_category_id }}" {{ (($data['main']->representation_category_id == $value->representation_category_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Grant Category Level Data --}}

                    @endif
                    {{-- End Check General Grant Category Level Exist --}}

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
                        <option value="{{ $value->representation_role_id }}" {{ (($data['main']->representation_role_id == $value->representation_role_id)?'selected':'') }}>{{ $value->name }}</option>
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
                  <input type="date" class="form-control" id="date_start" name="date_start" value="{{ \Carbon\Carbon::parse($data['main']->date_start)->format('Y-m-d') }}" placeholder="">
                </div>
              </div>
              <!-- end date start -->

              <!-- date end -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_end">Date End</label>
                  <input type="date" class="form-control" id="date_end" name="date_end" value="{{ (!empty($data['main']->date_end)?\Carbon\Carbon::parse($data['main']->date_end)->format('Y-m-d'):null) }}" placeholder="">
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
                  <input type="text" class="form-control" id="title" name="title" value="{{ $data['main']->grant_title }}" placeholder="">
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
                        <option value="{{ $value->currency_code_id }}" {{ (($data['main']->currency_code_id == $value->currency_code_id)?'selected':'') }}>{{ $value->name . ' (' . $value->currency_code_id . ')'}}</option>
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
                  <input type="number" class="form-control" id="quantum" name="quantum" value="{{ $data['main']->quantum }}" placeholder="">
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
                  <label for="sustainable_development_goal_id">Sustainable Development Goal</label>
                  <select class="form-control select2" name="sustainable_development_goal_id[]" multiple>
                    <option value="">--Please Select--</option>

                    {{-- Check General Sustainable Development Goal Exist --}}
                    @if(count($data['general']['sustainable']['development']['goal']) > 0)

                        @php
                          // Explode Sustainable Development Goal from the main data (comma-separated string)
                          $selected_sdg = explode(',',$data['main']->sustainable_development_goal);
                        @endphp

                        {{-- Get General Sustainable Development Goal Data --}}
                        @foreach($data['general']['sustainable']['development']['goal'] as $key=>$value)
                          <option value="{{ $value->sustainable_development_goal_id }}"
                            {{ in_array($value->sustainable_development_goal_id,$selected_sdg) ? 'selected' : '' }}>
                            {{ $value->code }} - {{ $value->name }}
                          </option>
                        @endforeach
                        {{-- End Get General Sustainable Development Goal Data --}}

                    @endif
                    {{-- End Check General Sustainable Development Goal Exist --}}
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
                        <option value="{{ $value->status_id }}" {{ (($data['main']->status_id == $value->status_id)?'selected':'') }}>{{ ucwords($value->status_name) }}</option>
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
                              <a href="#" data-href="{{ route($hyperlink['page']['delete']['evidence'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$data['main']->grant_id,'evidence_id'=>$value->evidence_id,'file_id'=>$value->file_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-evidence btn btn-danger text-white">
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
                                <td>{{ $value->role }}</td>
                                <td>
                                  <!-- remove file -->
                                  <a href="#" data-href="{{ route($hyperlink['page']['delete']['team']['member'],['team_member_id' => $value->team_member_id,'organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$data['main']->grant_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-team-member btn btn-danger text-white">
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
                                      <label for="role">Role</label>
                                      <input type="text" class="form-control" name="role[]">
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
                $(document).ready(function() {
                  /* Add New Team Member Row */
                $('.add-new-team-member').click(function() {
                    var new_row = '';
                    new_row += '<tr>';
                    new_row += '<td class="row-number"></td>';
                    new_row += '<td colspan="2">';
                    new_row += '<div class="form-group">';
                    new_row += '<label for="team_member_name">Name</label>';
                    new_row += '<input type="text" class="form-control" name="team_member_name[]">';
                    new_row += '</div>';
                    new_row += '<div class="form-group">';
                    new_row += '<label for="role">Role</label>';
                    new_row += '<input type="text" class="form-control" name="role[]">';
                    new_row += '</div>';
                    new_row += '</td>';
                    new_row += '<td>';
                    new_row += '<a href="#" class="btn btn-warning remove-team-member">';
                    new_row += '<i class="bi bi-x-lg text-white"></i>';
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
                <input type="hidden" id="id" name="id" value="{{ $data['main']->grant_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                <a data-href="{{ route($hyperlink['page']['delete']['main'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn-delete-main btn btn-danger text-white me-2"><i class="mdi mdi-trash-can"></i>Delete Record</a>
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
    Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-team-member"]').on('click',function(event){

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
