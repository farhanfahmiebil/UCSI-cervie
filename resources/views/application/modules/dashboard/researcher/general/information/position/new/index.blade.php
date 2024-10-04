@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-12 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card body -->
          <div class="card-body">

            <!-- card title -->
            <h4 class="card-title">Add New Position</h4>
            <!-- end card title -->

            <!-- error -->
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <!-- end error -->

            <!-- form -->
            <form action="{{ route($hyperlink['page']['create']) }}" method="POST">
              @csrf

              <!-- row 1 -->
              <div class="row">

                <!-- position -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Position</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name">
                  </div>
                </div>
                <!-- end position -->

                <!-- organization -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="organization_id">Faculty/Department/Institution</label>
                    <select class="form-control select2" id="organization_id" name="organization_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Organization Exist --}}
                      @if(count($data['general']['organization'])>0)

                        {{-- Get General Organization Data --}}
                        @foreach($data['general']['organization'] as $key=>$value)
                          <option value="{{ $value->organization_id }}" {{ ((old('organization_id') == $value->organization_id)?'selected':'') }}>{{ $value->name }}</option>
                        @endforeach
                        {{-- End Get General Organization Data --}}

                      @endif
                      {{-- End Check General Organization Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end organization -->

              </div>
              <!-- end row 1 -->

              <!-- row 2 -->
              <div class="row">

                <!-- date start -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ old('date_start') }}" placeholder=""="">
                  </div>
                </div>
                <!-- end date start -->

                <!-- date end -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_end">Date End</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ old('date_end') }}" placeholder="">
                  </div>
                </div>
                <!-- end date end -->

                <!-- is main -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="is_main">Is Current Position</label>
                    <select class="form-control select2" id="is_main" name="is_main">
                      <option value="1" {{ ((old('is_main') == 1)?'selected':'') }}>Yes</option>
                      <option value="0" {{ ((old('is_main') == 1)?'selected':'') }}>No</option>
                    </select>
                  </div>
                </div>
                <!-- end is main -->

              </div>
              <!-- end row 2 -->

              <!-- row 3 -->
              <div class="row">

                <!-- status -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id">
                      <option value="">-- Please Select --</option>

                      {{-- Check General Status Exist --}}
                      @if(count($data['general']['status']['cervie']['researcher']['position'])>0)

                        {{-- Get General Status Data --}}
                        @foreach($data['general']['status']['cervie']['researcher']['position'] as $key=>$value)
                          <option value="{{ $value->status_id }}" {{ ((old('status_id') == $value->status_id)?'selected':'') }}>{{ ucwords($value->status_name) }}</option>
                        @endforeach
                        {{-- End Get General Status Data --}}

                      @endif
                      {{-- End Check General Status Exist --}}

                    </select>
                  </div>
                </div>
                <!-- end status -->

              </div>
              <!-- end row 3 -->

              <!-- row 4 -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light">Back</a>
                  <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                  <button type="submit" class="btn btn-danger text-white me-2">Submit</button>
                </div>

              </div>
              <!-- end row 4 -->

            </form>
            <!-- end form -->

          </div>
          <!-- card body -->

        </div>
        <!-- end card -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end content -->

@endsection
