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
              <h4 class="card-title">Community Engagement Information</h4>
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

                <!-- organization -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="organization">Organization</label>
                    <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}" placeholder="Organization">
                  </div>
                </div>
                <!-- end organization -->

                <!-- project name -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="project_name">Project Name</label>
                    <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name') }}" placeholder="Project Name">
                  </div>
                </div>
                <!-- end project name -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- sponsor -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sponsor">Sponsor</label>
                    <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor') }}" placeholder="Sponsor">
                  </div>
                </div>
                <!-- end sponsor -->

                <!-- amount -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Amount">
                  </div>
                </div>
                <!-- end amount -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

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
              <!-- end row 3 -->

              <!-- row 4 -->
              <div class="row">

                <!-- description -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Description">
                  </div>
                </div>
                <!-- end description -->

                <!-- Star Rating -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount">Star Rating</label>
                        <div id="star-rating" class="text-warning mb-3">
                            <i class="star mdi mdi-star" data-value="1"></i>
                            <i class="star mdi mdi-star" data-value="2"></i>
                            <i class="star mdi mdi-star" data-value="3"></i>
                            <i class="star mdi mdi-star" data-value="4"></i>
                            <i class="star mdi mdi-star" data-value="5"></i>
                        </div>
                        <input type="hidden" name="star_rating" id="rating-input">
                    </div>
                </div>
                <!-- end Star Rating -->

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
                    <table class="table" id="evidence-table">

                      <!-- thead -->
                      <thead>

                        @php
                          // Set Checkbox Status
                          $checkbox['status'] = false;
                        @endphp

                        {{-- Check Table Column Exist --}}
                        @if(isset($data['table']['column']['cervie']['researcher']['evidence']) && count($data['table']['column']['cervie']['researcher']['evidence']) >= 1)

                          {{-- Get Table Column Data --}}
                          @foreach($data['table']['column']['cervie']['researcher']['evidence'] as $key => $value)

                              {{-- Check if the column is of category 'checkbox' --}}
                              @if(isset($value['category']) && $value['category'] == 'checkbox')

                                @php
                                  // Set Checkbox Status
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

                    /* Star Rating
                    **************************************************************************************/
                    const stars = document.querySelectorAll('.star');
                    const ratingInput = document.getElementById('rating-input');
                    let selectedRating = 0;

                    stars.forEach(star => {
                        star.addEventListener('click', () => {
                            selectedRating = star.getAttribute('data-value');
                            updateStars();
                            ratingInput.value = selectedRating; // Set the hidden input value
                        });
                    });

                    //Update Stars
                    function updateStars() {
                        stars.forEach(star => {
                            star.classList.remove('selected');
                            if (star.getAttribute('data-value') <= selectedRating) {
                                star.classList.add('selected');
                            }
                        });
                    }

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
                          new_row += '<i class="mdi-alpha-x text-white"></i>';
                          new_row += '</a>';
                          new_row += '</td>';
                          new_row += '</tr>';

                     $('#evidence-table tbody').append(new_row); // Use the correct ID here

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

              {{-- Team Member Need --}}
              @if($data['cervie']['researcher']['table']['control']->team_member_need)

              <hr>

              <!-- card title -->
              <h4 class="card-title">Community Involvement</h4>
              <!-- end card title -->

              <!-- row 1 -->
              <div class="row">

                  <!-- table responsive -->
                  <div class="table-responsive">

                      <!-- table -->
                      <table class="table" id="team-member-table">

                          <!-- thead -->
                          <thead>
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
                                          <label for="representation_role_id">Role</label><br>
                                          <select style="width:100%;" class="form-control select2" name="representation_role_id[]">
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
                      new_row += '<select class="form-control select2" name="representation_role_id[]">';
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
                      new_row += '<a href="#" class="btn btn-warning remove-team-member">';
                      new_row += '<i class="mdi-alpha-x text-white"></i>';
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

@endsection
