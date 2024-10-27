<!-- form -->
<form action="{{ route($hyperlink['page']['create'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" enctype="multipart/form-data" method="POST">
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
                        <option data-href="{{ route($hyperlink['page']['new'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'publication_type_id'=>$value->publication_type_id]) }}" value="{{ $value->publication_type_id }}" {{ ((old('publication_type_id') == $value->publication_type_id)?'selected':((request()->route('publication_type_id') == $value->publication_type_id)?'selected':'')) }}>{{ $value->name }}</option>
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
            @if(!empty(request()->route('publication_type_id')))

              {{-- Get Route Publication Type Data --}}
              @switch(request()->route('publication_type_id'))

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

<!-- Script for dynamic row numbering and file operations -->
<script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function(){

    /*  Publication Type on Change
    **************************************************************************************/
    $('#publication_type_id').on('change',function(){

      // Get the selected option
      var option = $(this).find('option:selected');

      // Get the data-href attribute of the selected option
      var hyperlink = option.data('href');

      // Log the data-href to the console
      console.log(hyperlink);

      // Optionally, redirect to the data-href if it's valid
      if(hyperlink){
       window.location.href = hyperlink;
      }

    });

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
    $('#month').on('input', function() {
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

  });
</script>
