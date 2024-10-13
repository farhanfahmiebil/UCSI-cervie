<!-- col -->
<div class="col-sm-12 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Publication</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Publication
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      {{-- Check Publication Type Exist --}}
      @if(count($data['general']['publication']['type']) > 0)

        @php

          //Set Category Status
          $check['category'] = false;

        @endphp


        {{-- Get Publication Type Data --}}
        @foreach($data['general']['publication']['type'] as $key=>$value)
{{ $value->publication_type_id }} = {{count($data['main']['cervie']['researcher']['publication'][$value->publication_type_id])}}
          {{-- Check Researcher Publication Exist --}}
          @if(count($data['main']['cervie']['researcher']['publication'][$value->publication_type_id]) > 0)

            @php

              //Set Category Status
              $check['category'] = true;

            @endphp

            {{-- Get Researcher Publication Data --}}
            @foreach($data['main']['cervie']['researcher']['publication'][$value->publication_type_id] as $k=>$v)

              {{-- Check General Publication Type Matched With Researcher Publication Type --}}
              @if($value->publication_type_id == $v->publication_type_id)

                <!-- header sub title -->
                <div class="row pt-5 pb-1">

                  <!-- title -->
                  <h4 class="card-title mb-2">{{ $value->name }} {{$value->publication_type_id}}-{{ $v->publication_type_id }}</h4>
                  <!-- end title -->

                </div>
                <!-- end header sub title -->

                <hr>

                @break

              @endif
              {{-- End Check General Publication Type Matched With Researcher Publication Type --}}

            @endforeach
            {{-- End Get Researcher Publication Data --}}

          @endif
          {{-- End Check Researcher Publication Exist --}}

        @endforeach
        {{-- End Get Publication Type Data --}}

        @if(!$check['category'])

        <!-- header sub title -->
        <div class="row pt-5 text-center">

          <!-- title -->
          <h4 class="card-title mb-2">There is No Record Added, You may Add by Clicking New Publication Above</h4>
          <!-- end title -->

        </div>
        <!-- end header sub title -->

        @endif

      @endif
      {{-- End Check Publication Type Exist --}}


    </div>
    <!-- end card body -->

  </div>
  <!-- end card -->

</div>
<!-- end col -->

<script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-publication"]').on('click',function(event){

      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');

      //Set Form Token
      var form_token = '{{ $form_token["delete"] }}';

      //Set Hyperlink
      var hyperlink  = $(this).data('href');
          hyperlink += '?id='+parent_row;
          hyperlink += '&form_token='+form_token;

      //Set Alert
      Swal.fire({
        title:'Are you sure you want to Delete? Once deleted, it cannot be recovered.',
        showDenyButton:true,
        confirmButtonText:'Yes',
        denyButtonText:'Cancel',
        icon:'error'
      }).then((result) => {

        //If Confirmed
        if(result.isConfirmed){

          //Redirect
          window.location.href = hyperlink;

        }else

        //If Denied
        if(result.isDenied){

          //Alert Message
          Swal.fire('Cancel','','');
        }

      });
    });

  });
</script>
