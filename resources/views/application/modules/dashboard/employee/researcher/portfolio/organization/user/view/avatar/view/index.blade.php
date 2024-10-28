<!-- form -->
<form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" enctype="multipart/form-data" method="POST">
@csrf

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
            <h4 class="card-title">Avatar Information</h4>
            <!-- end card title -->

            <hr>

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

            <!-- row 1 -->
            <div class="row pt-3">

              <!-- representation category id -->
              <div class="col-md-6">

                <!-- dropzone -->
                <div class="dropzone sm needsclick dz-clickable">
                  <div class="dz-message needsclick">
                    <img src="{{ asset(Auth::user()->getAvatar()) }}" class="img-7xx rounded-circle" />
                  </div>
                </div>
                <!-- end dropzone -->

              </div>
              <!-- end representation category id -->

              <!-- date award -->
              <div class="col-md-6">

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
              <!-- end date award -->

            </div>
            <!-- end row 1 -->

          </div>
          <!-- card body -->

          <!-- card footer -->
          <div class="card-footer">

            <!-- form control -->
            <div class="row text-end">

              <div class="col-md-12">
                <input type="hidden" name="employee_id" value="{{ request()->employee_id }}">
                <input type="hidden" name="organization_id" value="{{ request()->organization_id }}">
                <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
                <button type="submit" class="btn btn-danger text-white me-2"><i class="bi bi-plus"></i>Create</button>
              </div>

            </div>
            <!-- end form control -->

          </div>
          <!-- end card footer -->

        </div>
        <!-- end card -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end content -->

</form>
<!-- end form -->
