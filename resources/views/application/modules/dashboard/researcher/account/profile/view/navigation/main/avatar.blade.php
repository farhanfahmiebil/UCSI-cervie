<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'avatar')?'show active':'') }}" id="avatar" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['tab'=>'tab','tab_category'=>'avatar']) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>My Avatar</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-6 col-12">

            <!-- avatar current -->
            <div class="mb-3">

              <!-- dropzone -->
              <div class="dropzone sm needsclick dz-clickable">
                <div class="dz-message needsclick">
                  <img src="{{ asset(Auth::user()->getAvatar()) }}" class="img-fluid img-7xx rounded-circle" />
                </div>
              </div>
              <!-- end dropzone -->

            </div>
            <!-- end avatar current -->

          </div>
          <!-- end col -->

          <!-- col -->
          <div class="col-sm-6 col-12">

            <!-- upload avatar -->
            <div id="update-avatar" class="mb-3">

              <!-- dropzone -->
              <div class="dropzone sm needsclick dz-clickable">

                <div class="dz-message needsclick">
                  <input type="file" name="avatar" class="dz-button">
                    Update Image.
                  </input>
                </div>

              </div>
              <!-- end dropzone -->


            </div>
            <!-- end upload avatar -->

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
      <input type="hidden" name="tab_category" value="avatar">
      <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">

      {{-- Check Authorization User Status Stop Submit --}}
      @if(!in_array(Auth::user()->employee->status->name,array('pending')))
        <button type="submit" class="btn btn-primary">Save</button>
      @endif
      {{-- End Check Authorization User Status Stop Submit --}}

    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->
