<script type="text/javascript">

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
      'url':'{{ route($hyperlink['page']['ajax']['company']['information']) }}',
      'data':{'company_id':data.company_id},
      beforeSend:function(){

        $('#company_information').removeClass('d-none');
        $('#company_information .card-body .loader').removeClass('d-none');

      },
      success:function(item){

        console.log(item);
       //
       //  $('#company_information .card-body .loader').addClass('d-none');
       //  $('#company_information .card-body .result').removeClass('d-none');
       //
        if(item.result !== null){

         //Check Data Length
         if(Object.keys(item.result.data).length){

           $('#company_tin_no').val(item.result.data.tin_no);
           $('#company_tax_identification_type_value').val(item.result.data.company_no);

         }else{



         }

       }else{

       }

      }

    });

  }

  /**************************************************************************************
    Check Company Selection
  **************************************************************************************/
  function checkEinvoiceInvoicePeriod(data){

    //Check Einvoice Invoice Period Not Empty Including Status Filter
    if($('#einvoice_invoice_period_id').val() !== '' && data.status_filter){

      if($('#company_id').val() !== '' && $('#company_office_id').val() !== ''){

        getInvoice();

      }else{

        $('#group_company_information_required').slideUp().addClass('d-none');
        $('#group_company_information').hide().removeClass('d-none').slideDown();

      }

    }else{

      $('#group_company_information_required').hide().removeClass('d-none').slideDown();
      $('#group_company_information').slideUp().addClass('d-none');
    }

  }

  /**************************************************************************************
    Get Invoice
  **************************************************************************************/
  function getInvoice(){

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

  /**************************************************************************************
    Check Einvoice Invoice Selection
  **************************************************************************************/
  function checkEinvoiceInvoiceSelection(data){

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

  /**************************************************************************************
    Get Company Office
  **************************************************************************************/
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

              getInvoice();

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

  /**************************************************************************************
    Get Company Invoice
  **************************************************************************************/
  function getCompanyInvoice(data){
console.log(data);
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
console.log(item.result.data);
               //Loop Data
               $.each(item.result.data, function(key, value) {

                 var checkbox = '<div class="form-check"><input type="checkbox" class="form-check-input invoice-checkbox" name="receipt_id[]" value="'+value.receipt_id+'"></div>';

                 var html = '';

                 html += '<tr>';

                 //No
                 html += '<td>'+ (key+1) +'</td>';

                 if(!(value.einvoice_uuid && value.einvoice_long_id)){
                   html += '<td>' + checkbox + '</td>';
                   //checkbox.attr('disabled','disabled');
                 }else{

                   html += '<td>&nbsp;</td>';

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

                 //Amount
                 html += '<td>';

                   //Receipt ID
                   html += '<strong>Sub Total</strong>';
                   html += '<p>'+(value.total_amount_sub ? value.total_amount_sub : 'No Receipt ID')+'</p>';

                   //Receipt Date
                   html += '<strong>Total</strong>';
                   html += '<p>'+(value.total_amount ? value.total_amount : 'No Total Amount')+'</p>';

                 html += '</td>';


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
                   html += '<strong>ID</strong>';
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


</script>
