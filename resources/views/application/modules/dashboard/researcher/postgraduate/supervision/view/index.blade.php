@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update']) }}" enctype="multipart/form-data" method="POST">
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
              <h4 class="card-title">Postgraduate Supervision Information</h4>
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

                <!-- project title -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="project_title">Project Title</label>
                    <input type="text" class="form-control" id="project_title" name="project_title" value="{{ $data['main']->project_title }}" placeholder="">
                  </div>
                </div>
                <!-- end project title -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- student id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $data['main']->student_id }}" placeholder="">
                  </div>
                </div>
                <!-- end student id -->

                <!-- student name -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="student_name">Student Name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" value="{{ $data['main']->student_name }}" placeholder="">
                  </div>
                </div>
                <!-- end student name -->

                </div>
                <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- institution name -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="institution_name">Institution Name</label>
                    <input type="text" class="form-control" id="institution_name" name="institution_name" value="{{ $data['main']->institution_name }}">
                  </div>
                </div>
                <!-- end institution name -->

                <!-- qualification id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="qualification_id">Qualification</label>
                    <select class="form-control select2" id="qualification_id" name="qualification_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Qualification Exist --}}
                      @if(count($data['general']['qualification']) > 0)

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
              <!-- end row 3 -->

              <!-- row 4 -->
              <div class="row">

                <!-- field of study -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="field_study">Field of Study</label>
                    <input type="text" class="form-control" id="field_study" name="field_study" value="{{ $data['main']->field_study }}" placeholder="Software Engineering">
                  </div>
                </div>
                <!-- end field of study -->

              </div>
              <!-- end row 4 -->

              <!-- row 5 -->
              <div class="row">

                <!-- study mode -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="study_mode_id">Mode of Study</label>
                    <select class="form-control select2" id="study_mode_id" name="study_mode_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Study Mode Exist --}}
                      @if(count($data['general']['study']['mode']) > 0)

                        {{-- Get General Study Mode Data --}}
                        @foreach($data['general']['study']['mode'] as $key=>$value)
                          <option value="{{ $value->study_mode_id }}" {{ (($data['main']->study_mode_id == $value->study_mode_id)?'selected':'') }}>{{ $value->study_mode_name }}</option>
                        @endforeach
                        {{-- End Get General Study Mode Data --}}

                      @endif
                      {{-- End Check General Study Mode Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end study mode -->

                <!-- sponsorship id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sponsorship_id">Sponsorship</label>
                    <select class="form-control select2" id="sponsorship_id" name="sponsorship_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Sponsorship Exist --}}
                      @if(count($data['general']['sponsorship']) > 0)

                        {{-- Get General Sponsorship Data --}}
                        @foreach($data['general']['sponsorship'] as $key=>$value)
                          <option value="{{ $value->sponsorship_id }}" {{ (($data['main']->sponsorship_id == $value->sponsorship_id)?'selected':'') }}>{{ $value->sponsorship_name }}</option>
                        @endforeach
                        {{-- End Get General Sponsorship Data --}}

                      @endif
                      {{-- End Check General Sponsorship Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end sponsorship id -->

              </div>
              <!-- end row 5 -->

              <!-- row 6 -->
              <div class="row">

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
                    <div class="d-flex bd-highlight">
                      <div class="flex-grow-1 bd-highlight">
                        <label for="date_end">Date End</label>
                      </div>
                      <div class="bd-highlight">
                        <label for="is_ongoing" class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="is_ongoing" name="is_ongoing" value="1" {{ (($data['main']->is_ongoing) ?'checked':'') }}>
                          Is On Going
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ (!empty($data['main']->date_end)?\Carbon\Carbon::parse($data['main']->date_end)->format('Y-m-d'):null) }}" placeholder="">
                  </div>
                </div>
                <!-- end date end -->

              </div>
              <!-- end row 6 -->

              <!-- row 7 -->
              <div class="row">

                <!-- status id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check Education Status Exist --}}
                      @if(count($data['education']['status']) > 0)

                        {{-- Get Education Status Data --}}
                        @foreach($data['education']['status'] as $key=>$value)
                          <option value="{{ $value->status_id }}" {{ (($data['main']->status_id == $value->status_id)?'selected':'') }}>{{ ucwords($value->status_name) }}</option>
                        @endforeach
                        {{-- End Get Education Status Data --}}

                      @endif
                      {{-- End Check Education Status Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end status id -->

              </div>
              <!-- end row 7 -->

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
                      <thead class="bg-danger text-white mx-3">

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
                                <a href="{{ $hyperlink['document'].$value->file_id.'.'.$value->file_extension }}" class="btn btn-primary" target="_blank">
                                  <i class="mdi mdi-link"></i>
                                </a>
                                <!-- end hyperlink -->

                                <!-- remove file -->
                                <a href="#" data-href="{{ route($hyperlink['page']['delete']['evidence'],['id'=>$data['main']->postgraduate_supervision_id,'evidence_id'=>$value->evidence_id,'file_id'=>$value->file_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-evidence btn btn-danger text-white">
                                  <i class="mdi mdi-trash-can"></i>
                                </a>
                                <!-- end remove file -->

                              @else
                              <p>-</p>
                              @endif
                            </td>

                          </tr>

                        @endforeach
                        {{-- End Get Data Evidence --}}

                      @else

                      <tr>
                        <td class="row-number">1</td>
                        <td>
                          <div class="form-group">
                            <label for="file_name">File Name for Evidence</label>
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
                          new_row += '<label for="file_name">File Name for Evidence</label>';
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

            </div>
            <!-- card body -->

            <!-- card footer -->
            <div class="card-footer">

              <!-- form control -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light"><i class="mdi mdi-arrow-left"></i>Back</a>
                  <input type="hidden" id="id" name="id" value="{{ $data['main']->postgraduate_supervision_id }}">
                  <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                  <a data-href="{{ route($hyperlink['page']['delete']['main']) }}" class="btn-delete-main btn btn-danger text-white me-2"><i class="mdi mdi-trash-can"></i>Delete Record</a>
                  <button type="submit" class="btn btn-danger text-white me-2"><i class="mdi mdi-content-save"></i>Save</button>
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
          @if(Session('message'))
          Swal.fire({
          title: '{{ ucwords(Session::get('alert_type')) }}',
          text: '{{ ucwords(Session::get('message')) }}',
          icon: '{{ strtolower(Session::get('alert_type')) }}'
          });
          @endif

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
            Is Current OnGoing
          **************************************************************************************/
          $('#is_ongoing').on('click',function(){
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
              $('#is_ongoing').prop('checked', false);
            }else{
              // If Date End is cleared, allow 'Is Lifetime' to be checked
              $('#is_ongoing').prop('checked', true);
            }
          });

          });
          </script>

          @endsection