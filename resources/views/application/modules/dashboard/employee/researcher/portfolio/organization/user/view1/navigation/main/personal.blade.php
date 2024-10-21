<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'personal')?'show active':'') }}" id="personal" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'personal']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Personal Information</h3>
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

                <!-- full name -->
                <div class="mb-3">
                  <label for="fullName" class="form-label">Full Name</label>
                  <input type="text" class="form-control"  id="full_name" name="full_name" placeholder="Full Name" value="{{ $data['employee']['profile']->full_name }}">
                </div>
                <!-- end full name -->

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
      <input type="hidden" name="tab_category" value="personal">
      <a href="{{ route($hyperlink['page']['list']['home'],['organization_id'=>request()->organization_id]) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->


<script type="text/javascript">

/**************************************************************************************
  Document On Load
**************************************************************************************/
$(document).ready(function($){


});

</script>
