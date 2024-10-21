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
              <h4 class="card-title">Consultantcies Information</h4>
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

                <!-- client -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client" value="{{ old('client') }}" placeholder="Client">
                  </div>
                </div>
                <!-- end client -->

                <!-- title -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Title">
                  </div>
                </div>
                <!-- end title -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- amount -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="amount">Gross Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="amount">
                  </div>
                </div>
                <!-- end amount -->

                <!-- reference no -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="{{ old('reference_no') }}" placeholder="Reference No">
                  </div>
                </div>
                <!-- end reference no -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- description -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" rows="4" class="form-control" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                  </div>
                </div>
                <!-- end description -->

              </div>
              <!-- end row 3 -->

              <!-- row 4 -->
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
              <!-- end row 4 -->

              <!-- row 5 -->
              <div class="row">

                <!-- Country -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control select2" name="country[]" multiple>
                      <option value="">--Please Select--</option>
                      {{-- Check if Country exist --}}
                      @if(count($data['general']['country']) > 0)

                        @php
                          // Get old values for Country (array) if they exist
                          $selected_country = old('country', []);
                        @endphp

                        {{-- Get Country Data --}}
                        @foreach($data['general']['country'] as $key=>$value)
                          <option value="{{ $value->country_id }}"
                            {{-- Check if this value was previously selected --}}
                            {{ in_array($value->country_id,$selected_country) ? 'selected' : '' }}>
                            {{ $value->country }}
                          </option>
                        @endforeach
                        {{-- End Get Country Data --}}

                      @endif
                      {{-- End Check if Country exist --}}
                    </select>
                  </div>
                </div>
                <!-- end Country -->

              </div>
              <!-- end row 5 -->

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

              <!-- end row 1 -->

              {{-- Script for dynamic row numbering and file operations --}}
              <script type="text/javascript">
                  $(document).ready(function() {
                      checkFileCount();

                      /* Add New File Row */
                      $('.add-new-file').click(function() {
                          var new_row = '';
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

                          $('#evidence-table tbody').append(new_row);
                          recalculateRowNumbers();
                          checkFileCount();
                      });

                      /* Remove File Row */
                      $(document).on('click', '.remove-file', function(e) {
                          e.preventDefault();
                          $(this).closest('tr').remove();
                          recalculateRowNumbers();
                          checkFileCount();
                      });

                      /* Recalculate Row Numbers */
                      function recalculateRowNumbers() {
                          $('#evidence-table tbody tr').each(function(index) {
                              $(this).find('.row-number').text(index + 1);
                          });
                      }

                      /* Check File Count and Hide/Show Add Button */
                      function checkFileCount() {
                          var file_count = $('#evidence-table tbody tr').length;
                          var limit = '{{ $data['cervie']['researcher']['table']['control']->evidence_upload_count }}';

                          if (file_count >= limit) {
                              $('.add-new-file').hide();
                          } else {
                              $('.add-new-file').show();
                          }
                      }

                      // Initial recalculation in case of pre-existing rows
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
                                          <select class="form-control select2" name="representation_role_id[]">
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
                      new_row += '<td colspan="2">';
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
