@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['process'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no]) }}" method="POST">
    @csrf

    <!-- row -->
    <div class="row pb-5 mb-5 justify-content-center text-center border-primary border-xs-danger">

      <!-- row 1 -->
      <div class="row g-3">

        <!-- name -->
        <div class="col-sm-6 text-start">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="Walter Weish">
        </div>
        <!-- end name -->

        <!-- mobile number -->
        <div class="col-sm-6 text-start">
          <label for="mobile_number" class="form-label">Mobile Number</label>
          <input type="number" class="form-control" id="mobile_number" name="mobile_number" value="0123212321">
        </div>
        <!-- end mobile number -->

      </div>
      <!-- end row 1 -->

      <!-- row 2 -->
      <div class="row g-3">

        <!-- table no -->
        <div class="col-sm-6 text-start">
          <label for="table_no" class="form-label">Table No</label>
          <input type="text" class="form-control" id="table_no" name="table_no" value="{{ request()->table_no }}" disabled>
        </div>
        <!-- end table no -->

        <!-- pax no -->
        <div class="col-sm-6 text-start">
          <label for="pax_no" class="form-label">Pax No</label>
          <input type="text" class="form-control" id="pax_no" name="pax_no" value="1">
        </div>
        <!-- end pax no -->

      </div>
      <!-- end row 2 -->

      <!-- row 3 -->
      <div class="row g-3">

        <!-- form control -->
        <div class="col-sm-12 text-end">
          <button type="submit" class="btn btn-primary">Next <i class="bi bi-arrow-right"></i></button>
        </div>
        <!-- end form control -->

      </div>
      <!-- end row 3 -->

    </div>
    <!-- end row -->

  </form>
  <!-- end form -->

</div>
<!-- end container -->


<script type="text/javascript">

  $(document).ready(function(){

  });

</script>
@endsection
