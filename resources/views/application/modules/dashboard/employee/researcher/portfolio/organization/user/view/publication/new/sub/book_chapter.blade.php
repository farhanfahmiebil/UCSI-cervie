<!-- group publication book chapter -->
<div id="group_publication_book_chapter">

  <!-- row 2 -->
  <div class="row pt-3">

    <!-- title -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Title">
      </div>
    </div>
    <!-- end title -->

  </div>
  <!-- end row 2 -->

  <!-- row 3 -->
  <div class="row pt-3">

    <!-- author -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="Author">
      </div>
    </div>
    <!-- end author -->

  </div>
  <!-- end row 3 -->

  <!-- row 4 -->
  <div class="row pt-3">

    <!-- name -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="publisher">Publisher</label>
        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}" placeholder="">
      </div>
    </div>
    <!-- end name -->

  </div>
  <!-- end row 4 -->

  <!-- row 5 -->
  <div class="row pt-3">

    <!-- day -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="day">Day <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="day" name="day" value="{{ old('day') }}" placeholder="">
      </div>
    </div>
    <!-- end day -->

    <!-- month -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="month">Month <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="month" name="month" value="{{ old('month') }}" placeholder="">
      </div>
    </div>
    <!-- end month -->

    <!-- year -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="year">Year<small class="text-danger">*</small></label>
        <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}" placeholder="">
      </div>
    </div>
    <!-- end year -->

  </div>
  <!-- end row 5 -->

  <!-- row 6 -->
  <div class="row pt-3">

    <div class="col-4">

      <div class="row pt-3">

        <!-- volume -->
        <div class="col-md-12">
          <div class="form-group">
            <label for="volume">Volume</label>
            <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume') }}" placeholder="">
          </div>
        </div>
        <!-- end volume -->

      </div>

    </div>

    <div class="col-4">

      <div class="row pt-3">

        <!-- edition -->
        <div class="col-md-12">
          <div class="form-group">
            <label for="issue">Edition</label>
            <input type="text" class="form-control" id="issue" name="issue" value="{{ old('issue') }}" placeholder="">
          </div>
        </div>
        <!-- end edition -->

      </div>

    </div>

    <div class="col-4">

      <div class="row pt-3">

        <!-- page no -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="page_no">Page No</label>
            <input type="text" class="form-control" id="page_no" name="page_no" value="{{ old('page_no') }}" placeholder="">
          </div>
        </div>
        <!-- end page no -->

        <!-- chapter no -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="chapter_no">Chapter No</label>
            <input type="text" class="form-control" id="chapter_no" name="chapter_no" value="{{ old('chapter_no') }}" placeholder="">
          </div>
        </div>
        <!-- end chapter no -->

      </div>

    </div>


  </div>
  <!-- end row 6 -->

  <!-- row 7 -->
  <div class="row pt-3">

    <!-- isbn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="">
      </div>
    </div>
    <!-- end isbn -->

    <!-- issn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="issn">ISSN</label>
        <input type="text" class="form-control" id="issn" name="issn" value="{{ old('issn') }}" placeholder="">
      </div>
    </div>
    <!-- end issn -->

    <!-- eissn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="eissn">eISSN</label>
        <input type="text" class="form-control" id="eissn" name="eissn" value="{{ old('eissn') }}" placeholder="">
      </div>
    </div>
    <!-- end eissn -->

  </div>
  <!-- end row 7 -->

  <!-- row 8 -->
  <div class="row pt-3">

    <!-- doi -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="doi">DOI</label>
        <input type="text" class="form-control" id="doi" name="doi" value="{{ old('doi') }}" placeholder="">
      </div>
    </div>
    <!-- end doi -->

    <!-- quartile -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="quartile_id">Quartile</label>
        <select class="form-control select2" name="quartile_id">
          <option value="">--Please Select--</option>
          {{-- Check General Quartile Exist --}}
          @if(count($data['general']['quartile'])>0)

            {{-- Get General Quartile Data --}}
            @foreach($data['general']['quartile'] as $key=>$value)
              <option value="{{ $value->quartile_id }}" {{ ((old('quartile_id') == $value->quartile_id)?'selected':'') }}>{{ $value->code }} - {{ $value->name }}</option>
            @endforeach
            {{-- End Get General Quartile Data --}}

          @endif
          {{-- End Check General Quartile Exist --}}
        </select>
      </div>
    </div>
    <!-- end quartile -->

    <!-- indexing body -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="indexing_body_id">Indexing Body</label>
        <select class="form-control select2" id="academic_indexing_body_id" name="academic_indexing_body_id">
          <option value="">--Please Select--</option>
          {{-- Check General Academic_Indexing Body Exist --}}
          @if(count($data['general']['academic']['indexing']['body'])>0)

            {{-- Get General Academic_Indexing Body Data --}}
            @foreach($data['general']['academic']['indexing']['body'] as $key=>$value)
              <option value="{{ $value->academic_indexing_body_id }}" {{ ((old('academic_indexing_body_id') == $value->academic_indexing_body_id)?'selected':'') }}>{{ $value->name }}</option>
            @endforeach
            {{-- End Get General Academic_Indexing Body Data --}}

          @endif
          {{-- End Check General Academic_Indexing Body Exist --}}
        </select>
      </div>
    </div>
    <!-- end indexing body -->

  </div>
  <!-- end row 8 -->

  <!-- row 9 -->
  <div id="group_academic_indexing_body_other" class="row">

    <!-- academic indexing body other -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="academic_indexing_body_other">Other - Indexing Body (Please State)</label>
        <input type="text" class="form-control" id="academic_indexing_body_other" name="academic_indexing_body_other" value="{{ old('academic_indexing_body_other') }}" placeholder="">
      </div>
    </div>
    <!-- end academic indexing body other -->

  </div>
  <!-- end row 9 -->

  <!-- row 10 -->
  <div class="row pt-3">

    <!-- sustainable development goal -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="sustainable_development_goal">Sustainable Development Goal</label>
        <select class="form-control select2" name="sustainable_development_goal_id[]" multiple>
          <option value="">--Please Select--</option>
          {{-- Check if Sustainable Development Goals exist --}}
          @if(count($data['general']['sustainable']['development']['goal']) > 0)

            @php
              // Get old values for sustainable development goals (array) if they exist
              $selected_sdg = old('sustainable_development_goal_id', []);
            @endphp

            {{-- Get Sustainable Development Goals Data --}}
            @foreach($data['general']['sustainable']['development']['goal'] as $key=>$value)
              <option value="{{ $value->sustainable_development_goal_id }}"
                {{-- Check if this value was previously selected --}}
                {{ in_array($value->sustainable_development_goal_id,$selected_sdg) ? 'selected' : '' }}>
                {{ $value->code }} - {{ $value->name }}
              </option>
            @endforeach
            {{-- End Get Sustainable Development Goals Data --}}

          @endif
          {{-- End Check if Sustainable Development Goals exist --}}
        </select>
      </div>
    </div>
    <!-- end sustainable development goal -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row 10 -->

</div>
<!-- end group publication book chapter -->

<script type="text/javascript">

  $(document).ready(function(){

    //Auto Slide Up
    $('#group_academic_indexing_body_other').slideUp().addClass('d-none');

    //Get Toggle Academic Indexing Body Other
    toggleAcademicIndexingBodyOther();

    //Academic Indexing Body On Change
    $('#academic_indexing_body_id').on('change',function(){

      //Get Toggle Academic Indexing Body Other
      toggleAcademicIndexingBodyOther();

    });

    //Toggle Academic Indexing Body Other
    function toggleAcademicIndexingBodyOther(){

      //Get Selected Value
      var selected_value = $('#academic_indexing_body_id').val();

      if (selected_value === '18'){

        //Slide Down
        $('#group_academic_indexing_body_other').removeClass('d-none').slideDown();

      }else{

        //Slide Up
        $('#group_academic_indexing_body_other').slideUp(500,function(){
          $(this).addClass('d-none');
        });

        //Set Null
        $('#academic_indexing_body_other').val('');
      }

    }

  });

</script>
