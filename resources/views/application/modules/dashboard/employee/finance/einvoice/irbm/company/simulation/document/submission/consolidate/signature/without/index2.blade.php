@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- form -->
<form action="{{ route($hyperlink['page']['process']) }}" method="POST">
{{ csrf_field() }}

  <!-- row -->
  <div class="row">

    <!-- col -->
    <div class="col-md-12">

      <!-- error -->
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <!-- end error -->

    </div>
    <!-- end col -->

  </div>
  <!--end row -->

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
            Einvoice Setting
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row pt-1">

            <!-- einvoice invoice period -->
            <div class="col-12 pb-3">

              <div class="form-group">

                <label for="einvoice_invoice_period_id">Invoice Period</label>
                <select class="select2" id="einvoice_invoice_period_id" name="einvoice_invoice_period_id">
                  <option value="">--Please Select Invoice Period--</option>
                  {{-- Check Data Einvoice Invoice Period Exist --}}
                  @if(count($data['general']['einvoice']['invoice']['period']) > 0)

                    {{-- Get Data Einvoice Invoice Period --}}
                    @foreach($data['general']['einvoice']['invoice']['period'] as $key=>$value)

                      <option value="{{ $value->einvoice_invoice_period_id }}" {{ (($value->einvoice_invoice_period_id == 'YEAR')?'selected':'') }}>{{ $value->einvoice_invoice_period_name }}</option>

                    @endforeach
                    {{-- End Get Data Einvoice Invoice Period --}}

                  @endif
                  {{-- End Check Data Einvoice Invoice Period Exist --}}

                </select>

              </div>

            </div>
            <!-- end einvoice invoice period -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_year" class="row pt-1 d-none">

            <!-- month -->
            <div class="col-6">

              <div class="form-group">

                <label for="year_start">Year</label>
                <select class="select2" id="year_start" name="year_start">
                  <option value="">--Please Select Year--</option>

                  {{-- Check Data Year Exist --}}
                  @if(count($data['general']['year']) > 0)

                    {{-- Get Data Year --}}
                    @foreach($data['general']['year'] as $key=>$value)

                      <option value="{{ $value }}">{{ $value }}</option>

                    @endforeach
                    {{-- End Get Data Year --}}

                  @endif
                  {{-- End Check Data Year Exist --}}

                </select>

              </div>

            </div>
            <!-- end month -->

          </div>
          <!--end row -->


          <!-- row -->
          <div id="group_month" class="row pt-1 d-none">

            <!-- month -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label for="month_start">Month</label>
                <input class="form-control" type="month" id="month_start" name="month_start" value="">

              </div>

            </div>
            <!-- end month -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_week" class="row pt-1 d-none">

            <!-- week -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label for="day_week_start">Week</label>
                <select class="select2" id="day_week_start" id="day_week_start" name="day_week_start">
                  <option value="">--Please Select Week--</option>

                  {{-- Check Data Day Week Exist --}}
                  @if(count($data['general']['year']) > 0)

                    {{-- Get Data Week --}}
                    @foreach($data['general']['day']['week'] as $key=>$value)

                      <option value="{{ $value->day_week_id }}">{{ $value->day_week_name }}</option>

                    @endforeach
                    {{-- End Get Data Week --}}

                  @endif
                  {{-- End Check Data Week Exist --}}

                </select>

              </div>

            </div>
            <!-- end week -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_daily" class="row pt-1 d-none">

            <!-- date start -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label class="d-flex justify-content-between align-items-center" for="date_start">
                 Date Start
                 <span class="d-flex align-items-center">
                   <!-- <input class="ms-2" type="checkbox" id="is_same_day" name="is_today" value="">&nbsp;&nbsp;Today -->
                 </span>
               </label>
                <input class="form-control" type="date" id="date_start" name="date_start" value="">

              </div>

            </div>
            <!-- end date start -->

            <!-- date end -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label class="d-flex justify-content-between align-items-center" for="date_end">
                 Date End
                 <span class="d-flex align-items-center">
                   <input class="ms-2" type="checkbox" id="is_same_day" name="is_same_day" value="">&nbsp;&nbsp;Same Day as Date Start
                 </span>
               </label>
                <input class="form-control" type="date" id="date_end" name="date_end" value="">

              </div>

            </div>
            <!-- end date end -->

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
  <div class="row gx-3">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Company Information
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- group company information required -->
          <div id="group_company_information_required">
            Please Select Date in Order to Proceed
          </div>
          <!-- end group company information required -->

          <!-- group company information required -->
          <div id="group_company_information" class="d-none">

            <!-- row -->
            <div class="row pt-3">

              <!-- company -->
              <div class="col-6">

                <div class="form-group">

                  <label for="company_id">Company</label>
                  <select class="select2" id="company_id" name="company_id">
                    <option value="">--Please Select Company--</option>

                    {{-- Check Data Company Exist --}}
                    @if(count($data['company']) > 0)

                      {{-- Get Data Company --}}
                      @foreach($data['company'] as $key=>$value)

                        <option value="{{ $value->company_id }}" {{ (($value->is_available == 0)?'disabled':'') }}>{{ $value->company_name }}</option>

                      @endforeach
                      {{-- End Get Data Company --}}

                    @endif
                    {{-- End Check Data Company Exist --}}

                  </select>

                </div>

              </div>
              <!-- end company -->

              <!-- company office -->
              <div id="group_company_office" class="col-6 d-none">

                <div class="form-group">

                  <label for="company_office_id">Company Office</label>
                  <select class="select2" id="company_office_id" name="company_office_id">

                  </select>

                </div>

              </div>
              <!-- end company office -->

            </div>
            <!-- end row -->

          </div>
          <!-- end group company information -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <!-- row -->
  <div id="group_company_receipt" class="row gx-3 d-none">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Invoice
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
          <div class="result row d-none1 pt-3">

            <!-- row -->
            <div class="row py-3">

              <!-- search -->
              <div class="col-10">
                <div class="input-group">
									<input type="text" class="form-control" id="search_invoice" name="search_invoice" placeholder="">
									<button class="btn btn-outline-secondary" id="button_search_invoice" type="button">
										<i class="bi bi-search"></i>
									</button>
								</div>
              </div>
              <!-- end search -->

              <!-- sort -->
              <div class="col-2">
                <div class="form-group">
                  <select class="select2" id="invoice_sort" name="sort">
                    <option value="">Sort By</option>
                    <option value="customer_id asc">Customer ID (Asc)</option>
                    <option value="customer_id desc">Customer ID (Desc)</option>
                  </select>
                </div>
              </div>
              <!-- end sort -->

            </div>
            <!-- end row -->

            <!-- row -->
            <div class="row">

              <div class="table-responsive">
                <table id="invoice_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Checkbox</th>
                            <th>Receipt</th>
                            <th>Customer</th>
                            <th>Tax Identification</th>
                            <th>Customer Tin</th>
                            <th>Document</th>
                            <th>Document Status</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!--
                            <th>Customer Tin No</th>
                            <th>Customer NRIC</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>QR</th>
                            <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="receipt_id">
                        <!-- Dynamic rows will be appended here -->
                    </tbody>
                </table>
              </div>

            </div>
            <!-- end row -->

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
  <div class="row gx-3">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Customer Information
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row">

            <!-- tax identification no -->
            <div class="col-6">

              <div class="form-group">

                <label for="tin_no">TIN No</label>
                <input type="text" class="form-control" name="tin_no" value="IG24475680050">

              </div>

            </div>
            <!-- end tax identification no -->

            <!-- tax identification type -->
            <div class="col-6">

              <div class="form-group">

                <label for="tax_identification_type_id">Tax Identification Type</label>
                <select class="select2" id="tax_identification_type_id" name="tax_identification_type_id">
                  <option value="">--Please Select Tax Identification Type</option>

                  {{-- Check Data General Tax Identification Type Exist --}}
                  @if(count($data['general']['tax']['identification']['type']) > 0)

                    {{-- Get Data General Tax Identification Type --}}
                    @foreach($data['general']['tax']['identification']['type'] as $key=>$value)

                      <option value="{{ $value->tax_identification_type_id }}" {{ (($value->tax_identification_type_id == 'NRIC')?'selected':'') }}>{{ $value->tax_identification_type_name }}</option>

                    @endforeach
                    {{-- End Get Data General Tax Identification Type --}}

                  @endif
                  {{-- End Check Data General Tax Identification Type Exist --}}

                </select>

              </div>

            </div>
            <!-- end tax identification type -->

            <!-- tax identification value -->
            <div class="col-6">

              <div class="form-group">

                <label for="tax_identification_type_value">Value</label>
                <input type="text" class="form-control" name="tax_identification_type_value" value="871021915087">

              </div>

            </div>
            <!-- end tax identification value -->

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
  <div class="row">

    <!-- form-control -->
    <div class="col-12 text-end pt-3">

      <div class="form-group">
        <input type="text" name="phase_category_id" value="1">
        <input type="text" name="einvoice_type_id" value="01">
        <input type="text" name="einvoice_document_type_id" value="XML">
        <button type="submit" id="submit" class="btn btn-danger" name="button">Go <i class="bi bi-arrow-right"></i></button>

      </div>

    </div>
    <!-- end form-control -->

  </div>
  <!-- end row -->

</form>
<!-- end form -->

<script type="text/javascript">

  $(document).ready(function(){

    /* 	Check Company Selection
  	**************************************************************************************/
    function checkCompanySelection(){

      if($('#company_id') !== '' && $('#company_office_id') !== ''){

      }

    }

    $('#button_search_invoice').on('click',function(){

      if($('#search_invoice').val() !== ''){

        getCompanyInvoice(
          {
             'phase_category_id':$('#phase_category_id').val(),
             'company_id':$('#company_id').val(),
             'company_office_id':$('#company_office_id').val(),
             'year_start':$('#year_start').val(),
             'month_start':$('#month_start').val(),
             'day_week_start':$('#day_week_start').val(),
             'date_start':$('#date_start').val(),
             'date_end':$('#date_end').val(),
             'search':$('#search_invoice').val(),
             'sort':$('#sort').val(),
           }
        );

      }


    });

    function checkEinvoiceInvoicePeriod(data){

      //Check Einvoice Invoice Period Not Empty Including Status Filter
      if($('#einvoice_invoice_period_id').val() !== '' && data.status_filter){
        $('#group_company_information_required').slideUp().addClass('d-none');
        $('#group_company_information').hide().removeClass('d-none').slideDown();
      }else{
        $('#group_company_information_required').hide().removeClass('d-none').slideDown();
        $('#group_company_information').slideUp().addClass('d-none');
      }

    }

    function checkEinvoiceInvoiceSelection(data){
// console.log(data.toUpperCase());
// console.log(data.einvoice_invoice_period_id.toLowerCase());
      var target = data.einvoice_invoice_period_id.toLowerCase();

      //Preset Default
      $('#year_start').val('').trigger('change');
      $('#month_start').val('');
      $('#week_start').val('').trigger('change');
      $('#date_start').val('');
      $('#date_end').val('');

      //Check Value Selection
      switch(target){

        //Year
        case 'yearly':
        case 'half_yearly':

          //Slide Up
          $('#group_month').slideUp().hide().addClass('d-none');
          $('#group_week').slideUp().hide().addClass('d-none');
          $('#group_daily').slideUp().hide().addClass('d-none');
console.log(target);
          $('label[for="year_start"]').text('Year');
          if(target == 'half_yearly'){
            $('label[for="year_start"]').text('Year Start');
          }
          //Slide Down
          $('#group_year').hide().removeClass('d-none').slideDown();

          $('#year_start').on('change',function(){

            if($(this).val() !== ''){

              checkEinvoiceInvoicePeriod(
                {
                  status_filter:status
                }
              );

            }
          });
      //    checkEinvoiceInvoiceSelection();

        break;

        //Month
        case 'monthly':
        case 'bimonthly':

          //Slide Up
          $('#group_year').slideUp().hide().addClass('d-none');
          $('#group_week').slideUp().hide().addClass('d-none');
          $('#group_daily').slideUp().hide().addClass('d-none');

          $('label[for="month_start"]').text('Month');
          if(data.einvoice_invoice_period_id.toLowerCase() == 'bimonthly'){
            $('label[for="month_start"]').text('Month Start');
          }

          //Slide Down
          $('#group_month').hide().removeClass('d-none').slideDown();

          $('#month_start').on('input',function(){

            var status = ($(this).val() !== '');

            checkEinvoiceInvoicePeriod(
              {
                status_filter:status
              }
            );

          });

        break;

        //Week
        case 'weekly':
        case 'biweekly':

          //Slide Up
          $('#group_year').slideUp().hide().addClass('d-none');
          $('#group_month').slideUp().hide().addClass('d-none');
          $('#group_daily').slideUp().hide().addClass('d-none');

          $('label[for="week_start"]').text('Week Start');
          if(data.einvoice_invoice_period_id.toLowerCase() == 'biweekly'){
            $('label[for="week_start"]').text('Month Start');
          }
          //Slide Down
          $('#group_week').hide().removeClass('d-none').slideDown();

          $('#week_start').on('input',function(){

            if($(this).val() !== ''){

              var status = ($(this).val() !== '');

              checkEinvoiceInvoicePeriod(
                {
                  status_filter:status
                }
              );

            }
          });

        break;

        //Daily and Others
        case 'daily':
        case 'others':

          //Slide Up
          $('#group_year').slideUp().hide().addClass('d-none');
          $('#group_month').slideUp().hide().addClass('d-none');
          $('#group_week').slideUp().hide().addClass('d-none');

          //Slide Down
          $('#group_daily').hide().removeClass('d-none').slideDown();

          $('#date_start').on('input',function(){

            var status = (($(this).val() !== '') && ($('#date_end').val() !== ''));

            checkEinvoiceInvoicePeriod(
              {
                status_filter:status
              }
            );

            checkCompanySelection()




          });

          $('#date_end').on('input',function(){

            var status = (($(this).val() !== '') && ($('#date_start').val() !== ''));

            checkEinvoiceInvoicePeriod(
              {
                status_filter:status
              }
            );

          });

          $('#is_same_day').on('change',function(){

            var is_checked = $('#is_same_day').prop('checked');

            if(is_checked){
                // Checkbox is checked
                console.log('Checkbox is checked');
                if($('#date_start').val() !== ''){
                  $('#date_end').val($('#date_start').val());


                }

                var status = (($('#date_start').val() !== '') && ($('#date_end').val() !== ''));

                checkEinvoiceInvoicePeriod(
                  {
                    status_filter:status
                  }
                );

                // Perform actions here
            }

          });

        break;

        //Not Applicable
        case 'NA':

          //Slide Up
          $('#group_year').slideUp().hide().addClass('d-none');
          $('#group_month').slideUp().hide().addClass('d-none');
          $('#group_week').slideUp().hide().addClass('d-none');
          $('#group_daily').slideUp().hide().addClass('d-none');

        break;

        default:

          //Slide Up
          $('#group_year').slideUp().hide().addClass('d-none');
          $('#group_month').slideUp().hide().addClass('d-none');
          $('#group_week').slideUp().hide().addClass('d-none');
          $('#group_daily').slideUp().hide().addClass('d-none');

        break;

      }

    }

    $('#einvoice_invoice_period_id').on('change',function(){

      checkEinvoiceInvoiceSelection(
        {
          'einvoice_invoice_period_id':$(this).val()
        }
      );

    });

    if($('#einvoice_invoice_period_id').val() !== ''){
      console.log(32);
      checkEinvoiceInvoiceSelection(
        {
          'einvoice_invoice_period_id':$('#einvoice_invoice_period_id').val()
        }
      );
    }

    if($('#company_id').val() !== ''){

      getCompanyOffice(
        {
          'company_id':$('#company_id').val()
        }
      );

    }

    $('#company_id').on('change',function(){

      $('#group_company_office').addClass('d-none');

      getCompanyOffice(
        {
           'company_id':$('#company_id').val()
         }
      );

    });

    function getCompanyOffice(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['company']['office']) }}',
        'data':{
                'company_id':data.company_id
               },
        beforeSend:function(){

          // $('#group_company_office').removeClass('d-none');
          // $('#group_company_office .card-body .loader').removeClass('d-none');
          $('#company_office_id').empty();
        },
        success:function(item){

          $('#group_company_office').hide().removeClass('d-none').slideDown();

          var option;
          //Check Result
          if(item.result !== null){


            //Check Data Length
            if(Object.keys(item.result.data).length){

              $('#company_office_id').append('<option value = "">-- Please Select --</option>');

              //Loop Data
              $.each(item.result.data,function(key,value){

                option = $('<option></option>').attr('value', value.company_office_id).text('['+value.company_category_name+'] '+value.company_office_name);


                $('#company_office_id').append(option);
                //Set Html Module
                // $('.user_access .result').append(constructHTML(value));

              });

              $('#company_office_id').on('change',function(){

                getCompanyInvoice(
                  {
                     'phase_category_id':$('#phase_category_id').val(),
                     'company_id':$('#company_id').val(),
                     'company_office_id':$('#company_office_id').val(),
                     'year_start':$('#year_start').val(),
                     'month_start':$('#month_start').val(),
                     'day_week_start':$('#day_week_start').val(),
                     'date_start':$('#date_start').val(),
                     'date_end':$('#date_end').val(),
                     'search':'',
                     'sort':'',
                   }
                );

              });

            }else{

              option = $('<option></option>').attr('value', '').text('No Setup Yet');
              $('#receipt_id').append(option);

            }

         }else{

         }

        }

      });

    }

    function getCompanyInvoice(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['company']['receipt']) }}',
        'data':{
                'phase_category_id':data.phase_category_id,
                'company_id':data.company_id,
                'company_office_id':data.company_office_id,
                'year_start':data.year_start,
                'month_start':data.month_start,
                'day_week_start':data.day_week_start,
                'daily':{
                  'date_start':data.date_start,
                  'date_end':data.date_end
                },
                'search':data.search,
                'filter':data.filter,
               },
        beforeSend:function(){

          $('#group_company_receipt').removeClass('d-none');
          $('#group_company_receipt .card-body .loader').removeClass('d-none');
          $('#receipt_id').empty();
        },
        success:function(item){

          console.log(item);
          $('#group_company_receipt .card-body .loader').addClass('d-none');
          $('#group_company_receipt .card-body .result').removeClass('d-none');

          //Check Result
          if(item.result !== null){

            //Check Result Status
            if(item.result.status){

               //Check Data Length
               if(Object.keys(item.result.data).length){

                 //Loop Data
                 $.each(item.result.data, function(key, value) {

                   var checkbox = $('<div class="form-check"><input type="checkbox" class="form-check-input invoice-checkbox" name="receipt_id[]" value="'+value.receipt_id+'"></div>');

                   var html = '';

                   html += '<tr>';

                   //No
                   html += '<td>'+ (key+1) +'</td>';

                   if(!(value.einvoice_uuid && value.einvoice_long_id)){
                     html += '<td>&nbsp;</td>';
                     //checkbox.attr('disabled','disabled');
                   }else{

                    html += '<td>' + checkbox + '</td>';

                   }

                   //Receipt No
                   html += '<td>';

                     //Receipt ID
                     html += '<strong>Receipt ID</strong>';
                     html += '<p>'+(value.receipt_no ? value.receipt_no : 'No Receipt ID')+'</p>';

                     //Receipt Date
                     html += '<strong>Receipt Date</strong>';
                     html += '<p>'+(value.receipt_date ? value.receipt_date : 'No Receipt Date')+'</p>';

                   html += '</td>';

                   html += '<td>'+ value.receipt_no +'</td>';

                   //Customer
                   html += '<td>';

                     //Customer ID
                     html += '<strong>Customer ID</strong>';
                     html += '<p>'+(value.customer_id ? value.customer_id : 'No ID')+'</p>';

                     //Customer Name
                     html += '<strong>Customer Name</strong>';
                     html += '<p>'+(value.customer_name ? value.customer_name : 'No Name')+'</p>';

                   html += '</td>';

                   //Customer
                   html += '<td>';

                     //Customer ID
                     html += '<strong>Tax Identification</strong>';
                     html += '<p>'+(value.tax_identification_type_name ? value.tax_identification_type_name : 'No Tax identification Type')+'</p>';

                     //Customer Name
                     html += '<strong>Tax ID</strong>';
                     html += '<p>'+(value.customer_nric_no ? value.customer_nric_no : 'No Tax ID')+'</p>';

                   html += '</td>';

                   //Customer TIN
                   html += '<td>'+ (value.customer_tin_no ? value.customer_tin_no : 'Tin No Not Setup') +'</td>';

                   //Document Status
                   html += '<td>';

                     //Status HTTP Code
                     html += '<strong>HTTP Code</strong>';
                     html += '<p>'+(value.status_http_code ? value.status_http_code : '-')+'</p>';

                     //Status Document
                     html += '<strong>Status</strong>';
                     html += '<p>'+(value.status_document ? value.status_document : '-')+'</p>';

                   html += '</td>';

                   //Document
                   html += '<td>';

                     //Submission ID
                     html += '<strong>Submission ID</strong>';
                     html += '<p>'+(value.einvoice_submission_uid ? value.einvoice_submission_uid : '-')+'</p>';

                     //UUID
                     html += '<strong>UUID</strong>';
                     html += '<p>'+(value.einvoice_uuid ? value.einvoice_uuid : '-')+'</p>';

                     //Long ID
                     html += '<strong>Long ID</strong>';
                     html += '<p>'+(value.einvoice_long_id ? value.einvoice_long_id : '-')+'</p>';

                   html += '</td>';

                   //Customer TIN
                   html += '<td>'+ (value.einvoice_status ? value.einvoice_status : '-') +'</td>';

                   //Action
                   html += '<td>-</td>';

                   html += '</tr>';
                   // var row = $('<tr></tr>');
                   // row.append('<td>' + (key+1) + '</td>');
                   // if(!(value.einvoice_uuid && value.einvoice_long_id)){
                   //   row.append($('<td></td>').append(checkbox));
                   //   //checkbox.attr('disabled','disabled');
                   // }else{
                   //
                   //   row.append($('<td></td>').append('&nbsp;'));
                   // }
                   // row.append('<td>');
                   // row.append('<p>');
                   // row.append('Receipt ');
                   // row.append('</p>');
                   // row.append('</td>');
                   // row.append('<td>' + value.receipt_no + '</td>');
                   // //row.append('<td>' + (value.customer_id ? value.customer_id : 'No ID') + '</td>');
                   //
                   // row.append('<td><strong></strong>' + (value.customer_id ? value.customer_id : 'No ID') + '</td>');
                   // row.append('<td>' + value.customer_type + '</td>');
                   // row.append('<td>' + (value.customer_tin_no ? value.customer_tin_no : 'No Tin No') + '</td>');
                   // row.append('<td>' + (value.customer_nric_no ? '('+value.tax_identification_type_name +')<br/>'+ value.customer_nric_no : 'No NRIC No') + '</td>');
                   //
                   // row.append('<td>' + (value.customer_name ? value.customer_name : 'No Name') + '</td>');
                   // row.append('<td>' + (value.einvoice_status ? value.einvoice_status : '-') + '</td>');
                   // row.append('<td>' + ((value.einvoice_uuid && value.einvoice_long_id)?'<a target="_blank" href="'+value.domain_client+'/'+value.einvoice_uuid+'/share/'+value.einvoice_long_id+'">Click Here</a>': '-') + '</td>');
                   // row.append('<td>' + ((value.einvoice_uuid && value.einvoice_long_id)?'<a target="_blank" href="{!! route($hyperlink['page']['view']['qr']) !!}/?uuid='+value.einvoice_uuid+'&long_id='+value.einvoice_long_id+'&company='+data.company_id+'&phase_category_id='+data.phase_category_id+'">Click Here</a>': '-') + '</td>');
                   // row.append('<td>' + (value.einvoice_status ? '<i class="bi bi-cloud-upload"></i>' : '-') + '</td>');
                   // row.append('<td><i class="bi bi-cloud-upload"></i></td>');

                   $('#receipt_id').append(html);

                   // console.log(row);
               });
               }

            }else{

              var message = $('<tr><td colspan="5">No Setup Yet</td></tr>');
             $('#receipt_id').append(message);

            }

         }else{

         }

        }

      });

    }

  });

</script>


@endsection
