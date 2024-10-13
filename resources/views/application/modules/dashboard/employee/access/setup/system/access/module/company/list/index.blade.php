@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

  <!-- error -->
  @if($errors->any())
    <div class="col-md-12">
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
  <!-- end error -->

  <!-- main header -->
  <div class="main-header">

    <!-- flex -->
    <div class="d-flex align-items-center justify-content-center">

      <!-- icon -->
      <div class="page-icon">
        <i class="bi bi-building"></i>
      </div>
      <!-- end icon -->

      <!-- page title -->
      <div class="page-title d-none d-md-block">
        <h5>Company Access</h5>
      </div>
      <!-- end page title -->

    </div>
    <!-- end flex -->

  </div>
  <!-- end main header -->

  <!-- row -->
  <div class="row gx-3">

    <!-- col -->
    <div class="col-sm-12 col-12">

      <!-- card -->
      <div class="card">

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
                    @php

                      // Set Column
                      $column = [];

                      // Ensure the data is an array
                      $raw['status']['module']['company'] = $data['status']['module']['company'];

                      // Check if $status is a collection and convert to array if needed
                      if($raw['status']['module']['company'] instanceof \Illuminate\Support\Collection){
                        $raw['status']['module']['company'] = $raw['status']['module']['company']->toArray();
                      }

                      // Extract Status ID
                      $column['status']['module']['company'] = array_column($raw['status']['module']['company'],'status_id');

                    @endphp

                    @if(in_array(request()->input('status_id'),$column['status']['module']['company']))

                        {{-- Find the index of the employee_ldap_status_id in the array --}}
                        @php
                          $index = array_search(request()->input('status_id'),$column['status']['module']['company']);
                          $filter['status']['module']['company'] = $data['status']['module']['company'][$index]->name;
                        @endphp

                    @else

                      {{-- Display Dash If Not Found --}}
                      -
                      @php $filter['status']['module']['company'] = '-' @endphp

                    @endif

                    {{-- Check Status --}}
                    @if(!empty(request()->input('status_id')))

                      Status :
                      <span class="badge bg-{{
                          (
                            ($filter['status']['module']['company'] === 'active')?'success':
                            (
                              ($filter['status']['module']['company']=== 'inactive')?'warning':
                              (
                                ($filter['status']['module']['company'] === 'deleted')?'danger':'info'
                              )
                            )
                          ) }}">

                          {{ ucwords($filter['status']['module']['company']) }}

                      </span>

                    @endif
                    {{-- End Check Status --}}

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
                  <form action="{{ route($hyperlink['page']['list'],['company_id'=>request('company_id')]) }}" method="GET">

                    <div class="input-group">
                      <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name"/>
                      {!! ((!empty(request()->input('search')))?'<input type="hidden" name="status" value="'.request()->input('search').'"/>':'') !!}
                      {!! ((!empty(request()->input('module_company_id')))?'<input type="hidden" name="module_company_id" value="'.request()->input('module_company_id').'"/>':'') !!}
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

          <!-- button back -->
          <a href="{{ route($hyperlink['page']['home']) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Back">
            <i class="bi bi-arrow-left-short"></i>
          </a>
          <!-- end button new -->

          <!-- button new -->
          <a href="{{ route($hyperlink['page']['new'],['company_id'=>request('company_id')]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Add">
            <i class="bi bi-plus-lg"></i>
          </a>
          <!-- end button new -->

          <!-- button search -->
          <a id="search-box" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Search">
  					<i class="bi bi-search"></i>
  				</a>
          <!-- button search -->

          <!-- button refresh -->
  				<a href="{{ route($hyperlink['page']['list'],['company_id'=>request('company_id')]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Refresh">
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
          <form id="form-sort" action="{{ route($hyperlink['page']['list'],['company_id'=>request('company_id')]) }}" method="GET">
            <input type="hidden" name="form_token" value="{{ $form_token['sort'] }}"/>
            <input type="hidden" id="sorting_column" name="sorting_column" value=""/>
            <input type="hidden" id="sorting" name="sorting" value="{{ request()->input('sorting') }}"/>
            <input type="hidden" id="sorting_display" name="sorting_display" value="{{ request()->input('sorting_display') }}"/>
            {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
            {!! ((!empty(request()->input('module_company_id')))?'<input type="hidden" name="module_company_id" value="'.request()->input('module_company_id').'"/>':'') !!}
            {!! ((!empty(request()->input('status_id')))?'<input type="hidden" name="employee_status_id" value="'.request()->input('status_id').'"/>':'') !!}
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

          <!-- form checklist -->
          <form id="form-checklist" action="{{ route($hyperlink['page']['delete'],['company_id'=>request('company_id')]) }}" method="GET">

            <!-- table responsive -->
            <div class="table-responsive">

              <!-- hidden -->
              <input type="hidden" id="form_token" name="form_token" value=""/>
              <input type="hidden" id="remark" name="remark" value=""/>
              <!-- end hidden -->

              <!-- table -->
              <table class="table align-middle">

                <!-- thead -->
                <thead>
                  <tr class="text-start">
                    {{-- Check Main Data Column Exist --}}
                    @if(count($data['main']['column']) >= 1)

                      {{-- Get Main Data --}}
                      @foreach($data['main']['column'] as $key=>$value)

                      <th>{!! $value !!}</th>

                      @endforeach
                      {{-- End Get Main Data --}}

                    @else
                      <th>Column Not Defined</th>
                    @endif

                    {{-- End Check Main Data Column Exist --}}
                  </tr>
                </thead>
                <!-- end thead -->

                <!-- tbody -->
                <tbody>

                  {{-- Check Main Data Exist --}}
                  @if(count($data['main']['data'] ) >= 1)

                    {{-- Get Main Data --}}
                    @foreach($data['main']['data'] as $key=>$value)

                      @php

                        //Set Default Avatar;
                        $avatar = URL::asset('images/avatar/anonymous.png');

                      @endphp

                      <tr id="{{ $value->module_company_id }}">
                        <td>
                          <div class="form-check">
                            <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->module_company_id }}"/>
      										</div>
                        </td>

                        <td>
                          {{ (($value->company_id)?$value->company_id:'-') }}
                        </td>

                        <td>
                          {{ (($value->company_name)?$value->company_name:'-') }}
                        </td>

                        <td>
                          {{ (($value->module_company_id)?$value->module_company_id:'-') }}
                        </td>

                        <td>
                          {{ (($value->name)?$value->name:'-') }}
                        </td>

                        <td>
                          <i class='{{ (($value->icon)?$value->icon:'') }}'></i>
                        </td>

                        <td>
                          {{ (($value->domain_url)?$value->domain_url:'-') }}
                        </td>

                        <td>
                          <span class="badge bg-{{
                            (
                              ($value->status_name === 'active')?'success':
                              (
                                ($value->status_name === 'inactive')?'warning':
                                (
                                  ($value->status_name === 'deleted')?'danger':'gray'
                                )
                              )
                            ) }}">
                            {{ ucwords($value->status_name) }}
                          </span>
                        </td>

                        <td>
                          <a href="{{ route($hyperlink['page']['view']['detail'],['company_id'=>$value->company_id,'id'=>$value->module_company_id]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="bi bi-pencil"></i></a>
                          @if($value->status_name == 'deleted')
                            <button type="button" data-id="{{ $value->module_company_id }}" class="modal-revert btn btn-primary" data-toggle="tooltip" data-placement="top" title="Revert"><i class="bi bi-recycle"></i></button>
                          @endif
                        </td>

                      </tr>

                    @endforeach
                    {{-- End Get Main Data --}}

                  @endif
                  {{-- End Check Main Data Exist --}}

                </tbody>
                <!-- end tbody -->

              </table>
              <!-- end table -->

            </div>
            <!-- end table responsive -->

          </form>
          <!-- end form -->

          {{-- Check Main Data Exist --}}
          @if(count($data['main']['data'] ) >= 1)

            <!-- paginate -->
            {{-- $data['main']['data']->appends(request()->input())->links(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.pagination.index',['navigation'=>['alignment'=>'center']]) --}}
            <!-- end paginate -->

          @endif
          {{-- End Check Main Data Exist --}}


        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <!-- modal filter -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">

    <!-- modal dialog -->
    <div class="modal-dialog" role="document">

      <!-- modal content -->
      <div class="modal-content">

        <!-- form filter -->
        <form action="{{ route($hyperlink['page']['list'],['company_id'=>request('company_id')]) }}" method="GET">

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

            <div class="col-md-12 pt-3">

              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control select2" id="status_id" name="status_id">
                  <option value="">-Select Status-</option>

                  {{-- Check Count Data Status Exist --}}
                  @if(count($data['status']['module']['company']) >= 1)

                    {{-- Get Data Status Exist --}}
                    @foreach($data['status']['module']['company'] as $key=>$value)

                      <option value="{{ $value->status_id }}">{{ ucwords($value->name) }}</option>

                    @endforeach
                    {{-- End Get Data Status Exist --}}

                  @endif
                  {{-- End Check Count Data Status Exist --}}

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

  {{-- Pop Alert --}}
  @include($hyperlink['navigation']['layout']['dashboard']['employee']['modal']['pop_alert'])

  <script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Session
    **************************************************************************************/
    @if(Session('message'))
      alertModal(
        {
          'modal_name':'modal-alert',
          'title':'{{ ucwords(Session::get('alert_type')) }}',
          'message':'{{ ucwords(Session::get('message')) }}'
        }
      );
    @endif

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[id="modal-delete"]').on('click',function(event){
      modeModal(
        {
          'form_name':'form-checklist',
          'modal_name':'modal-soft-delete',
          'data':[{
                    'token':{!! json_encode($form_token['delete']) !!}
                 }],
        }
      );
    });

    /**************************************************************************************
      Modal Revert
    **************************************************************************************/
    $('[class*="modal-revert"]').on('click',function(event){
      // console.log($(this).attr('data-id'));
      modeModal(
        {
          'id':$(this).attr('data-id'),
          'form_name':'form-checklist',
          'modal_name':'modal-revert',
          'data':[{
                  'token':{!! json_encode($form_token['revert']) !!}
                 }],
        }
      );
    });

  });
  </script>

@endsection
