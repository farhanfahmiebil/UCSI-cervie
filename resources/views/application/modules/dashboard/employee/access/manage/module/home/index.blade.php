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
        <i class="bi bi-stickies"></i>
      </div>
      <!-- end icon -->

      <!-- page title -->
      <div class="page-title d-none d-md-block">
        <h5>Module</h5>
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
          <div class="card col-md-6">
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

          <!-- sorted by -->
          <div class="card col-md-6">
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
                  <form action="{{ route($hyperlink['page']['list']) }}" method="GET">

                    <div class="input-group">
                      <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name"/>
                      {!! ((!empty(request()->input('search')))?'<input type="hidden" name="status" value="'.request()->input('search').'"/>':'') !!}
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

          <!-- button search -->
          <a id="search-box" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Search">
  					<i class="bi bi-search"></i>
  				</a>
          <!-- button search -->

          <!-- button refresh -->
  				<a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Refresh">
  					<i class="bi bi-bootstrap-reboot"></i>
  				</a>
          <!-- end button refresh -->

          <!-- button sort -->
          <div class="btn-group">
            <button type="button" class="btn btn-icons btn-custom dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Sort">
              <i class="bi bi-filter"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item sort-item" href="#" data-sort-id="company_id" data-sort="asc" data-sort-display="Name">Company ID [Asc]</a></li>
              <li><a class="dropdown-item sort-item" href="#" data-sort-id="company_id" data-sort="desc" data-sort-display="Name">Company ID [Desc]</a></li>
              <li><a class="dropdown-item sort-item" href="#" data-sort-id="company_name" data-sort="asc" data-sort-display="Name">Company Name [Asc]</a></li>
              <li><a class="dropdown-item sort-item" href="#" data-sort-id="company_name" data-sort="desc" data-sort-display="Name">Company Name [Desc]</a></li>
            </ul>
          </div>
          <!-- end button sort -->

          <!-- form sort -->
          <form id="form-sort" action="{{ route($hyperlink['page']['list']) }}" method="GET">
            <input type="hidden" name="form_token" value="{{ $form_token['sort'] }}"/>
            <input type="hidden" id="sorting_column" name="sorting_column" value=""/>
            <input type="hidden" id="sorting" name="sorting" value="{{ request()->input('sorting') }}"/>
            <input type="hidden" id="sorting_display" name="sorting_display" value="{{ request()->input('sorting_display') }}"/>
            {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
            {!! ((!empty(request()->input('status_id')))?'<input type="hidden" name="employee_status_id" value="'.request()->input('status_id').'"/>':'') !!}
          </form>
          <!-- end form sort -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- form checklist -->
          <div id="form-checklist">

            <!-- table responsive -->
            <div class="table-responsive">

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

                      <tr id="{{ $value->company_id }}">

                        <td>
                          {{ (($value->company_id)?$value->company_id:'-') }}
                        </td>

                        <td>
                          {{ (($value->company_name)?$value->company_name:'-') }}
                        </td>

                        <td>
                          {{ (($value->domain_url)?$value->domain_url:'-') }}
                        </td>

                        <td>
                          <a href="{{ route($hyperlink['page']['view'],['company_id'=>$value->company_id]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="bi bi-arrow-right-square-fill"></i></a>
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

          </div>
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
