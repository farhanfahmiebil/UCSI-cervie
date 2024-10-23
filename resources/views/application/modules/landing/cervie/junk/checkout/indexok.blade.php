@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <!-- checkout cart -->
  <div id="checkout-cart" class="checkout table-responsive">

    <!-- table -->
    <table class="table table-bordered">

      <thead class="table-danger">
        <th>#</th>
        <th class="col-md-6">Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th class="col-md-6">Remark</th>
        <th>Total</th>
        <th>Action</th>
      </thead>

      <tbody class="checkout-item"></tbody>

      <tfoot class="cart-calculation">

        <tr class="sst-6-row text-end">
          <th colspan="5">SST (6%)</th>
          <th>RM<span class="sst-6">0.00</span></th>
          <th>&nbsp;</th>
        </tr>

        <tr class="sst-8-row text-end">
          <th colspan="5">SST (8%)</th>
          <th>RM<span class="sst-8">0.00</span></th>
          <th>&nbsp;</td>
        </tr>

        <tr class="text-end">
          <th colspan="5">Subtotal</th>
          <th>RM<span class="subtotal">0.00</span></th>
          <th>&nbsp;</th>
        </tr>

        <tr class="text-end">
          <th colspan="5">Total</th>
          <th class="h4">RM<span class="total">0.00</span></th>
          <th>&nbsp;</th>
        </tr>

      </tfoot>

    </table>
    <!-- end table -->

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
