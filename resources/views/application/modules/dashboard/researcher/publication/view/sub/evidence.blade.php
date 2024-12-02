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

                  @if(!$data['main']->need_verification)
                  <!-- remove file -->
                  <a href="#" data-href="{{ route($hyperlink['page']['delete']['evidence'],['id'=>$data['main']->publication_id,'evidence_id'=>$value->evidence_id,'file_id'=>$value->file_id,'form_token'=>$form_token['delete']]) }}" class="btn-delete-evidence btn btn-danger text-white">
                    <i class="mdi mdi-trash-can"></i>
                  </a>
                  <!-- end remove file -->
                  @endif
                  
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
            new_row += '<label for="document_name">File Name for Evidence</label>';
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
