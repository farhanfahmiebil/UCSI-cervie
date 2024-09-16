@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container pt-5 mt-5">

  <!-- row 3 -->
  <div class="row g-3 py-5 my-5">

    <div class="col-md-12 text-center">
    <h4>Your Order Has Been Submitted to Kitchen. Please wait While we are preparing your Order.</h4>
      <div class="animation-loader">
        <h1>Cooking in progress</h1>
        <div class="cooking">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class=area>
                <div class="sides">
                    <div class="pan"></div>
                    <div class="handle"></div>
                </div>
                <div class="pancake">
                    <div class="pastry"></div>
                </div>
            </div>
        </div>
      </div>
    </div>

  </div>
  <!-- end row 3 -->

</div>
<!-- end container -->

<!-- container -->
<div class="container">

  <!-- row -->
  <div class="row pt-5 mt-5 justify-content-center text-center border-primary border-xs-danger">

    <!-- row 1 -->
    <div class="row g-3">

      <!-- name -->
      <div class="col-sm-6 text-start">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" value="{{ $data['customer']['table']['header']->name }}" disabled>
      </div>
      <!-- end name -->

      <!-- mobile number -->
      <div class="col-sm-6 text-start">
        <label for="mobile_number" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" value="{{ $data['customer']['table']['header']->mobile_number }}" disabled>
      </div>
      <!-- end mobile number -->

    </div>
    <!-- end row 1 -->

    <!-- row 2 -->
    <div class="row g-3">

      <!-- table no -->
      <div class="col-sm-6 text-start">
        <div class="row">

          <div class="col-sm-6 text-start">
            <label for="table_no" class="form-label">Table No</label>
            <input type="text" class="form-control" id="table_no" name="table_no" value="{{ $data['customer']['table']['header']->table_no }}" disabled>
          </div>

          <div class="col-sm-6 text-start">
            <label for="pax_no" class="form-label">Pax No</label>
            <input type="text" class="form-control" id="pax_no" name="pax_no" value="{{ $data['customer']['table']['header']->pax_no }}" disabled>
          </div>

        </div>
      </div>
      <!-- end table no -->

      <!-- table no -->
      <div class="col-sm-6 text-start">
        <div class="row">

          <div class="col-sm-6 text-start">
            <label for="reference_no" class="form-label">Reference</label>
            <input type="text" class="form-control" id="reference_no" name="reference_no" value="{{ $data['outlet']['store']->table_abbreviation }}_{{ strtoupper($data['outlet']['store']->outlet_id) }}_{{ $data['customer']['table']['header']->order_id }}" disabled>
          </div>

          <div class="col-sm-6 text-start">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ strtoupper($data['customer']['table']['header']->status) }}" disabled>
          </div>

        </div>
      </div>
      <!-- end table no -->

    </div>
    <!-- end row 2 -->

  </div>
  <!-- end row -->

</div>
<!-- end container -->

<!-- container -->
<div class="container">

  <!-- checkout cart -->
  <div class="checkout mx-2 pt-5" id="checkout-cart">


    <!-- cart header -->
    <div class="offcanvas-header">
      <h5 class="mb-0">Your Order</h5>
    </div>
    <!-- end cart header -->

    <!-- off canvas body -->
    <div class="offcanvas-body checkout-item">

      <div class="wrapper">
        <div class="loader"></div>
        <div class="wording">
          <div class="letter">L</div>
          <div class="letter">o</div>
          <div class="letter">a</div>
          <div class="letter">d</div>
          <div class="letter">i</div>
          <div class="letter">n</div>
          <div class="letter">g</div>
          <div class="letter circle"></div>
          <div class="letter circle"></div>
          <div class="letter circle"></div>
        </div>
      </div>

    </div>
    <!-- end off canvas body -->

    <!-- off canvas footer -->
    <div class="offcanvas-footer d-flex p-1 cart-calculation border-0 flex-column h5">

      <div class="mb-3 d-flex justify-content-between w-100 sst-6-row">
        <p class="mb-0 flex-grow-1">SST (6%) </p>
        <h5 class="mb-0">RM<span class="sst-6">0.00</span></h5>
      </div>

      <div class="mb-3 d-flex justify-content-between w-100 sst-8-row">
        <p class="mb-0 flex-grow-1">SST (8%) </p>
        <h5 class="mb-0">RM<span class="sst-8">0.00</span></h5>
      </div>

      <div class="mb-3 d-flex justify-content-between w-100">
        <p class="mb-0 flex-grow-1">Subtotal </p>
        <h5 class="mb-0">RM<span class="subtotal">0.00</span></h5>
      </div>

      <div class="mb-3 d-flex justify-content-between w-100">
        <p class="mb-0 flex-grow-1">Total </p>
        <h5 class="mb-0">RM<span class="total">0.00</span></h5>
      </div>

    </div>
    <!-- end off canvas footer -->

  </div>
  <!-- end checkout cart -->

</div>
<!-- end container -->


<script type="text/javascript">

  $(document).ready(function(){

    //Refresh Cart Total
    refreshCartTotal();

    //Refresh Cart
    refreshCart('submit');

  });

</script>

@endsection
