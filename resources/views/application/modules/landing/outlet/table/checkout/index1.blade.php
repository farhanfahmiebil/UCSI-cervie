@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <div id="checkout-cart" class="checkout table-responsive">

    <table class="table table-bordered">

      <thead>
        <th>#</th>
        <th class="col-md-6">Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th class="col-md-6">Remark</th>
        <th>Total</th>
      </thead>

      <tbody>
        @php
          $total['sst_6'] = 0;
          $total['sst_8'] = 0;
          $total['subtotal'] = 0;
          $total['total'] = 0;
          $image = [];
        @endphp

        {{-- Check Customer Cart Exist --}}
        @if(count($data['main']) > 0)

          @php

            // Check if item_image is not null or empty
            $image['menu'] = !empty($value->item_image) ? 'data:image/jpeg;base64,'.base64_encode($item->item_image) : asset('images\default\no_image.png');

          @endphp

          {{-- Get Data Customer Cart --}}
          @foreach($data['main'] as $key=>$value)
            <tr class="align-middle">
              <td>{{ ($key + 1) }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="{{ $image['menu'] }}" class="card-img-top bg-item-image item-logo-checkout rounded" alt="Image Item {{ $value->item_id }}">
                  <label for="" class="ps-3">{{ $value->item_description }}</label>
                </div>
              </td>
              <td>{{ $value->item_price }}</td>
              <td><input type="text" class="form-control update-item-quantity quantity" maxlength="2" name="quantity" onkeypress="return inputSetting('number',event)" value="{{ $value->item_quantity }}"></td>
              <td>
                <textarea class="form-control lock" name="remark" rows="3" cols="80">{!! $value->item_price !!}</textarea>
              </td>
              <td>{{ $value->item_total }}</td>
            </tr>
          @endforeach
          {{-- Get Data Customer Cart --}}

        @endif
        {{-- End Get Data Customer Cart --}}

      </tbody>

      <tfoot>

        <!-- sst 6 -->
        <tr>
          <td colspan='5' class="text-end">SST (6%)</td>
          <td>{{ $total['sst_6'] }}</td>
        </tr>
        <!-- sst 6 -->

        <tr>
          <td colspan='5' class="text-end">SST (6%)</td>
          <td>{{ $total['sst_6'] }}</td>
        </tr>

        <tr>
          <td colspan='5' class="text-end">Subtotal</td>
          <td>{{ $total['sst_6'] }}</td>
        </tr>

        <tr>
          <td colspan='5' class="text-end">Total</td>
          <td>{{ $total['sst_6'] }}</td>
        </tr>

      </tfoot>

    </table>
  </div>

</div>
<!-- end container -->

@endsection
