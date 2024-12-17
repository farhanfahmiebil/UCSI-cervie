<!-- form -->
<form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" enctype="multipart/form-data" method="POST">
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
            <h4 class="card-title">Profile Information</h4>
            <!-- end card title -->

            <hr>

            <!-- alert -->
            <div class="col-12">

            {{-- Check Data Main --}}
            @if($data['researcher']->need_verification_main)

            <div class="alert alert-warning" role="alert">
              This Record is still Pending for Administrator to make Verification
            </div>

            @if(count(get_object_vars($data['cervie']['researcher']['log']['researcher'])) === 0)
            <div class="alert alert-warning" role="alert">
              <i class="bi bi-check-circle me-2"></i> This record is new entry
            </div>
            @endif


            {{-- Check Data Log --}}
            @if(!empty($data['cervie']['researcher']['log']['researcher']) && isset($data['cervie']['researcher']['log']['researcher']->updated_at) && $data['cervie']['researcher']['log']['researcher']->updated_at != null)
                <div class="alert alert-warning" role="alert">
                    <h4 class="card-title text-white">Old Values</h4>
                    <ol class="list-group list-group-numbered">
                        {{-- Check if registration_no is set --}}
                        @if(isset($data['cervie']['researcher']['log']['researcher']->description))
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Linkage Category</div>
                                    {{ $data['cervie']['researcher']['log']['researcher']->description }}
                                </div>
                            </li>
                        @endif

                    </ol>
                </div>
            @endif
            {{-- End Check Data Log --}}

            @else
            <div class="alert alert-success" role="alert">
              <i class="bi bi-check-circle me-2"></i> Record Verified
            </div>


            @endif
            {{-- End Check Data Main --}}

          </div>
          <!-- end alert -->

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

                <!-- col -->
                <div class="col-sm-12 col-12">

                  <!-- row -->
                  <div class="row">

                    <!-- col -->
                    <div class="col-12">

                      <!-- description -->
                      <div class="mb-3">
                        <label for="salutation_id" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ $data['researcher']->description }}</textarea>
                      </div>
                      <!-- end description -->

                    </div>
                    <!-- end col -->

                  </div>
                  <!-- end row -->

                  @if(count($data['cervie']['researcher']['indexing']['body']) > 0)

                    {{-- Iterate through available Academic Indexing Body --}}
                    @foreach($data['cervie']['researcher']['indexing']['body'] as $k=>$v)
                    <!-- row 2 -->
                    <div class="row pt-3">

                      <!-- academic indexing body -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="salutation_id">Indexing Body</label>
                          <select class="form-control academic_indexing_body_id select2" name="academic_indexing_body_id[]">
                            <option value="">--Please Select--</option>
                            {{-- Check if Academic Indexing Body exist --}}
                            @if(count($data['general']['academic']['indexing']['body']) > 0)

                              {{-- Iterate through available Academic Indexing Body --}}
                              @foreach($data['general']['academic']['indexing']['body'] as $key=>$value)
                                <option value="{{ $value->academic_indexing_body_id }}" {{($value->academic_indexing_body_id == $v->academic_indexing_body_id)?'selected':''}}>{{ $value->name }}
                                </option>
                              @endforeach

                            @endif
                          </select>
                        </div>
                      </div>
                      <!-- end academic indexing body -->

                      <!-- title -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="hyperlink" class="form-label">Hyperlink</label>
                          <input type="text" class="form-control" name="hyperlink[]" placeholder="Hyperlink" value="{{$v->hyperlink}}">
                          <input type="hidden" name="indexing_body_id[]" value="{{$v->indexing_body_id}}">

                        </div>
                      </div>
                      <!-- end title -->

                    </div>
                    <!-- end row 2 -->
                    @endforeach
                  @else

                  <!-- row 2 -->
                  <div class="row pt-3">

                    <!-- academic indexing body -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="salutation_id">Indexing Body</label>
                        <select class="form-control academic_indexing_body_id select2" name="academic_indexing_body_id[]">
                          <option value="">--Please Select--</option>
                          {{-- Check if Academic Indexing Body exist --}}
                          @if(count($data['general']['academic']['indexing']['body']) > 0)

                            {{-- Iterate through available Academic Indexing Body --}}
                            @foreach($data['general']['academic']['indexing']['body'] as $key=>$value)
                              <option value="{{ $value->academic_indexing_body_id }}" >{{ $value->name }}
                              </option>
                            @endforeach

                          @endif
                        </select>
                      </div>
                    </div>
                    <!-- end academic indexing body -->

                    <!-- title -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="hyperlink" class="form-label">Hyperlink</label>
                        <input type="text" class="form-control"  id="hyperlink" name="hyperlink[]" placeholder="Hyperlink" value="">
                      </div>
                    </div>
                    <!-- end title -->

                  </div>
                  <!-- end row 2 -->


                  @endif

                  <div id="add-indexing-body" class="pt-3">

                  </div>

                  <div class="row text-center pt-3">

                    <div class="col-12">
                      <button type="button" class="btn btn-primary add-new-file"><i class="bi bi-plus"></i>Add New Indexing Body</button>
                    </div>
                  </div>


                </div>
                <!-- end col -->

              </div>
              <!-- end date award -->

          </div>
          <!-- card body -->

          <!-- card footer -->
          <div class="card-footer">

            <!-- form control -->
            <div class="row text-end">

              <div class="col-md-12">
                <input type="hidden" name="employee_id" value="{{ request()->employee_id }}">
                <input type="hidden" name="organization_id" value="{{ request()->organization_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
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
<script>
/**************************************************************************************
  Document On Load
**************************************************************************************/
$(document).ready(function(){

  $('.add-new-file').click(function() {
      // Add a new row to the form
      var new_row = '';
      new_row += '<div class="row">';

      // Academic Indexing Body Column
      new_row += '<div class="col-md-6">';
      new_row += '<div class="form-group">';
      new_row += '<label for="salutation_id">Indexing Body</label>';
      new_row += '<select class="form-control academic_indexing_body_id select2" name="academic_indexing_body_id[]">';
      new_row += '<option value="">--Please Select--</option>';

      // Loop through the indexing bodies passed from Laravel
      @foreach($data['general']['academic']['indexing']['body'] as $indexingBody)
          new_row += '<option value="{{ $indexingBody->academic_indexing_body_id }}">{{ $indexingBody->name }}</option>';
      @endforeach

      new_row += '</select>';
      new_row += '</div>';
      new_row += '</div>';

      // Hyperlink Column
      new_row += '<div class="col-md-5">';  // Slightly smaller width for the remove button
      new_row += '<div class="form-group">';
      new_row += '<label for="hyperlink" class="form-label">Hyperlink</label>';
      new_row += '<input type="text" class="form-control" name="hyperlink[]" placeholder="Hyperlink" value="">';
      new_row += '</div>';
      new_row += '</div>';

      // Remove Button Column with Bootstrap Icon
      new_row += '<div class="col-md-1">';
      new_row += '<div class="form-group pt-4">';
      new_row += '<button type="button" class="btn btn-danger remove-row"><i class="bi bi-trash"></i></button>';
      new_row += '</div>';
      new_row += '</div>';

      new_row += '</div>'; // End row

      $('#add-indexing-body').append(new_row); // Append new row

      // Re-initialize Select2 on the new dropdowns
      $('.select2').select2();
  });

  // Handle remove row
  $(document).on('click', '.remove-row', function() {
      $(this).closest('.row').remove(); // Remove the parent row of the clicked button
  });

  });

</script>
