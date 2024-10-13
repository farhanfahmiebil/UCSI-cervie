@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- row -->
<div class="row gx-3">

  {{-- Check Employee Access Module Exist --}}
  @if(count($access['module']['main']))

    {{-- Get Employee Access Module --}}
    @foreach($access['module']['main'] as $key=>$value)

      <div class="module col-lg-3 col-sm-6 col-12" data-id="{{ $value->module_id }}">
        <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">
          <div class="icon-box xxl me-3">
            @php

              //Set Default Avatar;
              $image['module']['main'] = URL::asset('storage/resources/module/'.$value->module_category_id. '/' .$value->module_id.'/icon/index.png');

            @endphp

            <img src="{{ $image['module']['main'] }}" alt="" style="height:160px;width:160px">

          </div>
          <div class="sale-details text-white">
            <h4>{{ $value->module_name }}</h4>
          </div>
        </div>
      </div>

    @endforeach
    {{-- End Get Employee Access Module --}}

    <!-- user access -->
    <div id="user_access" class="col-12 d-none">

      <div class="card">

        <div class="card-body">

          <!-- spinner -->
          <div id="loader" class="row justify-content-center d-none">
            <div class="spinner-border text-red" role="status"></div>
          </div>
          <!-- end spinner -->

          <!-- row -->
          <div id="result_module" class="row d-none"></div>
          <!-- end row -->

        </div>

      </div>

    </div>
    <!-- end user access -->
  @else

    <div class="col-lg-12 col-sm-12 col-12">
      <div class="stats-tile d-flex align-items-center position-relative tile-primary">
        <div class="icon-box xxl me-3">
          <i class="bi bi-x-circle-fill font-3x text-white align-content-end"></i>
        </div>
        <div class="sale-details text-white pt-2">
          <h5>There is No Module Assigned By You. Please Contact CSD.</h5>
        </div>
      </div>
    </div>

  @endif
  {{-- End Check Employee Access Module Exist --}}

</div>
<!-- end row -->

<script type="text/javascript">

  $(document).ready(function(){


var id;

    $('.module').on('click',function(){

      //Set Data ID
      id = $(this).data('id');

      console.log(id)

      $('#result_module div').remove();

      //Toggle Col-12
      $(this).toggleClass('col-lg-12');

      //Check Class Col-12 Exist
      if($(this).hasClass('col-lg-12')){

        // If the clicked element has col-lg-12 class, expand the width to 100%
        $(this).css('width', '100%');

        getSytemModule(
          {
            'module':id
          }
        );

      }else{

        // If the clicked element doesn't have col-lg-12 class, reset the width
        $(this).delay(1000).css('width', ''); // Reset width to default (empty string)

      }

     // Toggle d-none class on other elements
     $('.module').not(this).toggleClass('d-none');

     $('#user_access').toggleClass('d-none');




    });


    function getSytemModule(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['navigation_access_module_sub']) }}',
        'data':{'module_id':data.module},
        beforeSend:function(){
          $('#result_module div').remove();
          $('#loader').delay(100).queue(function(next){
            $(this).removeClass('d-none');
            next();
          });

        },
        success:function(data){

          // $('#result_module').remove();
          // console.log(data);
          // console.log('hide');
          //Clear Select Box
         // $('#loader').delay(5000).addClass('d-none');
         $('#loader').delay(500).queue(function(next){
           $(this).addClass('d-none').dequeue();

           $('#result_module').removeClass('d-none');

           //Check Data Length
           if(data.result.length){

             //Loop Data
             $.each(data.result,function(key,value){

               console.log(value);

               if(value.module_id == id){
                 //Set Html Module
                 $('#result_module').append(constructHTML(value));
               }


 // console.log(constructHTML(value))
             });

           }else{

             //Set Data
             $('#result_module').html(constructHTML('There is No Sub Module Assigned By You. Please Contact CSD.'));

           }
           next();

         });

        }

      });

    }

    function constructHTML(data){
      var message = data.module_sub_name?data.module_sub_name:'There is No Sub Module Assigned By You. Please Contact CSD.';
      var box = data.module_sub_name?3:12;
      var host = window.location.origin;
      var hyperlink = data.module_sub_hyperlink?window.location.origin+'/'+data.module_sub_hyperlink:'#';
      // console.log(host+hyperlink);
      var html  = '';
          html += '<div class="col-'+box+'">';
          html += '<a href="'+hyperlink+'">'
          html += '<div class="card border bg-danger border-danger">';
          html += '<div class="card-body text-white">';
          html += message;
          html += '</div>';
          html += '</div>';
          html += '</a>'
          html += '</div>';

      return html;

    }

  });

</script>


@endsection
