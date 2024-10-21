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
              <h4 class="card-title">Linkage Information</h4>
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

                <!-- linkage category id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="representation_category_id">Linkage Category</label>
                    <select class="form-control select2" id="linkage_category_id" name="linkage_category_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Linkage Category Exist --}}
                      @if(count($data['general']['linkage']['category']) > 0)

                        {{-- Get General Linkage Category Data --}}
                        @foreach($data['general']['linkage']['category'] as $key=>$value)
                          <option value="{{ $value->linkage_category_id }}" {{ ((old('linkage_category_id') == $value->linkage_category_id)?'selected':'') }}>{{ $value->name }}</option>
                        @endforeach
                        {{-- End Get General Linkage Category Level Data --}}

                      @endif
                      {{-- End Check General Linkage Category Level Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end linkage category id -->

                <!-- country id -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="country_id">Country</label>
                    <select class="form-control select2" id="country_id" name="country_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Country Exist --}}
                      @if(count($data['general']['country']) > 0)

                        {{-- Get General Country Data --}}
                        @foreach($data['general']['country'] as $key=>$value)
                          <option value="{{ $value->country_id }}" {{ ((old('country_id') == $value->country_id)?'selected':'') }}>{{ $value->country }}</option>
                        @endforeach
                        {{-- End Get General Country Data --}}

                      @endif
                      {{-- End Check General Country Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end representation category id -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- conferring body -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ old('date_start') }}" placeholder="">
                  </div>
                </div>
                <!-- end conferring body -->

                <!-- title -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Date End</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ old('date_end') }}" placeholder="">
                  </div>
                </div>
                <!-- end title -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- agreement level -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="agreement_level">Agreement Level</label>
                    <select class="form-control select2" id="agreement_level_id" name="agreement_level_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Agreement Level Exist --}}
                      @if(count($data['general']['agreement']['level']) > 0)

                        {{-- Get General Agreement Level Data --}}
                        @foreach($data['general']['agreement']['level'] as $key=>$value)
                          <option value="{{ $value->agreement_level_id }}" {{ ((old('agreement_level_id') == $value->agreement_level_id)?'selected':'') }}>{{ $value->name }}</option>
                        @endforeach
                        {{-- End Get General Agreement Level Data --}}

                      @endif
                      {{-- End Check General Agreement Level Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end agreement level -->

                <!-- agreement type -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="agreement_type">Agreement Type</label>
                    <select class="form-control select2" id="agreement_type_id" name="agreement_type_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Agreement Type Exist --}}
                      @if(count($data['general']['agreement']['type']) > 0)

                        {{-- Get General Agreement Type Data --}}
                        @foreach($data['general']['agreement']['type'] as $key=>$value)
                          <option value="{{ $value->agreement_type_id }}" {{ ((old('agreement_type_id') == $value->agreement_type_id)?'selected':'') }}>{{ $value->name }}</option>
                        @endforeach
                        {{-- End Get General Agreement Type Data --}}

                      @endif
                      {{-- End Check General Agreement Type Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end agreement type -->

              </div>
              <!-- end row 3 -->

              <!-- row 4 -->
              <div class="row">

                <!-- organization -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="conferring_body">Organization</label>
                    <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}" placeholder="Organization">
                  </div>
                </div>
                <!-- end organization -->

                <!-- title -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Linkage Title">
                  </div>
                </div>
                <!-- end title -->

              </div>
              <!-- end row 4 -->

              <!-- row 5 -->
              <div class="row">

                <!-- amount -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="">
                  </div>
                </div>
                <!-- end amount -->

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
