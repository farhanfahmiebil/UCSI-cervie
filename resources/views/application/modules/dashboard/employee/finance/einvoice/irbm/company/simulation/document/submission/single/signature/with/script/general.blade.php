<script type="text/javascript">

  /**************************************************************************************
    Document Ready
  **************************************************************************************/
  $(document).ready(function(){

    /*  Einvoice Invoice Period ID On Change
    **************************************************************************************/
    $('#einvoice_invoice_period_id').on('change',function(){

      checkEinvoiceInvoiceSelection(
        {
          'einvoice_invoice_period_id':$(this).val()
        }
      );

    });

    /*  Einvoice Invoice Period ID Not Null
    **************************************************************************************/
    if($('#einvoice_invoice_period_id').val() !== ''){

      checkEinvoiceInvoiceSelection(
        {
          'einvoice_invoice_period_id':$('#einvoice_invoice_period_id').val()
        }
      );
    }

    /*  Company ID On Change
    **************************************************************************************/
    $('#company_id').on('change',function(){

      $('#group_company_office').addClass('d-none');

      getCompanyInformation(
        {
           'company_id':$('#company_id').val()
         }
      );

      getCompanyOffice(
        {
           'company_id':$('#company_id').val()
         }
      );

    });

    /*  Company ID Not Null
    **************************************************************************************/
    if($('#company_id').val() !== ''){

      getCompanyOffice(
        {
          'company_id':$('#company_id').val()
        }
      );

    }

    /*  Button Search Invoice On Click
    **************************************************************************************/
    $('#button_search_invoice').on('click',function(){

      if($('#search_invoice').val() !== ''){
        getInvoice();
      }

    });

  });
</script>
