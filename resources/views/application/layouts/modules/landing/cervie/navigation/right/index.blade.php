<!-- navigation right -->
<div class="offcanvas offcanvas-end fade" id="offcanvasCart" tabindex="-1" aria-labelledby="offcanvasCart" aria-hidden="true">

  <!-- cart header -->
  <div class="offcanvas-header">
    <h5 class="mb-0">Your Order</h5>
    <button class="btn-close z-index-1" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!-- end cart header -->

  <!-- off canvas body -->
  <div class="offcanvas-body cart-item">

  </div>
  <!-- end off canvas body -->

  <!-- off canvas footer -->
  <div class="offcanvas-footer cart-calculation p-4 border-0 flex-column">

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
      <a href="{{ route($hyperlink['navigation']['cart']['checkout'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}" class="btn btn-primary w-100">Continue to Checkout Order</a>
    </div>

  </div>
  <!-- end off canvas footer -->

</div>
<!-- end navigation right -->

{{-- Plugin Cart --}}
@include(Config::get('routing.application.modules.landing.layout').'.plugin.cart.index')
