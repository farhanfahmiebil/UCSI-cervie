@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <!-- form -->
  <form action="#" method="POST">
    @csrf

    <!-- row -->
    <div class="row pb-5 mb-5 justify-content-center text-center border-primary border-xs-danger">

      <!-- row 1 -->
      <div class="row g-3">

        <!-- name -->
        <div class="col-sm-6 text-start">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="value" value="{{ $data['customer']['table']['header']->name }}">
        </div>
        <!-- end name -->

        <!-- mobile number -->
        <div class="col-sm-6 text-start">
          <label for="mobile_number" class="form-label">Mobile Number</label>
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $data['customer']['table']['header']->mobile_number }}">
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
              <input type="text" class="form-control" id="table_no" name="table_no" value="{{ $data['customer']['table']['header']->table_no }}">
            </div>

            <div class="col-sm-6 text-start">
              <label for="pax_no" class="form-label">Pax No</label>
              <input type="text" class="form-control" id="pax_no" name="pax_no" value="{{ $data['customer']['table']['header']->pax_no }}">
            </div>

          </div>
        </div>
        <!-- end table no -->

        <!-- pax no -->
        <div class="col-sm-6 text-start">
          <label for="reference_no" class="form-label">Reference</label>
          <input type="text" class="form-control" id="reference_no" name="reference_no" value="{{ $data['outlet']['store']->table_abbreviation }}_{{ strtoupper($data['outlet']['store']->outlet_id) }}_{{ $data['customer']['table']['header']->order_id }}">
        </div>
        <!-- end pax no -->

      </div>
      <!-- end row 2 -->

      <!-- row 3 -->
      <div class="row g-3">

        <!-- form control -->
        <!-- <div class="col-sm-12 text-end">
          <button type="submit" class="btn btn-primary">Update n <i class="bi bi-arrow-right"></i></button>
        </div> -->
        <!-- end form control -->

      </div>
      <!-- end row 3 -->

    </div>
    <!-- end row -->

  </form>
  <!-- end form -->

</div>
<!-- end container -->

<!-- section customer information -->
<section class="position-relative overflow-hidden bg-light">
  <div class="container text-center position-relative">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-10">
        <h2 class="display-4 mb-3 mx-auto">
          Choose Your Menu
        </h2>
      </div>
    </div>
  </div>
</section>
<!-- end section customer information -->

<!-- container -->
<div class="container">

  <!-- wrapper menu -->
  <div class="wrapper_menu">

    <!-- menu nav -->
  	<nav id="menu_navigation" class="menu_nav dragscroll mouse-scroll" role="tablist">

      <!-- container fluid -->
      <div class="container-fluid navigation-tab-scroller">

        <!-- tab wrapper -->
        <div class="tab-wrapper">
          <ul class="tabs">

            {{-- Check Data Outlet Menu Category Sub Exist --}}
            @if(count($data['outlet']['menu']['category']['sub']) > 1)

              <li data-id="item-search" class="">
                <i class="bi bi-search"></i>
              </li>

              {{-- Get Data Outlet Menu Category Sub Exist --}}
              @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

                <li data-id="item-{{ $k }}" class="{{ (($k==0)?'active':'') }}">{{ strtoupper($v->category_sub_name) }}</li>

              @endforeach
              {{-- End Get Data Outlet Menu Category Exist --}}

            @endif
            {{-- End Check Data Outlet Menu Category Exist --}}

          </ul>
        </div>
        <span class="next"><i class="bi bi-arrow-right"></i></span>
        <span class="previous"><i class="bi bi-arrow-left"></i></span>
      </div>
      <!-- end tab wrapper -->

    </nav>
    <!-- end menu nav -->

    <!-- tab content -->
    <div class="tab-content">

      {{-- Check Data Outlet Menu Category Sub Exist --}}
      @if(count($data['outlet']['menu']['category']['sub']) > 1)

        <!-- content search -->
        <div class="content item-search" style="display:none">

          <div class="input-group mb-3">
            <input type="text" id="search-text" class="form-control" placeholder="Search Menu" aria-describedby="basic-addon2">
            <span class="input-group-text" id="search-button" id="basic-addon2"><i class="bi bi-search"></i></span>
          </div>

          <!-- row -->
          <div id="result-search" class="row row-cols-1 row-cols-md-5 g-4">

          </div>
          <!-- end row -->

        </div>
        <!-- end content search -->

        {{-- Get Data Outlet Menu Category Sub --}}
        @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

          <!-- content -->
          <div class="content item-{{ $k }}">

            {{-- Check Data Item Menu Exist --}}
            @if(count($data['outlet']['menu']['item']) > 1)

              <!-- row -->
              <div class="row row-cols-1 row-cols-md-5 g-4">

                {{-- Get Data Outlet Menu Exist --}}
                @foreach($data['outlet']['menu']['item'] as $item)

                  {{-- If Category Sub Match with Category Sub in Sub --}}
                  @if($v->category_sub_id == $item->category_sub_id)

                    @php

                      // Check if item_image is not null or empty
                      //$image['menu'] = !empty($item->item_image) ? 'data:image/jpeg;base64,'.base64_encode($item->item_image) : asset('images\default\no_image.png');
                      $image['menu'] = !empty($item->item_image) ? 'data:image/jpeg;base64,'.base64_encode($item->item_image) : (in_array($v->category_id,['1','12'])?asset('images\default\no_image_food.png'):(in_array($v->category_id,['2','13'])?asset('images\default\no_image_drink.png'):asset('images\default\no_image.png')));

                    @endphp

                    <!-- col -->
                    <div id="item-id-{{ $item->item_id }}" class="col">
                      <div class="card h-100">
                        <img src="{{ $image['menu'] }}" class="card-img-top bg-item-image" alt="Image Item {{ $item->item_id }}" style="height:150px;width:100%;">
                        <div class="card-body">
                          <h6 class="card-title item-name">{{ $item->item_name }}{{ $v->category_id }}</h6>
                          <p class="card-text"></p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                          <p class="d-grid text-center d-flex justify-content-center">
                            RM<span class="item-amount">{{ $item->item_price }}</span>
                          </p>
                        </div>

                        <div class="card-footer bg-transparent border-0 justify-content-center">
                          <div class="d-flex product-data quantity-box">
                            <div class="p-2 box-decrement flex-shrink-1">
                              <label class="btn-decrement">
                                <i class="bi bi-dash"></i>
                              </label>
                            </div>
                            <div class="p-2 flex-grow-1 box-input">
                              <input type="text" class="text-center w-100" name="quantity" value="1"/>
                            </div>
                            <div class="p-2 box-increment flex-shrink-1">
                              <label class="btn-increment">
                                <i class="bi bi-plus"></i>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 justify-content-center">
                          <small class="d-grid">
                            <button type="button" class="cart-button btn btn-primary" name="item" value="{{ $item->item_id }}">
                              <span class="add-to-cart">Add to Cart</span>
                              <span class="status"></span>
                            	<i class="bi bi-cart-check"></i>
                            	<i class="bi bi-boxes"></i>
                            </button>
                          </small>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                  @endif
                  {{-- End If Category Match with Category in Sub --}}

                @endforeach

              </div>
              <!-- end row -->

            @endif
            {{-- End Check Data Item Menu Exist --}}

          </div>
          <!-- end content -->

        @endforeach
        {{-- End Get Data Outlet Menu Category Sub --}}

      @endif
      {{-- End Check Data Outlet Menu Category Sub Exist --}}

    </div>
    <!-- end tab content -->

  </div>
  <!-- end wrapper menu -->

</div>
<!-- end container -->

<script type="text/javascript">

  $(document).ready(function(){

    $('.btn-increment').click(function(e){

      e.preventDefault();

      var value_increment = $(this).closest('.product-data').find('.box-input input').val();

      var value = parseInt(value_increment, 10);
      value = isNaN(value) ? 0 : value;
      if(value < 10){
        value++;
        $(this).closest('.product-data').find('.box-input input').val(value);
      }

    });

    $('.btn-decrement').click(function(e){

      e.preventDefault();

      var value_decrement = $(this).closest('.product-data').find('.box-input input').val();
      var value = parseInt(value_decrement, 10);
      value = isNaN(value) ? 0 : value;
      if(value > 1){
          value--;
          $(this).closest('.product-data').find('.box-input input').val(value);
      }

    });

    $('.wrapper_menu .tab-content .content').slice(2).toggle();

    // hide the previous button
    $('.wrapper_menu .previous').hide();

    $('.wrapper_menu .tabs li').click(function(){

       if($(this).is(':last-child')){
         $('.next').hide();
       }else{
         $('.next').show();
       }

       if($(this).is(':first-child')){
         $('.previous').hide();
       }else{
         $('.previous').show();
       }

       var position = $(this).position();
       var corresponding = $(this).data("id");

       // scroll to clicked tab with a little gap left to show previous tabs
       scroll = $('.wrapper_menu .tabs').scrollLeft();

       $('.wrapper_menu .tabs').animate({
         'scrollLeft': scroll + position.left - 30
       },200);

       // hide all content divs
       $('.wrapper_menu .tab-content .content').hide();

       // show content of corresponding tab
       $('.wrapper_menu div.' + corresponding).toggle();

       // remove active class from currently not active tabs
       $('.wrapper_menu .tabs li').removeClass('active');

       // add active class to clicked tab
       $(this).addClass('active');

    });

    $('.wrapper_menu div a').click(function(e){
      e.preventDefault();
      $('.wrapper_menu li.active').next('li').trigger('click');
    });

    $('.wrapper_menu .next').click(function(e){
      e.preventDefault();
      $('.wrapper_menu li.active').next('li').trigger('click');
    });

    $('.wrapper_menu .previous').click(function(e){
      e.preventDefault();
      $('.wrapper_menu li.active').prev('li').trigger('click');
    });

    $('#search-text').on('keydown', function(event) {

      $('#result-search').html('');
      var search = $(this).val().toLowerCase();
        if(event.keyCode === 13) { // Check if Enter key was pressed
          searchMenuItems(
            {
              'search':search
            }
          );

        }
    });

       // Function to search items
  function searchMenuItems(data){

    var counter = 0;

    // Iterate through each item in the item search list
    $('.tab-content .content[class*="item-"] .card').each(function(){
      var item_raw_id = $(this).parent().attr('id');
      var item_id = item_raw_id.split('-').pop();
      // console.log(item_id);
      var item_name = $('#'+item_raw_id+' .item-name').text().toLowerCase(); // Get item name and convert to lowercase
      var item_amount = $('#'+item_raw_id+' .item-amount').text().toLowerCase();
      var item_image = $('#'+item_raw_id+' .card-img-top').attr('src');
      // console.log(item_image);
      // SL CAFE LATTE
      // console.log(data.search);
      // Check if the item name contains the search term
      if(item_name.includes(data.search)){

  var html = '';
        html += '<div class="col">';
          html += '<div class="card h-100">';
            html += '<img src="'+item_image+'" class="card-img-top" alt="Image Item '+item_id+' " style="height:150px;width:100%;">';
              html += '<div class="card-body">';
                html += '<h6 class="card-title">'+item_name+'</h6>';
                html += '<p class="card-text"></p>';
              html += '</div>';
            html += '<div class="card-footer bg-transparent border-0">';
              html += '<p class="d-grid text-center">';
              html += 'RM'+item_amount;
              html += '</p>';
            html += '</div>';
            html += '<div class="card-footer bg-transparent border-0">';
            html += '<small class="d-grid">';
            html += '<button type="button" class="cart-button btn btn-primary" name="item" value="'+item_id+'">';
            html += '<span class="add-to-cart">Add to Cart</span>';
            html += '<span class="status"></span>';
            html += '<i class="bi bi-cart-check"></i>';
            html += '<i class="bi bi-boxes"></i>';
            html += '</button>';

            html += '</small>';
              html += '</div>';
          html += '</div>';
        html += '</div>';

        $('#result-search').append(html);

        counter +=1;
      }

    });

    console.log(counter);

    if(!counter){

      var html = '';
        html += '<div class="col-md-12">';
        html += '<div class="card h-100">';
        html += '<div class="card-body">';
        html += 'Search for {'+data.search+'} Menu Item Not Found';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#result-search').append(html);

    }
  }

  $('.cart-button').on('click',function(){

     //Set Button
     var this_cart = $(this);
     var item_id = $(this).val();
     var quantity = $('#item-id-'+item_id+' .box-input input').val();

     //Set Header
     $.ajaxSetup({
       'headers':{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
       }
     });

     //Set Request
     $.ajax({
       'type':'GET',
       'url':'{{ route($hyperlink['page']['ajax']['cart']['insert'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}',
       'data':{
         'item_id':item_id,
         'quantity':quantity,
       },

       //Before Send
       beforeSend:function(){

         //Add Class to Button
         this_cart.addClass('clicked');
         this_cart.find('.status').html('Processing');

       },

       //Success
       success:function(data){

        //console.log(data);

        //Check Data Length
        if(data.result){

          this_cart.find('.status').html('Item Added');

          refreshCart('cart');
          refreshCartTotal();

        }else{

          //Set Data
          this_cart.find('.status').html('Item Failed to Added');

        }

      },

      //Done
      done:function(data, textStatus, xhr){

        //Add Class to Button
        this_cart.find('.status').html('22 Added');

      },

      //Error
      error:function(data, textStatus, xhr){

        //Add Class to Button
        this_cart.find('.status').html('Error');

      },

      //Fail
      fail:function(data, textStatus, xhr){

        //Add Class to Button
        this_cart.find('.status').html('Error Added');

      },

      //Complete
      complete:function(){

        // Remove the 'clicked' class after a delay
        setTimeout(function(){
          this_cart.removeClass('clicked');
        }, 2000);

      }

     });

  });

});

</script>

@endsection
