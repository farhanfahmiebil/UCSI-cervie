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

        @if(count(get_object_vars($data['cervie']['researcher']['log']['academic']['qualification'])) === 0)
        <div class="alert alert-warning" role="alert">
          <i class="bi bi-check-circle me-2"></i> This record is new entry
        </div>
        @endif


        {{-- Check Data Log --}}
        @if(!empty($data['cervie']['researcher']['log']['academic']['qualification']) && isset($data['cervie']['researcher']['log']['academic']['qualification']->updated_at) && $data['cervie']['researcher']['log']['academic']['qualification']->updated_at != null)
            <div class="alert alert-warning" role="alert">
                <h4 class="card-title text-white">Old Values</h4>
                <ol class="list-group list-group-numbered">
                    {{-- Check if company_name is set --}}
                    @if(isset($data['cervie']['researcher']['log']['academic']['qualification']->qualification_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Qualification</div>
                                {{ $data['cervie']['researcher']['log']['academic']['qualification']->qualification_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if designation is set --}}
                    @if(isset($data['cervie']['researcher']['log']['academic']['qualification']->field_study))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Field of Study</div>
                                {{ $data['cervie']['researcher']['log']['academic']['qualification']->field_study }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if designation is set --}}
                    @if(isset($data['cervie']['researcher']['log']['academic']['qualification']->institution_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">University/College/Other</div>
                                {{ $data['cervie']['researcher']['log']['academic']['qualification']->institution_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if year_start is set --}}
                    @if(isset($data['cervie']['researcher']['log']['academic']['qualification']->year_start))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date Start to Date End</div>
                                {{ \Carbon\Carbon::parse($data['cervie']['researcher']['log']['academic']['qualification']->year_start)->format('d-m-Y') }}
                                to
                                {{-- Check if currently working --}}
                                @if(isset($data['cervie']['researcher']['log']['academic']['qualification']->is_currently_study) && $data['cervie']['researcher']['log']['academic']['qualification']->is_working_here)
                                    Currently Study Here
                                @elseif(isset($data['cervie']['researcher']['log']['academic']['qualification']->year_end))
                                    {{ \Carbon\Carbon::parse($data['cervie']['researcher']['log']['academic']['qualification']->year_end)->format('d-m-Y') }}
                                @endif
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
            <h4 class="card-title">Academic Qualification Information</h4>
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
                        <option value="{{ $value->qualification_id }}" {{ (($data['main']->qualification_id == $value->qualification_id)?'selected':'') }}>{{ $value->qualification_name }}</option>
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
            <div id="group_qualification_other" class="row pt-3">

              <!-- qualification other -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="qualification_other">Other Qualification (Please Specify)</label>
                  <input type="text" class="form-control" id="qualification_other" name="qualification_other" value="{{ $data['main']->qualification_other }}" placeholder="Other Qualification Name">
                </div>
              </div>
              <!-- end qualification other -->

            </div>
            <!-- end row 2 -->

            <!-- row 3 -->
            <div class="row pt-3">

              <!-- field study -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="field_study">Field of Study</label>
                  <input type="text" class="form-control" id="field_study" name="field_study" value="{{ $data['main']->field_study }}" placeholder="Field of Study">
                </div>
              </div>
              <!-- end field study -->

            </div>
            <!-- end row 3 -->

            <!-- row 4 -->
            <div class="row pt-3">

              <!-- institution -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="institution_name">University/College/Other</label>
                  <input type="text" class="form-control" id="institution_name" name="institution_name" value="{{ $data['main']->institution_name }}" placeholder="Name">
                </div>
              </div>
              <!-- end institution -->

            </div>
            <!-- end row 4 -->

            <!-- row 5 -->
            <div class="row pt-3">

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
                      <label for="is_current_progress" class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="is_current_progress" name="is_current_progress" value="1" {{ (($data['main']->is_current_progress)?'checked':'') }}>
                        Currently Study
                        <i class="input-helper"></i>
                      </label>
                    </div>
                  </div>

                  <input type="text" class="form-control" id="year_end" name="year_end" value="{{ $data['main']->year_end }}" placeholder="YYYY">
                </div>
              </div>
              <!-- end year end -->

            </div>
            <!-- end row 5 -->


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
                              <a href="#" data-href="{{ route($hyperlink['page']['delete']['evidence'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$data['main']->academic_qualification_id,'evidence_id'=>$value->evidence_id,'file_id'=>$value->file_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-evidence btn btn-danger text-white">
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


                </table>
                <!-- end table -->

            </div>
            <!-- end table responsive -->


          <!-- card footer -->
          <div class="card-footer">

            <!-- form control -->
            <div class="row text-end">

              <div class="col-md-12">
                <a href="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-light"><i class="bi bi-arrow-left"></i>Back</a>
                <input type="hidden" id="id" name="id" value="{{ $data['main']->academic_qualification_id }}">
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


    @if($data['main']->qualification_id != 'Q15')

      //Slide Up with custom duration and easing
      $('#group_qualification_other').slideUp(500,'swing',function(){
        $(this).addClass('d-none');  // Add d-none after sliding up is complete
      });

    @endif

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
