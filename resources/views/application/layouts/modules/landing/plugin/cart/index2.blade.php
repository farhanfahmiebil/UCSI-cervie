<script type="text/javascript">

  $(document).ready(function(){

    //Refresh Cart Total
    refreshCartTotal();

    //Refresh Cart
    refreshCart('cart');

  });

  /**************************************************************************************
  	Refresh Cart Total
  **************************************************************************************/
  function refreshCartTotal(){

    //Set Header
    $.ajaxSetup({
      'headers':{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    //Set Request
    $.ajax({
      'type':'GET',
      'url':'{{ route($hyperlink['navigation']['ajax']['cart']['total'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}',
      'data':{},

      success:function(item){

        var html = '';

        $('#cart-icon').removeClass('bi-cart');

       //Check Data Length
       if(item.result){

         //Set Cart Total
         $('#cart-icon').addClass('bi-cart-check-fill');
         $('#cart-total').html(item.result);

       }else{

         //Set Cart Total
         $('#cart-icon').addClass('bi-cart');
         $('#cart-total').html(0);

       }

     },

     error:function(data, textStatus, xhr){

       //Set Cart Total
       $('#cart-total').html(0);

     }

    });

  }

  /**************************************************************************************
  	Refresh Cart
  **************************************************************************************/
  function refreshCart(category){

    var html = '';

    var total = {
      'sst_6':0.00,
      'sst_8':0.00,
      'subtotal':0.00,
      'total':0.00,
    };

    //Set Header
    $.ajaxSetup({
      'headers':{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    //Set Request
    $.ajax({
      'type':'GET',
      'url':'{{ route($hyperlink['navigation']['ajax']['cart']['list'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}',
      'data':{},

      beforeSend:function(){

      },
      success:function(item){
// console.log(item.result.length)
       //Check Data Length
       if(item.result.length){

         $.each(item.result,function(key,value){
// console.log(value.item_description+'-'+value.item_is_taxable+'-'+value.item_tax_rate+'-'+value.item_tax);
           if(value.item_is_taxable){

              switch(value.item_tax_rate){

                case '6.00':  console.log(value.item_description+'-'+value.item_is_taxable+'-'+value.item_tax_rate+'-'+value.item_tax);
                  total.sst_6 += parseFloat(value.item_tax);
                break;

                case '8.00': console.log(value.item_description+'-'+value.item_is_taxable+'-'+value.item_tax_rate+'-'+value.item_tax);
                  total.sst_8 += parseFloat(value.item_tax);
                break;

              }
           }


           total.subtotal += parseFloat(value.item_total);
           total.total += parseFloat(value.item_total_amount);

           html += generateMenuItem(
             {
               'category':category,
               'key':key,
               'value':value
             }
           );

          });

          switch(category){

            case 'cart':

              $('#offcanvasCart .cart-item').html(html);

              if(total.sst_6 <= 0){
                $('#offcanvasCart .cart-calculation .sst-6-row').addClass('d-none');
              }else{
                $('#offcanvasCart .cart-calculation .sst-6-row').removeClass('d-none');
              }

              if(total.sst_8 <= 0){ console.log(1221);
                $('#offcanvasCart .cart-calculation .sst-8-row').addClass('d-none');
              }else{
                $('#offcanvasCart .cart-calculation .sst-8-row').removeClass('d-none');
              }

              $('#offcanvasCart .cart-calculation .sst-6').html(total.sst_6.toFixed(2));
              $('#offcanvasCart .cart-calculation .sst-8').html(total.sst_8.toFixed(2));
              $('#offcanvasCart .cart-calculation .subtotal').html(total.subtotal.toFixed(2));
              $('#offcanvasCart .cart-calculation .total').html(total.total.toFixed(2));

              $('#offcanvasCart .delete-cart').on('click',function(){

                Swal.fire({
                  title: 'Warning!',
                  text: 'Do you want to Delete Item?',
                  icon: 'error',
                  showDenyButton: true,
                  confirmButtonText: 'Yes',
                  denyButtonText: 'No',
                }).then((result) => {
                  if (result.isConfirmed) {

                    var id = $(this).parent().parent().data('order-body-id');

                    deleteCartItem(
                      {
                        'category':category,
                        'item':{
                          'order_body_id':id
                        }
                      }
                    );

                    Swal.fire('Cart Item Removed', '', 'success')

                  } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                  }

                })

              });

              $('#offcanvasCart .update-item-quantity').on('change',function(){

                var id = $(this).parent().parent().parent().data('order-body-id');

                updateItem(
                  {
                    'category':category,
                    'item':{
                      'order_body_id':id,
                      'quantity':$(this).val()
                    }
                  }
                );

              });

            break;

            case 'checkout':

              $('#checkout-cart .checkout-item').html(html);
              if(total.sst_6 <= 0){
                $('#checkout-cart .cart-calculation .sst-6-row').addClass('d-none');
              }else{
                $('#checkout-cart .cart-calculation .sst-6-row').removeClass('d-none');
              }

              if(total.sst_8 <= 0){
                console.log(32);
                $('#checkout-cart .cart-calculation .sst-8-row').addClass('d-none');
              }else{
                $('#checkout-cart .cart-calculation .sst-8-row').removeClass('d-none');
              }

              $('#checkout-cart .cart-calculation .sst-6').html(total.sst_6.toFixed(2));
              $('#checkout-cart .cart-calculation .sst-8').html(total.sst_8.toFixed(2));
              $('#checkout-cart .cart-calculation .subtotal').html(total.subtotal.toFixed(2));
              $('#checkout-cart .cart-calculation .total').html(total.total.toFixed(2));

              $('#checkout-cart .delete-cart').on('click',function(){

                Swal.fire({
                  title: 'Warning!',
                  text: 'Do you want to Delete Item?',
                  icon: 'error',
                  showDenyButton: true,
                  confirmButtonText: 'Yes',
                  denyButtonText: 'No',
                }).then((result) => {
                  if (result.isConfirmed) {

                    var id = $(this).parent().parent().data('order-body-id');

                    deleteCartItem(
                      {
                        'category':category,
                        'item':{
                          'order_body_id':id
                        }
                      }
                    );

                    Swal.fire('Cart Item Removed', '', 'success')

                  } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                  }

                })

              });

              $('#checkout-cart .update-item-quantity').on('change',function(){

                var id = $(this).parent().parent().data('order-body-id');

                updateItem(
                  {
                    'category':category,
                    'input_category':'quantity',
                    'item':{
                      'order_body_id':id,
                      'quantity':$(this).val()
                    }
                  }
                );

              });

              $('#checkout-cart .update-item-remark').on('change',function(){

                var id = $(this).parent().parent().data('order-body-id');

                updateItem(
                  {
                    'category':category,
                    'input_category':'remark',
                    'item':{
                      'order_body_id':id,
                      'remark':$(this).val()
                    }
                  }
                );

              });

            break;

            default:
            break;



          }

       }else{
         console.log('empty');

         html += generateMenuItem(
           {
             'category':category,
             'key':0,
             'value':{}
           }
         );

         $('#'+category+'-item').html(html);

       }

      },

      error:function(data,textStatus,xhr){

       //Add Class to Button
       // this_cart.find('.status').html('Error');

      }

    });

    function generateMenuItem(data){

      var html = '';

      var image = ((data.value.item_image) ? 'data:image/jpeg;base64,' + data.value.item_image : '{{ asset('images/default/no_image.png') }}');

      //Get Data Category
      switch(data.category){

        //Cart
        case 'cart':

          if(Object.keys(data.value).length != 0){

            html += '<div class="card px-1 py-3 card-body flex-row border-0" data-order-body-id="'+data.value.order_body_id+'">';

              html += '<div class="me-3">';
                html += '<img src="' + image + '" alt="' + (data.value.item_image ? 'Image' : 'No Image') + '" class="width-70 rounded-3 shadow">';
              html += '</div>';

              html += '<div class="flex-grow-1">';
              html += '<h6 class="mb-0">'+data.value.item_description+'</h6>';
              html += '<span class="d-inline-flex align-items-center my-1">Qty: <input type="text" class="update-item-quantity quantity" maxlength="2" name="quantity" onkeypress="return inputSetting(\'number\',event)" value="'+data.value.item_quantity+'"></span>';
              html += '<div>';
                html += '<span>RM'+data.value.item_price+'</span>';
              html += '</div>';
              html += '</div>';

              html += '<div>';

                html += '<a href="#" class="delete-cart text-muted">';
                html += '<i class="bi bi-x"></i>'
                html += '</a>';

              html += '</div>';

            html += '</div>';

          }
          else {

            //Set Data
            html += '<div class="card px-1 py-3 card-body flex-row border-0">';
              html += '<div class="me-3">';
                html += 'Your Cart is Empty';
              html += '</div>';
            html += '</div>';

          }


        break;

        case 'checkout':

          if(Object.keys(data.value).length != 0){

            html += '<div class="card px-1 py-3 card-body flex-row border border-top-1" data-order-body-id="'+data.value.order_body_id+'">';

              html += '<div class="me-3">';
                html += '<img src="' + image + '" alt="' + (data.value.item_image ? 'Image' : 'No Image') + '" class="width-70 rounded-3 shadow">';
              html += '</div>';

              html += '<div class="flex-grow-1">';
              html += '<h6 class="mb-0">'+data.value.item_description+'</h6>';
              html += '<span class="d-inline-flex align-items-center my-1">Qty: <input type="text" class="form-control update-item-quantity quantity" maxlength="2" name="quantity" onkeypress="return inputSetting(\'number\',event)" value="'+data.value.item_quantity+'"></span>';
              html += '<div class="d-flex">';
                html += '<div class="mr-auto price-control">';
                  html += '<span>'+data.value.item_quantity+'</span>';
                  html += '<span> x </span>';
                  html += '<span>RM'+data.value.item_price+'</span>';
                html += '</div>';

                html += '<div>';
                  html += '<span class="h5">RM'+data.value.item_total+'</span>';
                html += '</div>';
              html += '</div>';
              html += '</div>';

              html += '<div>';

                html += '<a href="#" class="delete-cart text-muted">';
                html += '<i class="bi bi-trash text-danger h5"></i>'
                html += '</a>';

              html += '</div>';

            html += '</div>';

          }
          else {

            //Set Data
            html += '<div class="card px-1 py-3 card-body flex-row border-0">';
              html += '<div class="me-3">';
                html += 'Your Cart is Empty';
              html += '</div>';
            html += '</div>';

          }

        break;

        case 'checkout1':

          if(Object.keys(data.value).length != 0){

            html += '<tr class="align-middle" data-order-body-id="'+data.value.order_body_id+'">';
              html += '<td>'+((data.key)+1)+'</td>';
              html += '<td>';
                html += '<div class="d-flex align-items-center">';
                  html += '<img src="' + image + '" alt="' + (data.value.item_image ? 'Image' : 'No Image') + '" class="card-img-top bg-item-image item-logo-checkout rounded">';
                  html += '<label for="" class="ps-3">'+data.value.item_description+'</label>';
                html += '</div>';
              html += '</td>';
              html += '<td>RM'+data.value.item_price+'</td>';
              html += '<td><input type="text" class="form-control update-item-quantity quantity" maxlength="2" name="quantity" onkeypress="return inputSetting(\'number\',event)" value="'+data.value.item_quantity+'"></td>';
              html += '<td>';
                html += '<textarea class="form-control lock update-item-remark" name="remark" rows="3" cols="80">'+data.value.item_order_remark+'</textarea>';
              html += '</td>';
              html += '<td class="text-end">RM'+data.value.item_total+'</td>';
              html += '<td>';
              html += '<a href="#" class="delete-cart text-muted">';
              html += '<i class="bi bi-x"></i>'
              html += '</a>';
              html += '</td>';
            html += '</tr>';

          }
          else{

            //Set Data
            html += '<tr class="align-middle">';
              html += '<th colspan="6" class="text-center">';
                html += '<i class="bi bi-cart"></i>';
                html += 'Your Cart is Empty';
              html += '</th>';
            html += '</tr>';

          }

        break;

        default:

        break

      }

      return html;

    }
    /**************************************************************************************
    	Update Item Quantity
    **************************************************************************************/
    function updateItem(data){
      // console.log(data);

      // //Set Input
      var input = {
        'category':data.category,
        'order_body_id':data.item.order_body_id,
      };

      //Check Category
      switch(data.input_category){

        //Quantity
        case 'quantity':

          input = {
            'category':data.category,
            'input_category':data.input_category,
            'order_body_id':data.item.order_body_id,
            'quantity':data.item.quantity
          };

        break;

        //Quantity
        case 'remark':

        input = {
          'category':data.category,
          'input_category':data.input_category,
          'order_body_id':data.item.order_body_id,
          'remark':data.item.remark
        };
          // input.remark = data.item.remark;

        break;

      }

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['navigation']['ajax']['cart']['update'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}',
        'data':input,

        beforeSend:function(){
    // console.log(this_cart);
          //Add Class to Button
          // this_cart.addClass('clicked');
          // this_cart.find('.status').html('Processing');

        },
        success:function(item){

         //Check Data Length
         if(item.result){

           refreshCart(data.category);
           refreshCartTotal();

         }

        },

        error:function(item, textStatus, xhr){

         //Add Class to Button
         // this_cart.find('.status').html('Error');

        }

      });

    }

    /**************************************************************************************
    	Delete Cart Item
    **************************************************************************************/
    function deleteCartItem(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['navigation']['ajax']['cart']['delete'],['outlet_id'=>request()->outlet_id,'table_no'=>request()->table_no,'order_id'=>request()->order_id]) }}',
        'data':{
          'order_body_id':data.item.order_body_id
        },

        beforeSend:function(){
    // console.log(this_cart);
          //Add Class to Button
          // this_cart.addClass('clicked');
          // this_cart.find('.status').html('Processing');

        },
        success:function(item){

         //Check Data Length
         if(item.result){

           refreshCart(data.category);
           refreshCartTotal();

         }

        },

        error:function(item, textStatus, xhr){

         //Add Class to Button
         // this_cart.find('.status').html('Error');

        }

      });

    }

  }

</script>
