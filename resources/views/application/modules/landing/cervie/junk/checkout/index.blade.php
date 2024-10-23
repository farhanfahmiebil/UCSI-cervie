@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <!-- checkout cart -->
  <div class="checkout mx-2" id="checkout-cart">

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
    <div class="offcanvas-footer cart-calculation p-4 border-0 flex-column h5">

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

      <div class="w-100">
        <a href="{{ route($hyperlink['page']['process'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}" class="btn btn-primary w-100">Continue to Checkout Order</a>
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
    refreshCart('checkout');

  });

</script>
@endsection
