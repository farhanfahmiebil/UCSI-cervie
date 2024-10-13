<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'work')?'show active':'') }}" id="work" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['tab'=>'tab','tab_category'=>'work']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Work Position</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-12 col-12">

            {{-- End Check Count Employee Position Exist --}}
            @if(count($data['employee']['position'])>1)

              {{-- Get Count Employee Position --}}
              @foreach($data['employee']['position'] as $key=>$value)

                <!-- row -->
                <div class="row gx-3">

                  <!-- col -->
                  <div class="col-6">

                    <!-- positiom -->
                    <div class="mb-3">
                      <label for="position" class="form-label">Position</label>
                      <input type="text" class="form-control" id="position" placeholder="Employee Position" value="{{ $value->position }}">
                    </div>
                    <!-- end positiom -->

                  </div>
                  <!-- end col -->

                  <!-- col -->
                  <div class="col-6">

                    <!-- department -->
                    <div class="mb-3">
                      <label for="position" class="form-label">Department</label>
                      <input type="text" class="form-control" id="department" placeholder="Employee Department" value="{{ $value->department }}">
                    </div>
                    <!-- end department -->

                  </div>
                  <!-- end col -->

                </div>
                <!-- end row -->

              @endforeach
              {{-- End Get Count Employee Position --}}

            @endif
            {{-- End Check Count Employee Position Exist --}}

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
      <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->
