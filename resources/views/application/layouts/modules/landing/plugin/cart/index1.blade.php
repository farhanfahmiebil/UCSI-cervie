<script type="text/javascript">

  $(document).ready(function(){

    //Refresh Cart Total
    refreshCartTotal();

    //Refresh Cart
    refreshCart();

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

      success:function(data){

        var html = '';

        $('#cart-icon').removeClass('bi-cart');

       //Check Data Length
       if(data.result){

         //Set Cart Total
         $('#cart-icon').addClass('bi-cart-check-fill');
         $('#cart-total').html(data.result);

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
  function refreshCart(){

    var html = '';

    var total = {
      'sst_6':0.00,
      'sst_8':0.00,
      'subtotal':0,
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
      success:function(data){

       //Check Data Length
       if(data.result){

         $.each(data.result,function(key,value){

             var image = ((value.item_image) ? 'data:image/jpeg;base64,' + value.item_image : '{{ asset('images/default/no_image.png') }}');

             total.sst_6 += parseFloat(value.item_total_amount);
             total.sst_8 += parseFloat(value.item_total_amount);
             total.subtotal += parseFloat(value.item_total);
             total.total += parseFloat(value.item_total_amount);

             html += '<div class="card px-1 py-3 card-body flex-row border-0" data-order-body-id="'+value.order_body_id+'">';

               html += '<div class="me-3">';
                 html += '<img src="' + image + '" alt="' + (value.item_image ? 'Image' : 'No Image') + '" class="width-70 rounded-3 shadow">';
               html += '</div>';

               html += '<div class="flex-grow-1">';
               html += '<h6 class="mb-0">'+value.item_description+'</h6>';
               html += '<span class="d-inline-flex align-items-center my-1">Qty: <input type="text" class="update-item-quantity quantity" maxlength="2" name="quantity" onkeypress="return inputSetting(\'number\',event)" value="'+value.item_quantity+'"></span>';
               html += '<div>';
                 html += '<span>RM'+value.item_price+'</span>';
               html += '</div>';
               html += '</div>';

               html += '<div>';

                 html += '<a href="#" class="delete-cart text-muted">';
                 html += '<i class="bi bi-x"></i>'
                 html += '</a>';

               html += '</div>';

             html += '</div>';

          });


          //console.log(total.subtotal)
          $('#offcanvasCart #cart-item').html(html);
          $('#offcanvasCart #cart-calculation #sst_6').html(total.sst_6.toFixed(2));
          $('#offcanvasCart #cart-calculation #sst_8').html(total.sst_8.toFixed(2));
          $('#offcanvasCart #cart-calculation #subtotal').html(total.subtotal.toFixed(2));
          $('#offcanvasCart #cart-calculation #total').html(total.total.toFixed(2));

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
                    'order_body_id':id
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
          // var quantity = ()
          console.log($(this).val()+'| id :'+id);

          updateItemQuantity(
            {
              'order_body_id':id,
              'quantity':$(this).val()
            }
          );

        });

       }else{

         //Set Data
         html += '<div class="card px-1 py-3 card-body flex-row border-0">';
           html += '<div class="me-3">';
             html += 'Your Cart is Empty';
           html += '</div>';
         html += '</div>';

       }

      },

      error:function(data, textStatus, xhr){

       //Add Class to Button
       // this_cart.find('.status').html('Error');

      }

    });

    /**************************************************************************************
    	Update Item QUantity
    **************************************************************************************/
    function updateItemQuantity(data){
      // console.log(data.item_id);
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
        'data':{
          'category':'quantity',
          'order_body_id':data.order_body_id,
          'quantity':data.quantity,
        },

        beforeSend:function(){
    // console.log(this_cart);
          //Add Class to Button
          // this_cart.addClass('clicked');
          // this_cart.find('.status').html('Processing');

        },
        success:function(data){

         //Check Data Length
         if(data.result){

           refreshCart();
           refreshCartTotal();

         }

        },

        error:function(data, textStatus, xhr){

         //Add Class to Button
         // this_cart.find('.status').html('Error');

        }

      });

    }

    /**************************************************************************************
    	Delete Cart Item
    **************************************************************************************/
    function deleteCartItem(data){
      // console.log(data.item_id);
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
          'order_body_id':data.order_body_id
        },

        beforeSend:function(){
    // console.log(this_cart);
          //Add Class to Button
          // this_cart.addClass('clicked');
          // this_cart.find('.status').html('Processing');

        },
        success:function(data){

         //Check Data Length
         if(data.result){

           refreshCart();
           refreshCartTotal();

         }

        },

        error:function(data, textStatus, xhr){

         //Add Class to Button
         // this_cart.find('.status').html('Error');

        }

      });

    }

  }

</script>
