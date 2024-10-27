<!-- card -->
<div class="card">

  <!-- card header -->
  <div class="card-header">

    <!-- header -->
    <div class="d-flex align-items-center justify-content-between">

      <!-- title -->
      <h4 class="card-title mb-2">Researcher Copyright</h4>
      <!-- end title -->

      <!-- dropdown -->
      <!-- <div class="dropdown">
        <a href="{{ route($hyperlink['page']['new'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-light px-1">
          <i class="bi bi-plus text-dark"></i>
          New Position
        </a>
      </div> -->
      <!-- end dropdown -->

    </div>
    <!-- end header -->

  </div>
  <!-- end card header -->

  <!-- card header -->
  <div class="card-header row filter-info">

    <!-- your search -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi-search pe-2"></i>
          <div class="ml-3">
            <h6>Your Search</h6>
            <p class="mt-2 text-muted card-text">{{ (request()->input('search')?request()->input('search'):'-') }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- end your search -->

    <!-- filter by -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi bi-sliders pe-2"></i>
          <div class="ml-3">
            <h6>Filter By</h6>
            <p class="mt-2 text-muted card-text">

              {{-- Check Employee LDAP Status --}}
              @if(!empty(request()->input('status_employee_ldap_id')))

                @php

                  // Set Column
                  $column = [];

                  // Ensure the data is an array
                  $raw['status']['employee']['ldap'] = $data['status']['employee']['ldap'];

                  // Check if $employeeLdapData is a collection and convert to array if needed
                  if($raw['status']['employee']['ldap'] instanceof \Illuminate\Support\Collection){
                    $raw['status']['employee']['ldap'] = $raw['status']['employee']['ldap']->toArray();
                  }

                  // Extract Status ID
                  $column['status']['employee']['ldap'] = array_column($raw['status']['employee']['ldap'], 'status_id');

                @endphp

                @if(in_array(request()->input('status_employee_ldap_id'),$column['status']['employee']['ldap']))

                    {{-- Find the index of the employee_ldap_status_id in the array --}}
                    @php
                      $index = array_search(request()->input('status_employee_ldap_id'),$column['status']['employee']['ldap']);
                      $filter['status']['employee']['ldap'] = $data['status']['employee']['ldap'][$index]->name
                    @endphp

                @else

                  {{-- Display Dash If Not Found --}}
                  -
                  @php $filter['status']['employee']['ldap'] = '-' @endphp

                @endif

                LDAP (Status) :
                <span class="badge bg-{{
                    (
                      ($filter['status']['employee']['ldap'] === 'active')?'success':
                      (
                        ($filter['status']['employee']['ldap'] === 'inactive')?'warning':
                        (
                          ($filter['status']['employee']['ldap'] === 'deleted')?'danger':'info'
                        )
                      )
                    ) }}">

                    {{ ucwords($filter['status']['employee']['ldap']) }}

                </span>

                <br>

              @endif
              {{-- End Check Employee LDAP Status --}}


              {{-- Check Employee Status --}}
              @if(!empty(request()->input('status_employee_id')))

                @php

                  //Ensure the data is an array
                  $raw['status']['employee']['main'] = $data['status']['employee']['main'];

                  //Check if $employeeLdapData is a collection and convert to array if needed
                  if($raw['status']['employee']['main'] instanceof \Illuminate\Support\Collection){
                    $raw['status']['employee']['main'] = $raw['status']['employee']['main']->toArray();
                  }

                  // Extract Status ID
                  $column['status']['employee']['main'] = array_column($raw['status']['employee']['main'], 'status_id');

                @endphp

                @if(in_array(request()->input('status_employee_id'),$column['status']['employee']['main']))

                    {{-- Find the index of the employee_status_id in the array --}}
                    @php
                      $index = array_search(request()->input('status_employee_id'),$column['status']['employee']['main']);
                      $filter['status']['employee']['main'] = $data['status']['employee']['main'][$index]->name
                    @endphp

                @else

                  {{-- Display Dash If Not Found --}}
                  -
                  $filter['status']['employee']['main'] = '-'

                @endif

                Employee (Status) :
                <span class="badge bg-{{
                    (
                      ($filter['status']['employee']['main'] === 'active')?'success':
                      (
                        ($filter['status']['employee']['main']=== 'inactive')?'warning':
                        (
                          ($filter['status']['employee']['main'] === 'deleted')?'danger':'info'
                        )
                      )
                    ) }}">

                    {{ ucwords($filter['status']['employee']['main']) }}

                </span>

              @endif
              {{-- End Check Employee Status --}}

            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end filter by -->

    <!-- sorted by -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi-filter pe-2"></i>
          <div class="ml-3">
            <h6>Sorted By</h6>
            <p class="mt-2 text-muted card-text">
              {{
                ((empty(request()->input('sorting_display')))?'-':request()->input('sorting_display').' ('.ucfirst(request()->input('sorting')).')')
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end sorted by -->

    <!-- search box -->
    <div class="col-lg-12 search-box">

      <!-- card -->
      <div class="card">

        <!-- card body -->
        <div class="card-body">

          <!-- box header -->
          <div class="box-header">
            <h3 class="box-title">What Are You Looking For ?</h3>
          </div>
          <!-- box header -->

          <!-- box body -->
          <div class="box-body">

            <!-- form search -->
            <form id="form-checklist" action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">

              <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name"/>
                {!! ((!empty(request()->input('search')))?'<input type="hidden" name="status" value="'.request()->input('search').'"/>':'') !!}
                {!! ((!empty(request()->input('employee_ldap_status_id')))?'<input type="hidden" name="status" value="'.request()->input('employee_ldap_status_id').'"/>':'') !!}
                {!! ((!empty(request()->input('employee_status_id')))?'<input type="hidden" name="status" value="'.request()->input('employee_status_id').'"/>':'') !!}
                {!! ((!empty(request()->input('sorting_display')))?'<input type="hidden" name="status" value="'.request()->input('sorting_display').'"/>':'') !!}
                {!! ((!empty(request()->input('sorting')))?'<input type="hidden" name="status" value="'.request()->input('sorting').'"/>':'') !!}
                <span class="input-group-btn bg-transparent">
                  <input type="hidden" name="form_token" value="{{ $form_token['search'] }}"/>
                  <button type="submit" class="btn btn-custom"/>
                    <i class="bi bi-search text-white"></i>
                  </button>
                </span>
              </div>

            </form>
            <!-- end form search -->

          </div>
          <!-- end box body -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end search box -->

  </div>
  <!-- end card header -->

  <!-- card header -->
  <div class="card-header">

    <!-- button new -->
    <a href="{{ route($hyperlink['page']['new'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Add">
      <i class="bi bi-plus-lg"></i>
    </a>
    <!-- end button new -->

    <!-- button search -->
    <a id="search-box" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Search">
			<i class="bi bi-search"></i>
		</a>
    <!-- button search -->

    <!-- button refresh -->
		<a href="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Refresh">
			<i class="bi bi-bootstrap-reboot"></i>
		</a>
    <!-- end button refresh -->

    <!-- button filter -->
    <span data-bs-toggle="modal" data-bs-target="#modal-filter">
      <button type="button" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Filter">
        <i class="bi bi-sliders"></i>
      </button>
    </span>
    <!-- end button filter -->

    <!-- button sort -->
    <div class="btn-group">
      <button type="button" class="btn btn-icons btn-custom dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Sort">
        <i class="bi bi-filter"></i>
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item sort-item" href="#" data-sort-id="name" data-sort="asc" data-sort-display="Name">Name [Asc]</a></li>
        <li><a class="dropdown-item sort-item" href="#" data-sort-id="name" data-sort="desc" data-sort-display="Name">Name [Desc]</a></li>
      </ul>
    </div>
    <!-- end button sort -->

    <!-- form sort -->
    <form id="form-sort" action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">
      <input type="hidden" name="form_token" value="{{ $form_token['sort'] }}"/>
      <input type="hidden" id="sorting_column" name="sorting_column" value=""/>
      <input type="hidden" id="sorting" name="sorting" value="{{ request()->input('sorting') }}"/>
      <input type="hidden" id="sorting_display" name="sorting_display" value="{{ request()->input('sorting_display') }}"/>
      {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
      {!! ((!empty(request()->input('employee_ldap_status_id')))?'<input type="hidden" name="employee_ldap_status_id" value="'.request()->input('employee_ldap_status_id').'"/>':'') !!}
      {!! ((!empty(request()->input('employee_status_id')))?'<input type="hidden" name="employee_status_id" value="'.request()->input('employee_status_id').'"/>':'') !!}
    </form>
    <!-- end form sort -->

    <!-- control list -->

    <!-- total count -->
    <div class="control-list">
      <hr>
        <button type="button" id="selectCount" class="selected-btn btn btn-custom gap"></button>
        <button type="button" id="modal-delete" class="btn btn-icons btn-custom gap"><i class="bi bi-trash"></i></button>
      <hr>
    </div>
    <!-- end total count -->

    <!-- end control list -->

  </div>
  <!-- end card header -->

  <!-- card body -->
  <div class="card-body">

    <!-- table responsive -->
    <div class="table-responsive">

      <!-- hidden -->
      <input type="hidden" id="form_token" name="form_token" value=""/>
      <input type="hidden" id="remark" name="remark" value=""/>
      <!-- end hidden -->

      <!-- table -->
      <table class="table table-striped">

        <!-- thead -->
        <thead class="bg-danger text-white mx-3">

          @php

            //Set Checkbox Status
            $checkbox['status'] = false;

          @endphp

          {{-- Check Table Column Exist --}}
          @if(isset($data['table']['column']['cervie']['researcher']['copyright']) && count($data['table']['column']['cervie']['researcher']['copyright']) >= 1)

              {{-- Get Table Column Data --}}
              @foreach($data['table']['column']['cervie']['researcher']['copyright'] as $key => $value)

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

          {{-- Check Researcher Position Exist --}}
          @if(count($data['main']['cervie']['researcher']['copyright']) > 0)

            {{-- Get Researcher Position Data --}}
            @foreach($data['main']['cervie']['researcher']['copyright'] as $key=>$value)

              <tr id="{{ $value->copyright_id }}" class="bg-danger">

                {{-- Check if Checkbox Status True --}}
                @if($checkbox['status'])
                  <td>
                    <div class="form-check">
                      <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->copyright_id }}"/>
                    </div>
                  </td>
                @endif
                {{-- End Check if Checkbox Status True --}}

                <td>{{ ($key+1) }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ \Carbon\Carbon::parse($value->date_filing)->format('d F Y') }}</td>
                <td><span class="badge shade-{{ (($value->need_verification)?'yellow':'green') }}">{{ (($value->need_verification)?'Pending':'Verified') }}</span></td>
                <td>
                  <a href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->route('organization_id'),'employee_id'=>request()->route('employee_id'),'id'=>$value->copyright_id]) }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <a data-href="{{ route($hyperlink['page']['delete']['main'],['organization_id'=>request()->route('organization_id'),'employee_id'=>request()->route('employee_id'),'id'=>$value->copyright_id]) }}" class="btn-delete-main btn btn-sm btn-danger">
                    <i class="bi bi-trash text-white"></i>
                  </a>

                </td>
              </tr>

            @endforeach
            {{-- End Get Researcher Position Data --}}

          @else

            <tr>
              <td colspan="{{ count($data['table']['column']['cervie']['researcher']['copyright']) }}">No Data</td>
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
        @if(count($data['main']['cervie']['researcher']['copyright']) >= 1)

          <!-- paginate -->
          {{ $data['main']['cervie']['researcher']['copyright']->appends(request()->input())->links(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.pagination.index',['navigation'=>['alignment'=>'center']]) }}
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

<!-- modal filter -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">

    <!-- modal dialog -->
    <div class="modal-dialog" role="document">

      <!-- modal content -->
      <div class="modal-content">

        <!-- form filter -->
        <form action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">

          <!-- modal header -->
          <div class="modal-header">
            <h5 class="modal-title">Filter By</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <!-- end modal header -->

          <!-- modal body -->
          <div class="modal-body">

            <div class="col-md-12">

              <div class="form-group">
                <label for="need_verification">Verification Status</label>
                <select class="form-control select2" id="need_verification" name="need_verification">
                  <option value="">-Select Status-</option>
                  <option value="1">Pending</option>
                  <option value="0">Verified</option>
                </select>

              </div>

            </div>

          </div>
          <!-- end modal body -->

          <!-- modal footer -->
          <div class="modal-footer">
            {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
            <input type="hidden" name="form_token" value="{{ $form_token['filter'] }}"/>
            <button type="submit" class="btn btn-custom">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
          <!-- end modal footer -->

        </form>
        <!-- end form -->

      </div>
      <!-- end modal content -->

    </div>
    <!-- end modal dialog -->

  </div>
  <!-- end modal filter -->


  <!-- Script for dynamic row numbering and file operations -->
  <script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-main"]').on('click',function(event){

      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');



      //Set Form Token
      var form_token = '{{ $form_token["delete"] }}';

      //Set Hyperlink
      var hyperlink  = $(this).data('href');
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
