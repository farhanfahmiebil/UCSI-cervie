<!-- navigation right -->
<div class="offcanvas offcanvas-end fade" id="offcanvasCart" tabindex="-1" aria-labelledby="offcanvasCart" aria-hidden="true">

  <!-- cart header -->
  <div class="offcanvas-header">
    <h5 class="mb-0">Your Order</h5>
    <button class="btn-close z-index-1" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!-- end cart header -->

  <!-- off canvas body -->
  <div id="cart" class="offcanvas-body">

      @php
        $total['overall'] = 0;
      @endphp

      {{-- Check Session Customer Cart Exist --}}
      @if(session()->has('customer.cart'))

        {{-- Get Data Customer Cart --}}
        @foreach(session()->get('customer.cart') as $key=>$value)

          <!-- item card -->
          <div class="card px-1 py-3 card-body flex-row border-0">
            <div class="me-3">
              <img src="assets/img/menu/dessert1.jpg" alt="" class="width-70 rounded-3 shadow">
            </div>
            <div class="flex-grow-1">
              <h6 class="mb-0">Sweet dessert</h6>
              <span class="d-inline-flex align-items-center my-1">Qty: {{ $value['quantity'] }}</span>
              <div>
                <span>6.00</span>
              </div>
            </div>
            <div>
              <a href="#!" class="text-muted">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x"
                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
              </a>
            </div>
          </div>
          <!-- end item card -->

        @endforeach
        {{-- Get Data Customer Cart --}}

      @else

        <!-- item card -->
        <div class="card px-1 py-3 card-body flex-row border-0">
          <div class="me-3">
            Your Cart is Empty
          </div>
        </div>
        <!-- end item card -->

      @endif
      {{-- Check Session Customer Cart Exist --}}

      <!-- <div class="me-3">
        <img src="assets/img/menu/dessert1.jpg" alt="" class="width-70 rounded-3 shadow">
      </div>
      <div class="flex-grow-1">
        <h6 class="mb-0">Sweet dessert</h6>
        <span class="d-inline-flex align-items-center my-1">Qty: 1</span>
        <div>
          <span>$6.00</span>
        </div>
      </div>
      <div>
        <a href="#!" class="text-muted">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
          </svg>
        </a>
      </div> -->

  </div>
  <!-- end off canvas body -->

  <!-- cart footer -->
  <div class="offcanvas-footer p-4 border-0 flex-column">
    <div class="mb-3 d-flex justify-content-between w-100">
      <p class="mb-0 flex-grow-1">SST (6%) </p>
      <h5 class="mb-0">RM{{ number_format($total['overall'],2) }}</h5>
    </div>
    <div class="mb-3 d-flex justify-content-between w-100">
      <p class="mb-0 flex-grow-1">SST (8%) </p>
      <h5 class="mb-0">RM{{ number_format($total['overall'],2) }}</h5>
    </div>
    <div class="mb-3 d-flex justify-content-between w-100">
      <p class="mb-0 flex-grow-1">Subtotal </p>
      <h5 class="mb-0">RM{{ number_format($total['overall'],2) }}</h5>
    </div>
    <div class="mb-3 d-flex justify-content-between w-100">
      <p class="mb-0 flex-grow-1">Total </p>
      <h5 class="mb-0">RM{{ number_format($total['overall'],2) }}</h5>
    </div>
    <div class="w-100">
      <a href="#" class="btn btn-primary w-100">Continue to Checkout Order</a>
    </div>
  </div>
  <!-- end cart footer -->

</div>
<!-- end navigation right -->
