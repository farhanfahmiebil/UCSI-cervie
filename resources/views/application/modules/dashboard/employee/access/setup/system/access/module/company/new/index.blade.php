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
        <i class="bi bi-file-plus"></i>
      </div>
      <!-- end icon -->

      <!-- page title -->
      <div class="page-title d-none d-md-block">
        <h5>New Company Access</h5>
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
        <div class="card-header">


        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- form -->
          <form action="{{ route($hyperlink['page']['create'],['company_id'=>request('company_id')]) }}" method="POST">

            <!-- row -->
            <div class="row">

              <!-- module company id -->
              <div class="col-md-6">
                <div class="m-0">
									<label for="module_company_id" class="form-label">Module Company ID</label>
									<input type="text" class="form-control" id="module_company_id" name="module_company_id" value="{{ old('module_company_id') }}" placeholder="Example: UCSI_GROUP_{CATEGORY}">
								</div>
              </div>
              <!-- end module company id -->

              <!-- module company name -->
              <div class="col-md-6">
                <div class="m-0">
									<label for="module_company_name" class="form-label">Module Company Name</label>
									<input type="text" class="form-control" id="module_company_name" name="module_company_name" value="{{ old('module_company_name') }}" placeholder="">
								</div>
              </div>
              <!-- end module company name -->

            </div>
            <!-- end row -->

            <!-- row -->
            <div class="row pt-3">

              <!-- company -->
              <div class="col-md-6">
                <div class="m-0">
									<label for="company_id" class="form-label">Company</label>
                  <select class="form-control select2" id="company_id" name="company_id">
                    <option value="">-Select Company-</option>

                    {{-- Check Count Data Status Exist --}}
                    @if(count($data['general']['company']) >= 1)

                      {{-- Get Data Status Exist --}}
                      @foreach($data['general']['company'] as $key=>$value)

                        <option value="{{ $value->company_id }}" {{ (($value->company_id == old('company_id'))?'selected':'') }}>{{ ucwords($value->company_name) }}</option>

                      @endforeach
                      {{-- End Get Data Status Exist --}}

                    @endif
                    {{-- End Check Count Data Status Exist --}}

                  </select>

								</div>
              </div>
              <!-- end company -->

              <!-- icon -->
              <div class="col-md-3">
                <div class="m-0">
									<label for="icon" class="form-label">Icon</label>
                  <select class="form-control select2" id="icon_id" name="icon_id">
                    <option value="">-Select Icon-</option>

                    {{-- Check Count Data Status Exist --}}
                    @if(count($data['general']['icon']['reference']) >= 1)

                      {{-- Get Data Status Exist --}}
                      @foreach($data['general']['icon']['reference'] as $key=>$value)

                        <optgroup label="{{ $value->name }} [{{ $value->version }}]">

                          {{-- Check Count Data Status Exist --}}
                          @if(count($data['general']['icon']['main']) >= 1)

                            {{-- Get Data Status Exist --}}
                            @foreach($data['general']['icon']['main'] as $k=>$v)

                              @if($value->icon_reference_id == $v->icon_reference_id)
                                <option value="{{ $v->icon_id }}" {{ (($v->icon_id == old('icon_id'))?'selected':'') }}>{{ $v->name }}</option>
                              @endif

                            @endforeach
                            {{-- End Get Data Status Exist --}}

                          @endif
                          {{-- End Check Count Data Status Exist --}}

                        </optgroup>

                      @endforeach
                      {{-- End Get Data Status Exist --}}

                    @endif
                    {{-- End Check Count Data Status Exist --}}

                  </select>
								</div>
              </div>
              <!-- end icon -->

              <!-- ordering -->
              <div class="col-md-3">
                <div class="m-0">
									<label for="ordering" class="form-label">Ordering</label>
									<input type="number" class="form-control" id="ordering" name="ordering" value="{{ old('ordering') }}" placeholder="">
								</div>
              </div>
              <!-- end ordering -->

            </div>
            <!-- end row -->

            <!-- row -->
            <div class="row pt-3">

              <!-- status -->
              <div class="col-md-6">
                <div class="m-0">
									<label for="status_id" class="form-label">Status</label>
                  <select class="form-control select2" id="status_id" name="status_id">
                    <option value="">-Select Status-</option>

                    {{-- Check Count Data Status Exist --}}
                    @if(count($data['general']['status']) >= 1)

                      {{-- Get Data Status Exist --}}
                      @foreach($data['general']['status'] as $key=>$value)

                        <option value="{{ $value->status_id }}" {{ (($value->status_id == old('status_id'))?'selected':'') }}>{{ ucwords($value->name) }}</option>

                      @endforeach
                      {{-- End Get Data Status Exist --}}

                    @endif
                    {{-- End Check Count Data Status Exist --}}

                  </select>

								</div>
              </div>
              <!-- end status -->

            </div>
            <!-- end row -->

            <!-- row -->
            <div class="row py-3 text-end">

              <!-- form control -->
              <div class="col-12">
                <input type="text" name="form_token" value="{{ $form_token['create'] }}">
                <a href="{{ route($hyperlink['page']['list'],['company_id'=>request('company_id')]) }}" class="btn btn-light">Back</a>
                <input type="submit" class="btn btn-primary" name="submit" value="Create">
              </div>
              <!-- end form control -->

            </div>
            <!-- end row -->

          </form>
          <!-- end form -->

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

  });

  </script>

@endsection
