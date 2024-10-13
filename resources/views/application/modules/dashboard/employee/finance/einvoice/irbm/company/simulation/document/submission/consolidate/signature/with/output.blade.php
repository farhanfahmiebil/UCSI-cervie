@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- row -->
<div class="row">

  <!-- error message -->
  <div class="col-12">

    <div class="alert alert-primary alert-dismissible fade d-none" role="alert">
      <div class="message"></div>
      <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </div>
  <!-- end error message -->

</div>
<!--end row -->


{{-- Get Eivoice Document --}}
@foreach($data['einvoice']['document'] as $key=>$value)

<!-- end accordion -->
<div class="accordion mb-3" id="accordion_invoice_{{ $key }}">

  <!-- accordion item -->
  <div class="accordion-item">

    <!-- accordion header -->
    <h2 class="accordion-header" id="accordion_header_invoice_{{ $key }}">
      <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_collapse_invoice_{{ $key }}" aria-expanded="true" aria-controls="accordion_collapse_invoice_{{ $key }}">
        #{{ ($key+1) }} - Einvoice Code : {{ $value->receipt_einvoice_id }}
      </button>

    </h2>
    <!-- end accordion header -->

    <!-- accordion collapse -->
    <div id="accordion_collapse_invoice_{{ $key }}" class="accordion-collapse collapse show" aria-labelledby="accordion_header_invoice_{{ $key }}" data-bs-parent="#accordion_invoice_{{ $key }}">

      <!-- accordion body -->
      <div id="{{ $value->uuid }}" class="accordion-body">

        {{-- Check UUID Exist --}}
        @if(!empty($value->uuid) && !empty($value->long_id))

          <!-- row -->
          <div class="row pt-3 text-center">

            <!-- qr code -->
            <div class="group-qr col-12 pb-3">

              <div class="form-group">

                <label for="invoice_type_id">QR Code</label>

                {!!
                  QrCode::size(200)
                        ->color(255,0,0)
                        ->margin(1)
                        ->generate(
                          $hyperlink['page']['external']['irbm'].'/'.$value->uuid.'/share/'.$value->long_id
                        )
                !!}

              </div>

              <a href="{{ $hyperlink['page']['external']['irbm'].'/'.$value->uuid.'/share/'.$value->long_id }}" class="btn btn-primary mt-3" target="_blank">
                Click to Check Submission Status
              </a>

              <button type="button" data-id="{{ $value->uuid }}" class="requery btn btn-primary mt-3" name="button">Re-Query</button>

            </div>
            <!-- end qr code -->
          </div>
          <!--end row -->

        @else

          <!-- row -->
          <div class="row pt-3 text-center">

            <!-- qr code -->
            <div class="group-qr col-12 pb-3">

              <div class="form-group">

                <label for="invoice_type_id">QR Code</label>
                No Long ID To Generate

              </div>

              <button type="button" data-id="{{ $value->uuid }}" class="requery btn btn-primary mt-3" name="button">Re-Query</button>

            </div>
            <!-- end qr code -->

            <!-- spinner -->
            <div class="loader row justify-content-center d-none">
              <div class="spinner-border text-red" role="status"></div>
            </div>
            <!-- end spinner -->

          </div>
          <!--end row -->

        @endif

        <!-- row -->
        <div class="row gx-3">

          <!-- submission id -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="uuid">UUID</label>
              <input class="form-control" type="text" name="uuid" value="{{ $value->uuid }}" readonly>
            </div>

          </div>
          <!-- end submission id -->

          <!-- uuid -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="submission_id">SubmissionID</label>
              <input class="form-control" type="text" id="submission_id" name="submission_id" value="{{ $value->submission_id }}" readonly>
            </div>

          </div>
          <!-- end uuid -->

          <!-- long id -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="long_id">Long ID</label>
              <input class="form-control" type="text" id="long_id" name="long_id" value="{{ $value->long_id }}" readonly>
            </div>

          </div>
          <!-- end long id -->

          <!-- http code status -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="invoice_type_id">Http Status Code</label>
              <input class="form-control" type="text" id="status_http_code" name="status_http_code" value="{{ $value->status_http_code }}">
            </div>

          </div>
          <!-- end http code status -->

          <!-- status -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="document_status">Document Status</label>
              <input class="form-control" type="text" id="document_status" name="document_status" value="{{ $value->status }}">
            </div>

          </div>
          <!-- end status -->

          <!-- document description -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="description">Document Description</label>
              <input class="form-control" type="text" name="" value="{{ (($value->status_http_code == 202)?'Accepted':'-') }}">
            </div>

          </div>
          <!-- end document description -->

          <!-- document submitted -->
          <div class="col-6 pb-3">

            <div class="form-group">
              <label for="invoice_type_id">Document Submitted</label>
              <input class="form-control" type="text" name="" value="{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y, H:i:s') }}">
            </div>

          </div>
          <!-- end document submitted -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row pt-3">

          <!-- document data -->
          <div class="col-12 pb-3">

            <div class="form-group">
              <label for="invoice_type_id">Document</label>
              <textarea class="form-control no-scroll document_data" name="name" readonly>{!! $value->data !!}</textarea>
            </div>
          </div>
          <!-- end document data -->

          <!-- document data -->
          <div class="col-12 pb-3 text-end">


          </div>
          <!-- end document data -->

        </div>
        <!--end row -->

      </div>
      <!-- end accordion body -->

    </div>
    <!-- end accordion collapse -->

  </div>
  <!-- end accordion item -->

</div>
<!-- end accordion -->

@endforeach
{{-- End Get Invoice No --}}


<script type="text/javascript">
  $(document).ready(function(){
    console.log(311121);
    var $textarea = $('.document_data');
    autoAdjustHeight($textarea);

    $('.requery').on('click',function(){
      console.log($(this).attr('data-id'));

      requery(
        {
          'uuid':$(this).attr('data-id')
        }
      )
    });

    function requery(data){


      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['requery']) }}',
        'data':{'uuid':data.uuid},
        beforeSend:function(){
  // console.log('#'+data.uuid+ ' .loader');
          $('#'+data.uuid+ ' .loader').removeClass('d-none');
          $('#'+data.uuid+ ' .group-qr').addClass('d-none');

          // $('#company_information .card-body .loader').removeClass('d-none');

        },
        success:function(item){
// console.log(item.result.data);
          $('#'+data.uuid+ ' .loader').addClass('d-none');
          $('#'+data.uuid+ ' .group-qr').removeClass('d-none');

          $('#long_id').val(item.result.data.longId);
          $('#document_status').val(item.result.data.status);
          if(item.result.data.longId !== ''){
            $('#status_http_code').val(202);
          }

          // console.log(item);
          // $('#'+data.uuid+ '.group-qr .loader').removeClass('d-none');
         //
         //  $('#company_information .card-body .loader').addClass('d-none');
         //  $('#company_information .card-body .result').removeClass('d-none');
         //
         //  if(item.result !== null){
         //
         //   //Check Data Length
         //   if(Object.keys(item.result.data).length){
         //
         //     $('#company_tin_no').val(item.result.data.tin_no);
         //     $('#company_tax_identification_type_value').val(item.result.data.company_no);
         //
         //   }else{
         //
         //
         //
         //   }
         //
         // }else{
         //
         // }

        }

      });

    }
  });


  function autoAdjustHeight(element) {
    element.css('height', 'auto');
    element.css('height', (element[0].scrollHeight) + 'px');
  }
</script>

@endsection
