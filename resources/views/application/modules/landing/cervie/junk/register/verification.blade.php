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

        <!-- mobile number -->
        <div class="col-sm-12 text-start">
          <!-- error -->
          @if($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first('message') }}
            </div>
          @endif

          <label for="mobile_number" class="form-label">Please Verify Mobile Number You Registered this Table</label>
          <input type="number" class="form-control" id="mobile_number" name="mobile_number" value="0123212321">
        </div>
        <!-- end mobile number -->

      </div>
      <!-- end row 1 -->


      <!-- row 2 -->
      <div class="row g-3">

        <!-- form control -->
        <div class="col-sm-12 text-end">
          <button type="submit" class="btn btn-primary">Verify <i class="bi bi-arrow-right"></i></button>
        </div>
        <!-- end form control -->

      </div>
      <!-- end row 2 -->

    </div>
    <!-- end row -->

  </form>
  <!-- end form -->

</div>
<!-- end container -->


<script type="text/javascript">

/**************************************************************************************
Document On Load
**************************************************************************************/
$(document).ready(function($){

/**************************************************************************************
  Session
**************************************************************************************/
@if(Session('message'))
console.log(32);
  alertModal(
    {
      'modal_name':'modal-alert',
      'title':'{{ ucwords(Session::get('alert_type')) }}',
      'message':'{{ ucwords(Session::get('message')) }}'
    }
  );
@endif

});

</script>
@endsection
