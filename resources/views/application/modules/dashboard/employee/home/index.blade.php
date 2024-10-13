@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')
<style media="screen">
/* Ensure the flex container behaves normally on larger screens */


</style>
<!-- row -->
<div class="row gx-3">

  {{-- Check Module Company Exist --}}
  @if(count($access['module']['company']))

    {{-- Get Employee Access Module --}}
    @foreach($access['module']['company'] as $key=>$value)

      <div class="module_company col-lg-3 col-sm-6 col-12" data-id="{{ $value->module_company_id }}">
        <div class="stats-tile d-flex align-items-center position-relative tile-primary cursor-pointer">

            <div class="col-6 icon-box xxl">
              @php

                //Set Default Avatar;
                $image['module']['company'] = URL::asset('storage/resources/module/company/'.$value->module_company_id.'/icon/index.png');

              @endphp

              <img src="{{ $image['module']['company'] }}" alt="" style="">

            </div>
            <div class="col-6 sale-details text-white">
              <h4>{{ $value->module_company_name }}</h4>
            </div>
        </div>
      </div>

    @endforeach
    {{-- End Get Module Company Exist --}}

    <!-- user access -->
    <div class="user_access col-12 d-none">

      <div class="card">

        <div class="card-body">

          <!-- spinner -->
          <div class="loader row justify-content-center d-none">
            <div class="spinner-border text-red" role="status"></div>
          </div>
          <!-- end spinner -->

          <!-- row -->
          <div class="result row d-none"></div>
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

    $('.module_company').on('click',function(){

      //Set Data ID
      var id = $(this).data('id');

      $('.user_access .result div').remove();

      //Toggle Col-12
      $(this).toggleClass('col-lg-12');

      //Check Class Col-12 Exist
      if($(this).hasClass('col-lg-12')){

        // If the clicked element has col-lg-12 class, expand the width to 100%
        $(this).css('width','100%');

        getModuleCompany(
          {
            'module_company_id':id
          }
        );

      }else{

        // If the clicked element doesn't have col-lg-12 class, reset the width
        $(this).delay(1000).css('width',''); // Reset width to default (empty string)

      }

     // Toggle d-none class on other elements
     $('.module_company').not(this).toggleClass('d-none');

     $('.user_access').toggleClass('d-none');

    });


    function getModuleCompany(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['navigation']['access']['module']['company']) }}',
        'data':{'module_company_id':data.module_company_id},
        beforeSend:function(){

          $('.user_access .result div').remove();
          $('.user_access .loader').delay(100).queue(function(next){
            $(this).removeClass('d-none');
            next();
          });

        },
        success:function(item){
// console.log(item);
          // $('#result_module').remove();
          console.log(item.result.length);
          console.log('hide');
          //Clear Select Box
         // $('#loader').delay(5000).addClass('d-none');
         $('.user_access .loader').delay(500).queue(function(next){
           $(this).addClass('d-none').dequeue();

           $('.user_access .result').removeClass('d-none');

           //Check Data Length
           if(item.result.length){

             //Loop Data
             $.each(item.result,function(key,value){

               //Set Html Module
               $('.user_access .result').append(constructHTML(value));

             });

           }else{

             //Set Data
             $('.user_access .result div').html(constructHTML('There is No Sub Module Assigned By You. Please Contact CSD.'));

           }
           next();

         });

        }

      });

    }

    function constructHTML(data){
      var message = data.module_name?data.module_name:'There is No Sub Module Assigned By You. Please Contact CSD.';
      var box = data.module_name?3:12;
      var host = window.location.origin;
      var hyperlink = data.module_hyperlink?window.location.origin+'/'+data.module_hyperlink:'#221';
      // console.log(data);
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
