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

        {{-- Check Data Log --}}
        @if(!empty($data['cervie']['researcher']['log']['publication']) && isset($data['cervie']['researcher']['log']['publication']->updated_at) && $data['cervie']['researcher']['log']['publication']->updated_at != null)
            <div class="alert alert-warning" role="alert">
                <h4 class="card-title text-white">Old Values</h4>
                <ol class="list-group list-group-numbered">
                    {{-- Check if publication_type_name is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->publication_type_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Publication Type</div>
                                {{ $data['cervie']['researcher']['log']['publication']->publication_type_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if author is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->author))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Author</div>
                                {{ $data['cervie']['researcher']['log']['publication']->author }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if title is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->title))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Title</div>
                                {{ $data['cervie']['researcher']['log']['publication']->title }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if name is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Name</div>
                                {{ $data['cervie']['researcher']['log']['publication']->name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if publisher is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->publisher))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Publisher</div>
                                {{ $data['cervie']['researcher']['log']['publication']->publisher }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if day is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->day))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Day</div>
                                {{ $data['cervie']['researcher']['log']['publication']->day }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if month is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->month))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Month</div>
                                {{ $data['cervie']['researcher']['log']['publication']->month }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if year is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->year))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Year</div>
                                {{ $data['cervie']['researcher']['log']['publication']->year }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if volume is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->volume))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Volume</div>
                                {{ $data['cervie']['researcher']['log']['publication']->volume }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if issue is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->issue))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Issue</div>
                                {{ $data['cervie']['researcher']['log']['publication']->issue }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if doi is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->doi))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">DOI</div>
                                {{ $data['cervie']['researcher']['log']['publication']->doi }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if edition is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->edition))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Edition</div>
                                {{ $data['cervie']['researcher']['log']['publication']->edition }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if quartile is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->quartile_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Quartile</div>
                                {{ $data['cervie']['researcher']['log']['publication']->quartile_name }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if indexing body is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->academic_indexing_body_name))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Quartile</div>
                                {{ $data['cervie']['researcher']['log']['publication']->academic_indexing_body_name . (($data['cervie']['researcher']['log']['publication']->academic_indexing_body_id == 18)?$data['cervie']['researcher']['log']['publication']->academic_indexing_body_other:'') }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if isbn is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->isbn))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">ISBN</div>
                                {{ $data['cervie']['researcher']['log']['publication']->isbn }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if ISSN is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->issn))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">ISSN</div>
                                {{ $data['cervie']['researcher']['log']['publication']->issn }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if page no is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->page_no))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Page No</div>
                                {{ $data['cervie']['researcher']['log']['publication']->page_no }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if chapter_no is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->chapter_no))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Chapter No</div>
                                {{ $data['cervie']['researcher']['log']['publication']->chapter_no }}
                            </div>
                        </li>
                    @endif

                    {{-- Check if sustainable_development_goal is set --}}
                    @if(isset($data['cervie']['researcher']['log']['publication']->sustainable_development_goal))
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Sustainable Development Goal</div>
                                {{ $data['cervie']['researcher']['log']['publication']->sustainable_development_goal }}
                            </div>
                        </li>
                    @endif

                </ol>
            </div>
        @endif
        {{-- End Check Data Log --}}


        {{-- Check Data Evidence --}}
        @if(count($data['cervie']['researcher']['log']['evidence']) >= 1)
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
            <h4 class="card-title">Publication Information</h4>
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

              <!-- publication type id -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="publication_type_id">Publication Type</label>
                  <select class="form-control select2" id="publication_type_id" name="publication_type_id">
                    <option value="">-- Please Select --</option>

                    {{-- Check General Publication Type Exist --}}
                    @if(count($data['general']['publication']['type']) > 0)

                      {{-- Get General Publication Type Data --}}
                      @foreach($data['general']['publication']['type'] as $key=>$value)
                        <option value="{{ $value->publication_type_id }}" {{ (($data['main']->publication_type_id == $value->publication_type_id)?'selected':'') }}>{{ $value->name }}</option>
                      @endforeach
                      {{-- End Get General Publication Type Data --}}

                    @endif
                    {{-- End Check General Publication Type Exist --}}

                  </select>
                </div>
              </div>
              <!-- end publication type id -->

            </div>
            <!-- end row 1 -->

            {{-- Check Route Publication Type Exist --}}
            @if(!empty($data['main']->publication_type_id))

              {{-- Get Route Publication Type Data --}}
              @switch($data['main']->publication_type_id)

                {{-- 1 - Article --}}
                @case('1')

                  @include($page['sub'].'.article')

                @break

                {{-- 2 - Journal --}}
                @case('2')

                  @include($page['sub'].'.journal')

                @break

                {{-- 3 - Book --}}
                @case('3')

                  @include($page['sub'].'.book')

                @break

                {{-- 4 - Book Chapter --}}
                @case('4')

                  @include($page['sub'].'.book_chapter')

                @break


              @endswitch
              {{-- End Get Route Publication Type Data --}}

              {{-- Evidence --}}
              @include($page['sub'].'.evidence')

            @endif
            {{-- Check Route Publication Type Exist --}}

          </div>
          <!-- card body -->

          <!-- card footer -->
          <div class="card-footer">

            <!-- form control -->
            <div class="row text-end">

              <div class="col-md-12">
                <a href="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-light"><i class="mdi mdi-arrow-left"></i>Back</a>
                <input type="hidden" id="id" name="id" value="{{ $data['main']->publication_id }}">
                <input type="hidden" id="publication_type_id" name="publication_type_id" value="{{ $data['main']->publication_type_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                <a data-href="{{ route($hyperlink['page']['delete']['main'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn-delete-main btn btn-danger text-white me-2"><i class="bi bi-trash"></i>Delete Record</a>
                <button type="submit" class="btn btn-danger text-white me-2"><i class="bi bi-content-save"></i>Save</button>
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

    /*  Day
    **************************************************************************************/
    $('#day').on('input',function(){
      validateDay({
        'input': {
          'id': $(this).attr('id'),
          'day': $(this).val()
        }
      });
    });

    /*  Validate Day
    **************************************************************************************/
    function validateDay(data){
      var day_pattern = /^\d{0,2}$/; // Allows 0 to 2 digits

      // Check if input contains only digits and is a valid length
      if(!day_pattern.test(data.input.day)){
        $('#' + data.input.id).val(data.input.day.slice(0, -1)); // Remove the last character
      }

      // If input has two digits (complete input)
      if (data.input.day.length === 2) {
        var day_value = parseInt(data.input.day, 10);
        if (day_value < 1 || day_value > 31) {
          alert('Please enter a valid day between 1 and 31.');
          $('#' + data.input.id).val(''); // Clear the input if out of range
        }
      }
    }


    /*  Month
    **************************************************************************************/
    $('#month').on('input', function(){
      validateMonth({
        'input': {
          'id': $(this).attr('id'),
          'month': $(this).val()
        }
      });
    });

    /*  Validate Month
    **************************************************************************************/
    function validateMonth(data){
      var month_pattern = /^\d{0,2}$/; // Allows 0 to 2 digits

      // Check if input contains only digits and is a valid length
      if (!month_pattern.test(data.input.month)) {
        $('#' + data.input.id).val(data.input.month.slice(0,-1)); // Remove the last character
      }

      // If input has two digits (complete input)
      if (data.input.month.length === 2){
        var month_value = parseInt(data.input.month,10);
        if (month_value < 1 || month_value > 12) {
          alert('Please enter a valid month between 1 and 12.');
          $('#' + data.input.id).val(''); // Clear the input if out of range
        }
      }
    }


    /*  Year
    **************************************************************************************/
    $('#year').on('input',function(){
      validateYear({
        'input': {
          'id': $(this).attr('id'),
          'year': $(this).val()
        }
      });
    });

    /*  Validate Year
    **************************************************************************************/
    function validateYear(data){
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

  });
</script>
