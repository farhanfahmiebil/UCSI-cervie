  <!-- tab pane -->
  <div class="tab-pane fade {{ ((request()->tab_category == 'profile')?'show active':'') }}" id="profile" role="tabpanel">

    {{-- Check Data Main --}}
    @if($data['researcher']->need_verification_main || $data['researcher']->need_verification_scopus)

    <div class="alert alert-warning" role="alert">
      This Record is still Pending for Administrator to make Verification
    </div>

    @endif
    {{-- End Check Data Main --}}


    <!-- form -->
    <form action="{{ route($hyperlink['page']['update'],['tab'=>'tab','tab_category'=>'personal']) }}" method="POST">
      {{csrf_field()}}

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">
          <h3>Profile Information</h3>
        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row gx-3">

            <!-- col -->
            <div class="col-sm-12 col-12">

              <!-- row -->
              <div class="row">

                <!-- col -->
                <div class="col-12">

                  <!-- description -->
                  <div class="mb-3">
                    <label for="salutation_id" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ $data['researcher']->description }}</textarea>
                  </div>
                  <!-- end description -->

                </div>
                <!-- end col -->

              </div>
              <!-- end row -->

              <!-- row 2 -->
              <div class="row">

                <!-- conferring body -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="scopus_id" class="form-label">Scopus ID</label>
                    <input type="text" class="form-control"  id="scopus_id" name="scopus_id" placeholder="Scopus ID" value="{{ $data['researcher']->scopus_id }}">
                  </div>
                </div>
                <!-- end conferring body -->

                <!-- title -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hyperlink" class="form-label">Scopus Hyperlink</label>
                    <input type="text" class="form-control"  id="hyperlink" name="hyperlink" placeholder="Scopus Hyperlink" value="{{ $data['researcher']->hyperlink }}">
                  </div>
                </div>
                <!-- end title -->

              </div>
              <!-- end row 2 -->

            </div>
            <!-- end col -->

          </div>
          <!-- end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

      <!-- control -->

      <!-- form control -->
      <div class="row text-end pt-3">

        <!-- control -->
        <div class="col-md-12">

          <input type="hidden" name="tab_category" value="profile">
          <input type="hidden" name="researcher_scopus_id" value="{{($data['researcher']->researcher_scopus_id)?$data['researcher']->researcher_scopus_id:null}}">
          <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
          <button type="submit" class="btn btn-danger text-white"><i class="mdi mdi-plus"></i>Update</button>

        </div>
        <!-- end control -->

      </div>
      <!-- end form control -->


    </form>
    <!-- end form -->

  </div>
  <!-- end tab pane -->
