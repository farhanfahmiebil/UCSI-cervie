<!-- group publication article -->
<div id="group_publication_article">

  <!-- row 2 -->
  <div class="row">

    <!-- title -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="title">Title<small class="text-danger">*</small></label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Title">
      </div>
    </div>
    <!-- end title -->

  </div>
  <!-- end row 2 -->

  <!-- row 3 -->
  <div class="row">

    <!-- author -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="author">Author<small class="text-danger">*</small></label>
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="Author">
      </div>
    </div>
    <!-- end author -->

  </div>
  <!-- end row 3 -->

  <!-- group academic detail -->
  <div class="group_academic_detail">

    <!-- row 4 -->
    <div class="row">

      <!-- name -->
      <div class="col-md-12">
        <div class="form-group">
          <label for="name">Article Name<small class="text-danger">*</small></label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="">
        </div>
      </div>
      <!-- end name -->

    </div>
    <!-- end row 4 -->

  </div>
  <!-- end group academic detail -->

  <!-- row 5 -->
  <div class="row">

    <!-- name -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="publisher">Publisher <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}" placeholder="">
      </div>
    </div>
    <!-- end name -->

  </div>
  <!-- end row 5 -->

  <!-- row 6 -->
  <div class="row">

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
  <!-- end row 6 -->

  <!-- row 7 -->
  <div class="row">

    <!-- volume -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="volume">Volume</label>
        <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume') }}" placeholder="">
      </div>
    </div>
    <!-- end volume -->

    <!-- issue -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="issue">Issue</label>
        <input type="text" class="form-control" id="issue" name="issue" value="{{ old('issue') }}" placeholder="">
      </div>
    </div>
    <!-- end issue -->

    <!-- page no -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="page_no">Page No</label>
        <input type="text" class="form-control" id="page_no" name="page_no" value="{{ old('page_no') }}" placeholder="">
      </div>
    </div>
    <!-- end page no -->

  </div>
  <!-- end row 7 -->

  <!-- row 8 -->
  <div class="row">

    <!-- isbn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="isbn">ISBN <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="">
      </div>
    </div>
    <!-- end isbn -->

    <!-- issn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="issn">ISSN <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="issn" name="issn" value="{{ old('issn') }}" placeholder="">
      </div>
    </div>
    <!-- end issn -->

    <!-- eissn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="eissn">eISSN <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="eissn" name="eissn" value="{{ old('eissn') }}" placeholder="">
      </div>
    </div>
    <!-- end eissn -->

  </div>
  <!-- end row 8 -->

  <!-- row 9 -->
  <div class="row">

    <!-- doi -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="doi">DOI <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="doi" name="doi" value="{{ old('doi') }}" placeholder="">
      </div>
    </div>
    <!-- end doi -->

    <!-- indexing body -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="academic_indexing_body_id">Indexing Body<small class="text-danger">*</small></label>
        <select class="form-control select2" name="academic_indexing_body_id">
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

  </div>
  <!-- end row 9 -->

  <!-- row 10 -->
  <div class="row">

    <!-- sustainable development goal -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="sustainable_development_goal_id">Sustainable Development Goal</label>
        <select class="form-control select2" name="sustainable_development_goal_id[]" multiple>
          <option value="">--Please Select--</option>
          {{-- Check General Sustainable Development Goal Exist --}}
          @if(count($data['general']['publication']['type'])>0)

            {{-- Get General Sustainable Development Goal Data --}}
            @foreach($data['general']['sustainable']['development']['goal'] as $key=>$value)
              <option value="{{ $value->sustainable_development_goal_id }}" {{ ((old('sustainable_development_goal_id') == $value->sustainable_development_goal_id)?'selected':'') }}>{{ $value->code }} - {{ $value->name }}</option>
            @endforeach
            {{-- End Get General Sustainable Development Goal Data --}}

          @endif
          {{-- End Check General Sustainable Development Goal Exist --}}
        </select>
      </div>
    </div>
    <!-- end sustainable development goal -->

  </div>
  <!-- end row 10 -->

</div>
<!-- end group publication article -->
