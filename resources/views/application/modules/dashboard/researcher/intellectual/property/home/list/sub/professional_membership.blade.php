<!-- col -->
<div class="col-sm-12 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Professional Membership</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['professional']['membership']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Professional Membership
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      {{-- Check Professional Membership Level Exist --}}
      @if(count($data['general']['professional']['membership']['level']) > 0)

        {{-- Get Professional Membership Level Data --}}
        @foreach($data['general']['professional']['membership']['level'] as $key=>$value)

          <div class="row pt-5 pb-1">

            <!-- title -->
            <h4 class="card-title mb-2">{{ $value->name }}</h4>
            <!-- end title -->

          </div>

          <hr>

          <!-- table responsive -->
          <div class="table-responsive">

            <!-- table -->
            <table class="table table-bordered">

              <!-- thead -->
              <thead>

                @php

                  //Set Checkbox Status
                  $checkbox['status'] = false;

                @endphp

                {{-- Check Table Column Exist --}}
                @if(isset($data['table']['column']['cervie']['researcher']['professional']['membership']) && count($data['table']['column']['cervie']['researcher']['professional']['membership']) >= 1)

                  {{-- Get Table Column Data --}}
                  @foreach($data['table']['column']['cervie']['researcher']['professional']['membership'] as $k=>$v)

                      {{-- Check if the column is of category 'checkbox' --}}
                      @if(isset($v['category']) && $v['category'] == 'checkbox')

                        @php

                          //Set Checkbox Status
                          $checkbox['status'] = true;

                        @endphp

                        <td>{!! $v['checkbox'] !!}</td>

                      @else

                        {{-- Check if 'class' is set and apply it --}}
                        @if(isset($v['class']) && !empty($v['class']))
                          <td class="{{ $v['class'] }}">
                        @else
                          <td>
                        @endif

                          {{-- Output the icon and name --}}
                          {!! isset($v['icon']) ? $v['icon'] : '' !!}
                          {{ isset($v['name']) ? $v['name'] : '' }}

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

                {{-- Check Researcher Professional Membership Exist --}}
                @if(count($data['main']['cervie']['researcher']['professional']['membership']) > 0)

                  {{-- Get Researcher Professional Membership Data --}}
                  @foreach($data['main']['cervie']['researcher']['professional']['membership'][$value->professional_membership_level_id] as $k=>$v)

                    <tr id="{{ $v->professional_membership_id }}">

                      {{-- Check if Checkbox Status True --}}
                      @if($checkbox['status'])
                        <td>
                          <div class="form-check-label">
                            <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $v->professional_membership_id }}"/>
      										</div>
                        </td>
                      @endif
                      {{-- End Check if Checkbox Status True --}}

                      <td>{{ ($k+1) }}</td>
                      <td>{{ $v->name }}</td>
                      <td>{{ $v->professional_membership_role_name }}</td>
                      <td>{{ $v->professional_membership_level_name }}</td>
                      <td>{{ \Carbon\Carbon::parse($v->date_start)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($v->date_end)->format('d-m-Y') }}</td>
                      <td><span class="badge bg-{{ (($v->need_verification)?'warning':'success') }}">{{ (($v->need_verification)?'Pending':'Verified') }}</span></td>
                      <td>

                        <a href="{{ route($hyperlink['page']['professional']['membership']['view'],['id'=>$v->professional_membership_id]) }}" class="btn btn-sm btn-secondary">
                          <i class="mdi mdi-pencil"></i>
                        </a>

                        <a data-href="{{ route($hyperlink['page']['professional']['membership']['delete']) }}" class="btn-delete-professional-membership btn-sm btn btn-danger">
                          <i class="mdi mdi-trash-can text-white"></i>
                        </a>

                      </td>
                    </tr>

                  @endforeach
                  {{-- End Get Researcher Professional Membership Data --}}

                @else

                  <tr class="text-center">
                    <td colspan="{{ count($data['table']['column']['cervie']['researcher']['professional']['membership']) }}">No Data</td>
                  </tr>

                @endif
                {{-- End Check Researcher Professional Membership Exist --}}

              </tbody>
              <!-- end tbody -->

            </table>
            <!-- end table -->

            <!-- pagination -->
            <div class="col-12 pt-3">

              {{-- Check Main Data Exist --}}
              @if(count($data['main']['cervie']['researcher']['professional']['membership'][$value->professional_membership_level_id]) >= 1)

                <!-- paginate -->
                {{ $data['main']['cervie']['researcher']['professional']['membership'][$value->professional_membership_level_id]->appends(request()->input())->links(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.pagination.index',['navigation'=>['alignment'=>'center']]) }}
                <!-- end paginate -->

              @endif
              {{-- End Check Main Data Exist --}}

            </div>
            <!-- end pagination -->

          </div>
          <!-- end table responsive -->

        @endforeach
        {{-- Get Professional Membership Level Data --}}

      @endif
      {{-- End Check Researcher Professional Membership Level Exist --}}

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
    $('[class*="btn-delete-professional-membership"]').on('click',function(event){

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
