<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'contact')?'show active':'') }}" id="contact" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['id'=>request()->id,'tab'=>'tab','tab_category'=>'contact']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Work</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- sub title -->
          <div class="col-xxl-12">
						<div class="form-section-title p-3 mt-4 mb-3 fw-bold">
							Office Contact Details
						</div>
					</div>
          <!-- end sub title -->

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-6">

                <!-- office number -->
                <div class="mb-3">
                  <label for="office_telephone_number" class="form-label">Office Telephone Number</label>
                  <input type="hidden" name="contact_category_id[]" value="2">
                  <input type="text" class="form-control" name="name[]" id="office_telephone_number" placeholder="038754542" value="{{ ((isset($data['employee']['contact']['office']['telephone']['number']))?$data['employee']['contact']['office']['telephone']['number']->name:'') }}">
                </div>
                <!-- end office number -->

              </div>
              <!-- end col -->

              <!-- col -->
              <div class="col-6">

                <!-- office number extension -->
                <div class="mb-3">
                  <label for="office_telephone_extension_number" class="form-label">Office Telephone Extension</label>
                  <input type="hidden" name="contact_category_id[]" value="3">
                  <input type="text" class="form-control" name="name[]" id="office_telephone_extension_number" placeholder="" value="{{ ((isset($data['employee']['contact']['office']['telephone_extension']['number']))?$data['employee']['contact']['office']['telephone_extension']['number']->name:'') }}">
                </div>
                <!-- end office number extension -->

              </div>
              <!-- end col -->

            </div>
            <!-- end row -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

        <!-- row -->
        <div class="row gx-3">

          <!-- sub title -->
          <div class="col-xxl-12">
						<div class="form-section-title p-3 mt-4 mb-3 fw-bold">
							Office Email Details
						</div>
					</div>
          <!-- end sub title -->

          <!-- col -->
          <div class="col-6">

            <!-- office number -->
            <div class="mb-3">
              <label for="email_external" class="form-label">External Email</label>
              <input type="hidden" name="contact_category_id[]" value="12">
              <input type="text" class="form-control" name="name[]" id="email_external" placeholder="" value="{{ ((isset($data['employee']['contact']['email']['office']['internal']))?$data['employee']['contact']['email']['office']['internal']->name:'') }}">
            </div>
            <!-- end office number -->

          </div>
          <!-- end col -->

          <!-- col -->
          <div class="col-6">

            <!-- office number extension -->
            <div class="mb-3">
              <label for="email_internal" class="form-label">Internal Email</label>
              <input type="hidden" name="contact_category_id[]" value="13">
              <input type="text" class="form-control" name="name[]" id="email_internal" placeholder="" value="{{ ((isset($data['employee']['contact']['email']['office']['external']))?$data['employee']['contact']['email']['office']['external']->name:'') }}">
            </div>
            <!-- end office number extension -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Personal</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- sub title -->
          <div class="col-xxl-12">
						<div class="form-section-title p-3 mt-4 mb-3 fw-bold">
							Mobile Details
						</div>
					</div>
          <!-- end sub title -->

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-6">

                <!-- office number -->
                <div class="mb-3">
                  <label for="office_telephone_number" class="form-label">Mobile Number</label>
                  <input type="hidden" name="contact_category_id[]" value="6">
                  <input type="text" class="form-control" name="name[]" id="mobile_number" placeholder="038754542" value="{{ ((isset($data['employee']['contact']['mobile']['phone']['number']))?$data['employee']['contact']['mobile']['phone']['number']->name:'') }}">
                </div>
                <!-- end office number -->

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
      <input type="hidden" name="tab_category" value="contact">
      <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->
