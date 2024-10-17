<!-- col -->
<div class="col-sm-12 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Researcher Position</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['position']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Position
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      <!-- table responsive -->
      <div class="table-responsive pt-5">

        <!-- table -->
        <table class="table table-striped">

          <!-- thead -->
          <thead class="bg-danger text-white mx-3">

            @php

              //Set Checkbox Status
              $checkbox['status'] = false;

            @endphp

            {{-- Check Table Column Exist --}}
            @if(isset($data['table']['column']['cervie']['researcher']['position']) && count($data['table']['column']['cervie']['researcher']['position']) >= 1)

                {{-- Get Table Column Data --}}
                @foreach($data['table']['column']['cervie']['researcher']['position'] as $key => $value)

                    {{-- Check if the column is of category 'checkbox' --}}
                    @if(isset($value['category']) && $value['category'] == 'checkbox')

                      <td>{!! $value['checkbox'] !!}</td>

                    @else

                      {{-- Check if 'class' is set and apply it --}}
                      @if(isset($value['class']) && !empty($value['class']))

                        @php

                          //Set Checkbox Status
                          $checkbox['status'] = true;

                        @endphp

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

            {{-- Check Researcher Position Exist --}}
            @if(count($data['main']['cervie']['researcher']['position']) > 0)

              {{-- Get Researcher Position Data --}}
              @foreach($data['main']['cervie']['researcher']['position'] as $key=>$value)

                <tr id="{{ $value->position_id }}">

                  {{-- Check if Checkbox Status True --}}
                  @if($checkbox['status'])
                    <td>
                      <div class="form-check-label">
                        <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->position_id }}"/>
                      </div>
                    </td>
                  @endif
                  {{-- End Check if Checkbox Status True --}}

                  <td>{{ ($key+1) }}</td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->organization_name }}</td>
                  <td>{{ \Carbon\Carbon::parse($value->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($value->date_end)->format('d F Y') }}</td>
                  <td><span class="badge bg-{{ (($value->need_verification)?'warning':'success') }}">{{ (($value->need_verification)?'Pending':'Verified') }}</span></td>
                  <td>

                    <a href="{{ route($hyperlink['page']['position']['view'],['id'=>$value->position_id]) }}" class="btn btn-sm btn-secondary">
                      <i class="mdi mdi-pencil"></i>
                    </a>

                    <a data-href="{{ route($hyperlink['page']['position']['delete']) }}" class="modal-delete-position btn btn-sm btn-danger">
                      <i class="mdi mdi-trash-can text-white"></i>
                    </a>

                  </td>
                </tr>

              @endforeach
              {{-- End Get Researcher Position Data --}}

            @else

              <tr>
                <td colspan="{{ count($data['table']['column']['cervie']['researcher']['position']) }}">No Data</td>
              </tr>

            @endif
            {{-- End Check Researcher Position Exist --}}

          </tbody>
          <!-- end tbody -->

        </table>
        <!-- end table -->

        <!-- pagination -->
        <div class="col-12 pt-3">

          {{-- Check Main Data Exist --}}
          @if(count($data['main']['cervie']['researcher']['position']) >= 1)

            <!-- paginate -->
            {{ $data['main']['cervie']['researcher']['position']->appends(request()->input())->links(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.pagination.index',['navigation'=>['alignment'=>'center']]) }}
            <!-- end paginate -->

          @endif
          {{-- End Check Main Data Exist --}}

        </div>
        <!-- end pagination -->

      </div>
      <!-- end table responsive -->

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
    $('[class*="modal-delete-position"]').on('click',function(event){

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
