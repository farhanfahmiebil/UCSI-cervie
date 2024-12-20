<!-- group publication book chapter -->
<div id="group_publication_book_chapter">

  <!-- row 2 -->
  <div class="row">

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
  <div class="row">

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
  <div class="row">

    <!-- publisher -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="publisher">Publisher</label>
        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}" placeholder="Publisher">
      </div>
    </div>
    <!-- end publisher -->

  </div>
  <!-- end row 4 -->

  <!-- row 5 -->
  <div class="row">

    <!-- day -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="day">Day <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="day" name="day" value="{{ old('day') }}" placeholder="Day">
      </div>
    </div>
    <!-- end day -->

    <!-- month -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="month">Month <small class="fst-italic">(Optional)</small></label>
        <input type="text" class="form-control" id="month" name="month" value="{{ old('month') }}" placeholder="Month">
      </div>
    </div>
    <!-- end month -->

    <!-- year -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="year">Year<small class="text-danger">*</small></label>
        <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}" placeholder="Year">
      </div>
    </div>
    <!-- end year -->

  </div>
  <!-- end row 5 -->

  <!-- row 6 -->
  <div class="row">

    <!-- volume -->
    <div class="col-4">
      <div class="form-group">
        <label for="volume">Volume</label>
        <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume') }}" placeholder="Volume">
      </div>
    </div>
    <!-- end volume -->

    <!-- edition -->
    <div class="col-4">
      <div class="form-group">
        <label for="edition">Edition</label>
        <input type="text" class="form-control" id="edition" name="edition" value="{{ old('edition') }}" placeholder="Edition">
      </div>
    </div>
    <!-- end edition -->

    <!-- page no -->
    <div class="col-4">
      <div class="form-group">
        <label for="page_no">Page No</label>
        <input type="text" class="form-control" id="page_no" name="page_no" value="{{ old('page_no') }}" placeholder="Page No">
      </div>
    </div>
    <!-- end page no -->

  </div>
  <!-- end row 6 -->

  <!-- row 7 -->
  <div class="row">

    <!-- isbn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="ISBN">
      </div>
    </div>
    <!-- end isbn -->

    <!-- issn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="issn">ISSN</label>
        <input type="text" class="form-control" id="issn" name="issn" value="{{ old('issn') }}" placeholder="ISSN">
      </div>
    </div>
    <!-- end issn -->

    <!-- eissn -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="eissn">eISSN</label>
        <input type="text" class="form-control" id="eissn" name="eissn" value="{{ old('eissn') }}" placeholder="eISSN">
      </div>
    </div>
    <!-- end eissn -->

  </div>
  <!-- end row 7 -->

  <!-- row 8 -->
  <div class="row">

    <!-- doi -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="doi">DOI</label>
        <input type="text" class="form-control" id="doi" name="doi" value="{{ old('doi') }}" placeholder="DOI">
      </div>
    </div>
    <!-- end doi -->

    <!-- quartile -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="quartile_id">Quartile</label>
        <select class="form-control select2" name="quartile_id">
          <option value="">--Please Select--</option>
          @if(count($data['general']['quartile']) > 0)
            @foreach($data['general']['quartile'] as $key => $value)
              <option value="{{ $value->quartile_id }}" {{ old('quartile_id') == $value->quartile_id ? 'selected' : '' }}>
                {{ $value->code }} - {{ $value->name }}
              </option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <!-- end quartile -->

    <!-- indexing body -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="academic_indexing_body_id">Indexing Body</label>
        <select class="form-control select2" id="academic_indexing_body_id" name="academic_indexing_body_id">
          <option value="">--Please Select--</option>
          @if(count($data['general']['academic']['indexing']['body']) > 0)
            @foreach($data['general']['academic']['indexing']['body'] as $key => $value)
              <option value="{{ $value->academic_indexing_body_id }}" {{ old('academic_indexing_body_id') == $value->academic_indexing_body_id ? 'selected' : '' }}>
                {{ $value->name }}
              </option>
            @endforeach
          @endif
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
        <input type="text" class="form-control" id="academic_indexing_body_other" name="academic_indexing_body_other" value="{{ old('academic_indexing_body_other') }}" placeholder="Other Indexing Body">
      </div>
    </div>
    <!-- end academic indexing body other -->

  </div>
  <!-- end row 9 -->

  <!-- row 10 -->
  <div class="row">

    <!-- sustainable development goal -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="sustainable_development_goal">Sustainable Development Goal</label>
        <select class="form-control select2" name="sustainable_development_goal_id[]" multiple>
          <option value="">--Please Select--</option>
          @if(count($data['general']['sustainable']['development']['goal']) > 0)
            @php
              $selected_sdg = old('sustainable_development_goal_id', []);
            @endphp
            @foreach($data['general']['sustainable']['development']['goal'] as $key => $value)
              <option value="{{ $value->sustainable_development_goal_id }}"
                {{ in_array($value->sustainable_development_goal_id, $selected_sdg) ? 'selected' : '' }}>
                {{ $value->code }} - {{ $value->name }}
              </option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <!-- end sustainable development goal -->

  </div>
  <!-- end row 10 -->

</div>
<!-- end group publication book chapter -->

<script type="text/javascript">
  $(document).ready(function() {
    //Auto Slide Up
    $('#group_academic_indexing_body_other').slideUp().addClass('d-none');

    // Get Toggle Academic Indexing Body Other
    toggleAcademicIndexingBodyOther();

    // Academic Indexing Body On Change
    $('#academic_indexing_body_id').on('change', function() {
      toggleAcademicIndexingBodyOther();
    });

    // Toggle Academic Indexing Body Other
    function toggleAcademicIndexingBodyOther() {
      var selected_value = $('#academic_indexing_body_id').val();
      if (selected_value === '18') {
        $('#group_academic_indexing_body_other').removeClass('d-none').slideDown();
      } else {
        $('#group_academic_indexing_body_other').slideUp(500, function() {
          $(this).addClass('d-none');
        });
        $('#academic_indexing_body_other').val('');
      }
    }
  });
</script>
