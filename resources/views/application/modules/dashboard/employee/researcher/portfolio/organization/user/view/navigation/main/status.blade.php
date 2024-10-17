<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'status')?'show active':'') }}" id="status" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['id'=>request()->id,'tab'=>'tab','tab_category'=>'status']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Status</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-6">

                <!-- employee ldap status -->
                <div class="mb-3">
                  <label for="salutation_id" class="form-label">LDAP Status</label>
                  <select class="form-control select2" id="employee_ldap_status_id" name="employee_ldap_status_id">
                    <option value="">-Select Status-</option>

                    {{-- Check Count Data Status Employee LDAP Exist --}}
                    @if(count($data['status']['employee']['ldap']) >= 1)

                      {{-- Get Data Status Employee LDAP Exist --}}
                      @foreach($data['status']['employee']['ldap'] as $key=>$value)

                        <option value="{{ $value->status_id }}" {{ (($data['employee']['ldap']->status_id == $value->status_id)?'selected':'') }}>{{ ucwords($value->name) }} {{ (($data['employee']['ldap']->status_id == $value->status_id)?'(Selected)':'') }}</option>

                      @endforeach
                      {{-- End Get Data Status Employee LDAP Exist --}}

                    @endif
                    {{-- End Check Count Data Status Employee LDAP Exist --}}

                  </select>
                </div>
                <!-- end employee ldap status -->
              </div>
              <!-- end col -->

              <!-- col -->
              <div class="col-6">

                <!-- employee status -->
                <div class="mb-3">
                  <label for="salutation_id" class="form-label">Employee Status <small>(HR Setting)</small> </label>
                  <select class="form-control select2" id="employee_status_id" name="employee_status_id">
                    <option value="">-Select Status-</option>

                    {{-- Check Count Data Status Employee Main Exist --}}
                    @if(count($data['status']['employee']['main']) >= 1)

                      {{-- Get Data Status Employee Main Exist --}}
                      @foreach($data['status']['employee']['main'] as $key=>$value)

                        <option value="{{ $value->status_id }}" {{ (($data['employee']['main']->status_id == $value->status_id)?'selected':'') }}>{{ ucwords($value->name) }} {{ (($data['employee']['main']->status_id == $value->status_id)?'(Selected)':'') }}</option>

                      @endforeach
                      {{-- End Get Data Status Employee Main Exist --}}

                    @endif
                    {{-- End Check Count Data Status Employee Main Exist --}}

                  </select>
                </div>
                <!-- end employee status -->

              </div>
              <!-- end col -->

            </div>
            <!-- end row -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

    <!-- control -->
    <div class="d-flex gap-2 justify-content-end">
      <input type="hidden" name="tab_category" value="status">
      <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->
