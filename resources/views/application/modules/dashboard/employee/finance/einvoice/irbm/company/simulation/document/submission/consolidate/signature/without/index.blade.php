@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- form -->
<form action="{{ route($hyperlink['page']['process']) }}" method="POST">
{{ csrf_field() }}

  <!-- row -->
  <div class="row">

    <!-- col -->
    <div class="col-md-12">

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

    </div>
    <!-- end col -->

  </div>
  <!--end row -->

  <!-- row -->
  <div class="row gx-3">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Einvoice Setting
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row pt-1">

            <!-- einvoice invoice period -->
            <div class="col-12 pb-3">

              <div class="form-group">

                <label for="einvoice_invoice_period_id">Invoice Period</label>
                <select class="select2" id="einvoice_invoice_period_id" name="einvoice_invoice_period_id">
                  <option value="">--Please Select Invoice Period--</option>
                  {{-- Check Data Einvoice Invoice Period Exist --}}
                  @if(count($data['general']['einvoice']['invoice']['period']) > 0)

                    {{-- Get Data Einvoice Invoice Period --}}
                    @foreach($data['general']['einvoice']['invoice']['period'] as $key=>$value)

                      <option value="{{ $value->einvoice_invoice_period_id }}" {{ (($value->einvoice_invoice_period_id == 'YEAR')?'selected':'') }}>{{ $value->einvoice_invoice_period_name }}</option>

                    @endforeach
                    {{-- End Get Data Einvoice Invoice Period --}}

                  @endif
                  {{-- End Check Data Einvoice Invoice Period Exist --}}

                </select>

              </div>

            </div>
            <!-- end einvoice invoice period -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_year" class="row pt-1 d-none">

            <!-- month -->
            <div class="col-6">

              <div class="form-group">

                <label for="year_start">Year</label>
                <select class="select2" id="year_start" name="year_start">
                  <option value="">--Please Select Year--</option>

                  {{-- Check Data Year Exist --}}
                  @if(count($data['general']['year']) > 0)

                    {{-- Get Data Year --}}
                    @foreach($data['general']['year'] as $key=>$value)

                      <option value="{{ $value }}">{{ $value }}</option>

                    @endforeach
                    {{-- End Get Data Year --}}

                  @endif
                  {{-- End Check Data Year Exist --}}

                </select>

              </div>

            </div>
            <!-- end month -->

          </div>
          <!--end row -->


          <!-- row -->
          <div id="group_month" class="row pt-1 d-none">

            <!-- month -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label for="month_start">Month</label>
                <input class="form-control" type="month" id="month_start" name="month_start" value="">

              </div>

            </div>
            <!-- end month -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_week" class="row pt-1 d-none">

            <!-- week -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label for="day_week_start">Week</label>
                <select class="select2" id="day_week_start" id="day_week_start" name="day_week_start">
                  <option value="">--Please Select Week--</option>

                  {{-- Check Data Day Week Exist --}}
                  @if(count($data['general']['year']) > 0)

                    {{-- Get Data Week --}}
                    @foreach($data['general']['day']['week'] as $key=>$value)

                      <option value="{{ $value->day_week_id }}">{{ $value->day_week_name }}</option>

                    @endforeach
                    {{-- End Get Data Week --}}

                  @endif
                  {{-- End Check Data Week Exist --}}

                </select>

              </div>

            </div>
            <!-- end week -->

          </div>
          <!--end row -->

          <!-- row -->
          <div id="group_daily" class="row pt-1 d-none">

            <!-- date start -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label class="d-flex justify-content-between align-items-center" for="date_start">
                 Date Start
                 <span class="d-flex align-items-center">
                   <!-- <input class="ms-2" type="checkbox" id="is_same_day" name="is_today" value="">&nbsp;&nbsp;Today -->
                 </span>
               </label>
                <input class="form-control" type="date" id="date_start" name="date_start" value="">

              </div>

            </div>
            <!-- end date start -->

            <!-- date end -->
            <div class="col-6 pb-3">

              <div class="form-group">

                <label class="d-flex justify-content-between align-items-center" for="date_end">
                 Date End
                 <span class="d-flex align-items-center">
                   <input class="ms-2" type="checkbox" id="is_same_day" name="is_same_day" value="">&nbsp;&nbsp;Same Day as Date Start
                 </span>
               </label>
                <input class="form-control" type="date" id="date_end" name="date_end" value="">

              </div>

            </div>
            <!-- end date end -->

          </div>
          <!--end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <!-- row -->
  <div class="row gx-3">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Company Information
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- group company information required -->
          <div id="group_company_information_required">
            Please Select Date in Order to Proceed
          </div>
          <!-- end group company information required -->

          <!-- group company information required -->
          <div id="group_company_information" class="d-none">

            <!-- row -->
            <div class="row pt-3">

              <!-- company -->
              <div class="col-6">

                <div class="form-group">

                  <label for="company_id">Company</label>
                  <select class="select2" id="company_id" name="company_id">
                    <option value="">--Please Select Company--</option>

                    {{-- Check Data Company Exist --}}
                    @if(count($data['company']) > 0)

                      {{-- Get Data Company --}}
                      @foreach($data['company'] as $key=>$value)

                        <option value="{{ $value->company_id }}" {{ (($value->is_available == 0)?'disabled':'') }}>{{ $value->company_name }}</option>

                      @endforeach
                      {{-- End Get Data Company --}}

                    @endif
                    {{-- End Check Data Company Exist --}}

                  </select>

                </div>

              </div>
              <!-- end company -->

              <!-- company office -->
              <div id="group_company_office" class="col-6 d-none">

                <div class="form-group">

                  <label for="company_office_id">Company Office</label>
                  <select class="select2" id="company_office_id" name="company_office_id">

                  </select>

                </div>

              </div>
              <!-- end company office -->

            </div>
            <!-- end row -->

          </div>
          <!-- end group company information -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <!-- row -->
  <div id="group_company_receipt" class="row gx-3 d-none">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Invoice
          </div>
          <!-- end card title -->

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- spinner -->
          <div class="loader row justify-content-center d-none">
            <div class="spinner-border text-red" role="status"></div>
          </div>
          <!-- end spinner -->

          <!-- row -->
          <div class="result row d-none1 pt-3">

            <!-- row -->
            <div class="row py-3">

              <!-- search -->
              <div class="col-10">
                <div class="input-group">
									<input type="text" class="form-control" id="search_invoice" name="search_invoice" placeholder="">
									<button class="btn btn-outline-secondary" id="button_search_invoice" type="button">
										<i class="bi bi-search"></i>
									</button>
								</div>
              </div>
              <!-- end search -->

              <!-- sort -->
              <div class="col-2">
                <div class="form-group">
                  <select class="select2" id="invoice_sort" name="sort">
                    <option value="">Sort By</option>
                    <option value="customer_id asc">Customer ID (Asc)</option>
                    <option value="customer_id desc">Customer ID (Desc)</option>
                  </select>
                </div>
              </div>
              <!-- end sort -->

            </div>
            <!-- end row -->

            <!-- row -->
            <div class="row">

              <div class="table-responsive">
                <table id="invoice_table" class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Checkbox</th>
                      <th>Receipt</th>
                      <th>Amount</th>
                      <th>Customer</th>
                      <th>Tax Identification</th>
                      <th>Customer Tin</th>
                      <th>Document</th>
                      <th>Document Status</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="receipt_id">
                    <!-- Dynamic rows will be appended here -->
                  </tbody>
                </table>
              </div>

            </div>
            <!-- end row -->

          </div>
          <!--end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <hr>

  <!-- row -->
  <div class="row gx-3">

    <!-- col -->
    <div class="col-md-12">

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">

          <!-- card title -->
          <div class="card-title">
            Customer Information (For SandBox Purpose)

          </div>
          <!-- end card title -->
          <small class="text-danger">NRIC No/Passport in data above will be ignored.</small>

        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row pt-3">

            <!-- name -->
            <div class="col-6">

              <div class="form-group">

                <label for="customer_name">Name</label>
                <input type="text" class="form-control" name="customer_name" value="{{ $data['general']['einvoice']['invoice']['consolidate']['data']->name }}">

              </div>

            </div>
            <!-- end name -->

            <!-- tax identification no -->
            <div class="col-6">

              <div class="form-group">

                <label for="customer_tin_no">Customer TIN No</label>
                <input type="text" class="form-control" name="customer_tin_no" value="{{ $data['general']['einvoice']['invoice']['consolidate']['data']->tin_no }}">

              </div>

            </div>
            <!-- end tax identification no -->

          </div>
          <!-- end row -->

          <!-- row -->
          <div class="row pt-3">

            <!-- tax identification type id -->
            <div class="col-6">

              <div class="form-group">

                <label for="tax_identification_type_id">Tax Identification</label>
                <input type="text" class="form-control" name="customer_tax_identification_type_id" value="{{ $data['general']['einvoice']['invoice']['consolidate']['data']->tax_identification_type_id }}">

              </div>

            </div>
            <!-- end tax identification type id -->

            <!-- tax identification value -->
            <div class="col-6">

              <div class="form-group">

                <label for="tax_identification_type_value">Value</label>
                <input type="text" class="form-control" name="customer_tax_identification_type_value" value="{{ $data['general']['einvoice']['invoice']['consolidate']['data']->tax_identification_type_value }}">

              </div>

            </div>
            <!-- end tax identification value -->

          </div>
          <!--end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end col -->

  </div>
  <!-- end row -->

  <!-- row -->
  <div class="row">

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">

        <!-- card title -->
        <div class="card-title">
          Form Default
        </div>
        <!-- end card title -->

      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row">

          <!-- phase category id -->
          <div class="col-6">

            <div class="form-group">

              <label for="phase_category_id">Phase Category ID</label>
              <input type="text" class="form-control" id="phase_category_id" name="phase_category_id" value="1">

            </div>

          </div>
          <!-- end phase category id -->

          <!-- einvoice type id -->
          <div class="col-6">

            <div class="form-group">

              <label for="einvoice_type_id">Einvoice Type ID</label>
              <input type="text" class="form-control" name="einvoice_type_id" value="01">

            </div>

          </div>
          <!-- end einvoice type id -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row pt-3">

          <!-- einvoice document type id -->
          <div class="col-6">

            <div class="form-group">

              <label for="einvoice_document_type_id">Value</label>
              <input type="text" class="form-control" name="einvoice_document_type_id" value="XML">

            </div>

          </div>
          <!-- end einvoice document type id -->

          <!-- company tin no -->
          <div class="col-6">

            <div class="form-group">

              <label for="company_tin_no">Company TIN No</label>
              <input type="text" class="form-control" id="company_tin_no" name="company_tin_no" value="">

            </div>

          </div>
          <!-- end company tin no -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row pt-3">

          <!-- company tax identification type id -->
          <div class="col-6">

            <div class="form-group">

              <label for="company_tax_identification_type_id">Company Tax Identification Type</label>
              <input type="text" class="form-control" name="company_tax_identification_type_id" value="BRN">

            </div>

          </div>
          <!-- end company tax identification type id -->

          <!-- company tax identification type value -->
          <div class="col-6">

            <div class="form-group">

              <label for="company_tax_identification_type_value">Company Tax Identification Value</label>
              <input type="text" class="form-control" id="company_tax_identification_type_value" name="company_tax_identification_type_value" value="">

            </div>

          </div>
          <!-- end company tax identification type value -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row pt-3">

          <!-- use signature -->
          <div class="col-6">

            <div class="form-group">

              <label for="use_signature">Use Signature</label>
              <input type="text" class="form-control" name="use_signature" value="false">

            </div>

          </div>
          <!-- end use signature -->

          <!-- signature version -->
          <div class="col-6">

            <div class="form-group">

              <label for="signature_version">Signature Version</label>
              <input type="text" class="form-control" name="signature_version" value="1.0">

            </div>

          </div>
          <!-- end signature version -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row pt-3">

          <!-- use customer default for testing -->
          <div class="col-6">

            <div class="form-group">

              <label for="use_testing_customer">Use Customer Default for Testing</label>
              <input type="text" class="form-control" name="use_testing_customer" value="0">

            </div>

          </div>
          <!-- end use customer default for testing -->

          <!-- use document submission category default for testing -->
          <div class="col-6">

            <div class="form-group">

              <label for="einvoice_submission_category">Einvoice Submission Category</label>
              <input type="text" class="form-control" name="einvoice_submission_category" value="consolidate">

            </div>

          </div>
          <!-- end use document submission category default for testing -->

        </div>
        <!--end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

    <!-- form-control -->
    <div class="col-12 text-end pt-3">

      <div class="form-group">
        <button type="submit" id="submit" class="btn btn-danger" name="button">Go <i class="bi bi-arrow-right"></i></button>
      </div>

    </div>
    <!-- end form-control -->

  </div>
  <!-- end row -->

</form>
<!-- end form -->

@include($page['script']['function'])
@include($page['script']['general'])


@endsection
