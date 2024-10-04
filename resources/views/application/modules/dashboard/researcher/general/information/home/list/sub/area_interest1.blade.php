<!-- col -->
<div class="col-sm-6 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Area Interest</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['area']['interest']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Area Interest
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      <!-- form checklist -->
      <form id="form-checklist-area-interest" action="{{ route($hyperlink['page']['area']['interest']['delete']) }}" method="GET">

        <input type="hidden" id="form_token" name="form_token" value=""/>

        <!-- table responsive -->
        <div class="table-responsive pt-5">

          <!-- table -->
          <table class="table">

            <!-- thead -->
            <thead>

              @php

                //Set Checkbox Status
                $checkbox['status'] = false;

              @endphp

              {{-- Check Table Column Exist --}}
              @if(isset($data['table']['column']['cervie']['researcher']['area']['interest']) && count($data['table']['column']['cervie']['researcher']['area']['interest']) >= 1)

                {{-- Get Table Column Data --}}
                @foreach($data['table']['column']['cervie']['researcher']['area']['interest'] as $key => $value)

                    {{-- Check if the column is of category 'checkbox' --}}
                    @if(isset($value['category']) && $value['category'] == 'checkbox')

                      @php

                        //Set Checkbox Status
                        $checkbox['status'] = true;

                      @endphp

                      <td>{!! $value['checkbox'] !!}</td>

                    @else

                      {{-- Check if 'class' is set and apply it --}}
                      @if(isset($value['class']) && !empty($value['class']))
                        <td class="{{ $value['class'] }}">
                      @else
                        <td>
                      @endif

                        {{-- Output the icon and name --}}
                        {!! isset($value['icon']) ? $value['icon'] : '' !!}
                        {{ isset($value['name']) ? $value['name'] : '' }}

                      </td>

                    @endif
                    {{-- End Check if the column is of category 'checkbox' --}}

                @endforeach
                {{-- End Get Table Column Data --}}

              @else
                <th>Column Not Defined</th>
              @endif
              {{-- End Check Table Column Data Exist --}}

            </thead>
            <!-- end thead -->

            <!-- tbody -->
            <tbody>

              {{-- Check Researcher Area Interest Exist --}}
              @if(count($data['main']['cervie']['researcher']['area']['interest'])>0)

                {{-- Get Researcher Area Interest Data --}}
                @foreach($data['main']['cervie']['researcher']['area']['interest'] as $key=>$value)

                    <tr id="{{ $value->area_interest_id }}">

                      {{-- Check if Checkbox Status True --}}
                      @if($checkbox['status'])
                        <td>
                          <div class="form-check-label">
                            <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->area_interest_id }}"/>
      										</div>
                        </td>
                      @endif
                      {{-- End Check if Checkbox Status True --}}

                      <td>{{ ($key+1) }}</td>
                      <td>{{ $value->name }}</td>
                      <td>

                        <a href="{{ route($hyperlink['page']['area']['interest']['view'],['id'=>$value->area_interest_id]) }}" class="btn btn-secondary">
                          <i class="mdi mdi-pencil"></i>
                        </a>

                        <a data-href="{{-- route($hyperlink['page']['area']['interest']['delete']) --}}" class="modal-delete-area-interest btn btn-danger">
                          <i class="mdi mdi-trash-can text-white"></i>
                        </a>

                      </td>
                    </tr>

                  @endforeach
                  {{-- End Get Researcher Area Interest Data --}}

                @else

                  <tr>
                    <td colspan="{{ count($data['table']['column']['cervie']['researcher']['area']['interest']) }}">No Data</td>
                  </tr>

                @endif
                {{-- End Check Researcher Area Interest Exist --}}

              </tbody>
              <!-- end tbody -->

            </table>
            <!-- end table -->

        </div>
        <!-- end table responsive -->

      </form>
      <!-- end form -->

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

    $('#selectAllAreaInterest').on('click',function(){

       if($(this).prop('checked')){

         //Control List Show
         $('.control-list').fadeIn();

         //Checked All Select Box
         $('#form-checklist-area-interest').find('.selectBox').each(function() {
           console.log(32);
            if(!$(this).is(':disabled')){
              $(this).prop('checked', true);
            }
         });

       }else{

         // Unchecked All Select Box within the context
         $('#form-checklist-area-interest').find('.selectBox').each(function() {
           $(this).prop('checked', false);
         });
       }


     });

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="modal-delete-area-interest"]').on('click',function(event){
console.log($(this).data('href'));
      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');

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
          // window.location.href = $(this).data('href');

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
