@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')
<style>
       .scroll-area {
           height: 150px;
           overflow-y: scroll;
       }
   </style>
<!-- row -->
<div class="row gx-3">

  <!-- col -->
  <div class="col-md-12">

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Company Einvoice
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row">

          <!-- error message -->
          <div class="col-12">

            <div class="alert alert-primary alert-dismissible fade d-none" role="alert">
              <div class="message">

              </div>
  						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  					</div>

          </div>
          <!-- end error message -->

          <!-- phase category -->
          <div class="col-6">

            <div class="form-group">

              <label for="phase_category_id">Phase Category</label>
              <select class="select2" id="phase_category_id" name="phase_category_id">
                <option value="">--Please Select Phase Category</option>

                {{-- Check Data Phase Category Exist --}}
                @if(count($data['phase']['category']) > 0)

                  {{-- Get Data Phase Category --}}
                  @foreach($data['phase']['category'] as $key=>$value)

                    <option value="{{ $value->phase_category_id }}">{{ $value->phase_category_name }}</option>

                  @endforeach
                  {{-- End Get Data Phase Category --}}

                @endif
                {{-- End Check Data Phase Category Exist --}}

              </select>

            </div>

          </div>
          <!-- end phase category -->

          <!-- company -->
          <div class="col-6">

            <div class="form-group">

              <label for="company_id">Company</label>
              <select class="select2" id="company_id" name="company_id">
                <option value="">--Please Select Company</option>

                {{-- Check Data Company Exist --}}
                @if(count($data['company']) > 0)

                  {{-- Get Data Company --}}
                  @foreach($data['company'] as $key=>$value)

                    <option value="{{ $value->company_id }}">{{ $value->company_name }}</option>

                  @endforeach
                  {{-- End Get Data Company --}}

                @endif
                {{-- End Check Data Company Exist --}}

              </select>

            </div>

          </div>
          <!-- end company -->

          <!-- company -->
          <div class="col-6 pt-3">

            <div class="form-group">

              <label for="version_id">Version</label>
              <select class="select2" id="version" name="version">
                <option value="">--Please Select Version</option>
                <option value="1.0">1.0</option>
                <option value="1.1">1.1</option>
              </select>

            </div>

          </div>
          <!-- end company -->

          <!-- form-control -->
          <div class="col-12 text-end pt-3">

            <div class="form-group">

              <button type="button" id="submit" class="btn btn-danger" name="button">Go <i class="bi bi-arrow-right"></i></button>

            </div>

          </div>
          <!-- end form-control -->

        </div>
        <!--end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<!-- row -->
<div class="row pb-3">

  <!-- col -->
  <div id="company_information" class="col-6 d-none">

    <!-- card -->
    <div class="card h-100">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Company
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- spinner -->
        <div class="loader row justify-content-center d-none">
          <div class="spinner-border text-red" role="status"></div>
        </div>
        <!-- end spinner -->

        <!-- result -->
        <div class="result row d-none"></div>
        <!-- end result -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

  <!-- col -->
  <div id="company_einvoice_api" class="col-6 d-none">

    <!-- card -->
    <div class="card h-100">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          API Key
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
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
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<!-- row -->
<div class="row pb-3">

  <!-- col -->
  <div id="login_tax_payer" class="col-6 d-none">

    <!-- card -->
    <div class="card h-100">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Login Status
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- spinner -->
        <div class="loader row justify-content-center d-none">
          <div class="spinner-border text-red" role="status"></div>
        </div>
        <!-- end spinner -->

        <!-- result -->
        <div class="result row d-none"></div>
        <!-- end result -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

  <!-- col -->
  <div id="access_token" class="col-6 d-none">

    <!-- card -->
    <div class="card h-100">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Access Token
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- spinner -->
        <div class="loader row justify-content-center d-none">
          <div class="spinner-border text-red" role="status"></div>
        </div>
        <!-- end spinner -->

        <!-- result -->
        <div class="result row d-none"></div>
        <!-- end result -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<!-- row -->
<div class="row">

  <!-- col -->
  <div id="verification_company_tin" class="col-6 d-none">

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Company Tin Verification Status
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- spinner -->
        <div class="loader row justify-content-center d-none">
          <div class="spinner-border text-red" role="status"></div>
        </div>
        <!-- end spinner -->

        <!-- result -->
        <div class="result row d-none"></div>
        <!-- end result -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<script type="text/javascript">

  $(document).ready(function(){

    var login = {
      'status':{
        'company_information':0,
        'company_einvoice_api':0,
        'login_status':0,
      }
    };

    $('#submit').on('click',function(){
      var counter = 0;
      var html = '';
      var bullet = '<small><i class=\'bi bi-circle\'></i></small>';

      $('.alert .message').html('');

      if($('#company_id').val() === ''){
        counter += 1;
        html += bullet+' Please Select Company';
        $('.alert .message').append('Please Select Company');
      }

      if($('#phase_category_id').val() === '') {
        counter += 1;
        if(counter > 1){
            html += '<br>';
        }
        html += bullet+' Please Select Phase Category';

      }

      if($('#version').val() === '') {
        counter += 1;
        if(counter > 1){
            html += '<br>';
        }
        html += bullet+' Please Select Version';

      }

      $('#company_information').addClass('d-none');
      $('#company_einvoice_api').addClass('d-none');
      $('#login_tax_payer').addClass('d-none');
      $('#access_token').addClass('d-none');
      $('#verification_company_tin').addClass('d-none');

      $('#company_information .card-body .result').html('');
      $('#company_einvoice_api .card-body .result').html('');
      $('#login_tax_payer .card-body .result').html('');
      $('#access_token .card-body .result').html('');
      $('#verification_company_tin .card-body .result').html('');

      if(counter > 0){
        $('.alert').removeClass('d-none');
        $('.alert').addClass('d-block');
        $('.alert').addClass('show');
        $('.alert .message').html(html);
      }else{
        $('.alert').addClass('d-none');
        $('.alert').removeClass('d-block');
        $('.alert').removeClass('show');

        //Get Company Connection
        getCompanyInformation(
          {
            'company_id':$('#company_id').val()
          }
        );
// console.log($('#version').val());
        //Get Company Connection
        getCompanyEinvoiceApi(
          {
            'company_id':$('#company_id').val(),
            'phase_category_id':$('#phase_category_id').val(),
            'version':$('#version').val(),
          }
        );

      }

    });

    function getCompanyInformation(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['general']['company']['information']) }}',
        'data':{
          'company_id':data.company_id
        },
        beforeSend:function(){

          $('#company_information').removeClass('d-none');
          $('#company_information .card-body .loader').removeClass('d-none');

        },
        success:function(item){

          $('#company_information .card-body .loader').addClass('d-none');
          $('#company_information .card-body .result').removeClass('d-none');

          if(item.result !== null){

           //Check Data Length
           if(Object.keys(item.result.data).length){

             //Set Html Module
             $('#company_information .card-body .result').html(constructHTML(
               {
                 'category':'company',
                 'value':item.result.data
               }
             ));

             login.status.company_information = 1;

           }else{

             //Set Data
             $('#company_information .card-body .result').html(
               constructHTML(
                 {
                   'category':'error',
                   'value':'There is No Company Information. Please Setup'
                 }
               )
             );

           }

         }else{
           //Set Data
           $('#company_information .card-body .result').html(
             constructHTML(
               {
                 'category':'error',
                 'value':'There is No Company Information. Please Contact CSD.'
               }
             )
           );
         }

        }

      });

    }

    function getCompanyEinvoiceApi(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });
console.log(data)
      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['general']['company']['api']['einvoice']['information']) }}',
        'data':{
          'phase_category_id':data.phase_category_id,
          'company_id':data.company_id,
          'version':data.version,
        },
        beforeSend:function(){
          $('#company_einvoice_api').removeClass('d-none');
          $('#company_einvoice_api .card-body .loader').removeClass('d-none');
        },
        success:function(item){

          $('#company_einvoice_api .card-body .loader').addClass('d-none');
          $('#company_einvoice_api .card-body .result').removeClass('d-none');

          if(item.result !== null){

             //Check Data Length
             if(Object.keys(item.result.data).length){

                 //Set Html Module
                 $('#company_einvoice_api .card-body .result').html(constructHTML(
                   {
                     'category':'company_einvoice_api',
                     'value':item.result.data
                   }
                 ));

                 getLoginTaxPayer(
                   {
                     'phase_category_id':data.phase_category_id,
                     'company_id':data.company_id,
                     'version':data.version,
                   }
                 );


             }else{

               $('#login_tax_payer').addClass('d-none');
               $('#access_token').addClass('d-none');

               //Set Data
               $('#company_einvoice_api .card-body .result').html(
                 constructHTML(
                   {
                     'category':'error',
                     'value':'There is No API Key Setup. Please Setup'
                   }
                 )
               );

             }

          }else{

            $('#login_tax_payer').addClass('d-none');
            $('#access_token').addClass('d-none');

            //Set Data
            $('#company_einvoice_api .card-body .result').html(
              constructHTML(
                {
                  'category':'error',
                  'value':'There is No API Key Setup. Please Contact CSD.'
                }
              )
            );
          }

        }

      });

    }

    function getLoginTaxPayer(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['general']['company']['api']['einvoice']['login']['tax_payer']) }}',
        'data':{
          'phase_category_id':data.phase_category_id,
          'company_id':data.company_id,
          'version':data.version
        },
        beforeSend:function(){

          $('#login_tax_payer').removeClass('d-none');
          $('#login_tax_payer .card-body .loader').removeClass('d-none');
        },
        success:function(item){
console.log(item);
          $('#login_tax_payer .card-body .loader').addClass('d-none');
          $('#login_tax_payer .card-body .result').removeClass('d-none');

          if(item.result !== false){

             //Check Data Length
             if(Object.keys(item.result).length){

                 //Set Html Module
                 $('#login_tax_payer .card-body .result').html(constructHTML(
                   {
                     'category':'login_tax_payer',
                     'value':item.result
                   }
                 ));

                 getAccessToken(
                   {
                     'company_id':data.company_id,
                     'phase_category_id':data.phase_category_id,
                     'version':data.version,
                   }
                 );

             }else{

               //Set Data
               $('#login_tax_payer .card-body .result').html(
                 constructHTML(
                   {
                     'category':'error',
                     'value':'There is Authorization to Login. Please Contact CSD.'
                   }
                 )
               );

             }

          }else{
            //Set Data
            $('#login_tax_payer .card-body .result').html(
              constructHTML(
                {
                  'category':'error',
                  'value':'There is No API Key Setup'
                }
              )
            );
          }

        }

      });

    }

    function getAccessToken(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['general']['company']['api']['einvoice']['access']['token']) }}',
        'data':{
          'phase_category_id':data.phase_category_id,
          'company_id':data.company_id
        },
        beforeSend:function(){

          $('#access_token').removeClass('d-none');
          $('#access_token .card-body .loader').removeClass('d-none');
        },
        success:function(item){
console.log(item.result.data.access_token);
          $('#access_token .card-body .loader').addClass('d-none');
          $('#access_token .card-body .result').removeClass('d-none');

          if(item.result !== false){

             //Check Data Length
             if(Object.keys(item.result.data).length){

                 //Set Html Module
                 $('#access_token .card-body .result').html(constructHTML(
                   {
                     'category':'access_token',
                     'value':item.result.data
                   }
                 ));

                 getVerificationCompanyTIN(
                   {
                     'phase_category_id':data.phase_category_id,
                     'company_id':data.company_id,
                     'version':data.version
                   }
                 );

             }else{

               //Set Data
               $('#access_token .card-body .result').html(
                 constructHTML(
                   {
                     'category':'error',
                     'value':'There is No Access Token. Please Contact CSD.'
                   }
                 )
               );

             }

          }else{
            //Set Data
            $('#access_token .card-body .result').html(
              constructHTML(
                {
                  'category':'error',
                  'value':'There is No API Key Setup'
                }
              )
            );
          }

        }

      });

    }

    function getVerificationCompanyTIN(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['general']['company']['api']['einvoice']['verification']['company']['tin']) }}',
        'data':{
          'company_id':data.company_id,
          'phase_category_id':data.phase_category_id,
          'version':data.version
        },
        beforeSend:function(){

          $('#verification_company_tin').removeClass('d-none');
          $('#verification_company_tin .card-body .loader').removeClass('d-none');
        },
        success:function(item){

          $('#verification_company_tin .card-body .loader').addClass('d-none');
          $('#verification_company_tin .card-body .result').removeClass('d-none');

          if(item.result !== false){

             //Check Data Length
             if(Object.keys(item.result).length){

                 //Set Html Module
                 $('#verification_company_tin .card-body .result').html(constructHTML(
                   {
                     'category':'verification_company_tin',
                     'value':item.result
                   }
                 ));

             }else{

               //Set Data
               $('#verification_company_tin .card-body .result').html(
                 constructHTML(
                   {
                     'category':'error',
                     'value':'There is No Sub Module Assigned By You. Please Contact CSD.'
                   }
                 )
               );

             }

          }else{
            //Set Data
            $('#verification_company_tin .card-body .result').html(
              constructHTML(
                {
                  'category':'error',
                  'value':'There is No API Key Setup'
                }
              )
            );
          }

        }

      });

    }

    function constructHTML(data){

      var html  = '';

      //Get Category
      switch(data.category){

        //Company
        case 'company':

          //company name
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="company_name">Company Name</label>';
          html += '<p class="form-control">'+data.value.company_name+'</p>';
          html += '</div>';
          html += '</div>';

          //company no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="company_no">Company Number</label>';
          html += '<p class="form-control">'+data.value.company_no+'</p>';
          html += '</div>';
          html += '</div>';

          //business registration no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="business_registration_no">Registration Number</label>';
          html += '<p class="form-control">'+data.value.registration_no+'</p>';
          html += '</div>';
          html += '</div>';

          //gst no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="gst_no">GST Number</label>';
          html += '<p class="form-control">'+data.value.gst_no+'</p>';
          html += '</div>';
          html += '</div>';

          //gst no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="gst_no">Company TIN No</label>';
          html += '<p class="form-control">'+data.value.tin_no+'</p>';
          html += '</div>';
          html += '</div>';

        break;

        case 'company_einvoice_api':

          //company name
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="client_id">Client ID</label>';
          html += '<p class="form-control">'+data.value.client_id+'</p>';
          html += '</div>';
          html += '</div>';

          //company no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="client_secret_key_1">Client Secret Key 1</label>';
          html += '<p class="form-control">'+data.value.client_secret_key_1+'</p>';
          html += '</div>';
          html += '</div>';

          //business registration no
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="client_secret_key_2">Client Secret Key 2</label>';
          html += '<p class="form-control">'+data.value.client_secret_key_2+'</p>';
          html += '</div>';
          html += '</div>';

        break;

        case 'login_tax_payer':

          //login tax payer status
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="login_tax_payer_status">Login Status</label>';
          html += '<p class="form-control"><span class="badge bg-'+((data.value.status)?'success':'danger')+'">'+((data.value.status)?'Connected':'Not Connected')+'</span></p>';
          html += '</div>';
          html += '</div>';

        break;

        case 'access_token':

          //login tax payer status
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="access_token">Access Token</label>';
          html += '<p class="form-control small scroll-area">'+data.value.access_token+'</p>';
          html += '</div>';
          html += '</div>';

        break;

        case 'verification_company_tin':

          //login tax payer status
          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<label for="access_token">Company TIN Verification</label>';
          html += '<p class="form-control"><span class="badge bg-'+((data.value.status)?'success':'danger')+'">'+((data.value.status)?'Valid':'Invalid')+'</span></p>';
          html += '</div>';
          html += '</div>';

        break;

        default:

          html += '<div class="col-12">';
          html += '<div class="form-group">';
          html += '<p class="form-control">'+data.value+'</p>';
          html += '</div>';
          html += '</div>';

        break;

      }

      return html;

    }

  });

</script>

@endsection
