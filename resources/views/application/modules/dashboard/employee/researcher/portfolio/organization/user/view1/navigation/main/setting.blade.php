<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'setting')?'show active':'') }}" id="setting" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['id'=>request()->id,'tab'=>'tab','tab_category'=>'setting']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Setting</h3>
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

              <!-- tab -->
              <div class="d-flex align-items-start">

                <!-- navigation -->
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-virtual_card-tab" data-bs-toggle="pill" data-bs-target="#v-pills-virtual_card" type="button" role="tab" aria-controls="v-pills-virtual_card" aria-selected="true">Virtual Card</button>
                </div>
                <!-- end navigation -->

                <!-- content -->
                <div class="tab-content full-width pt-0" id="v-pills-tabContent">
                  {{-- Sub Navigation Main --}}
                  @include($hyperlink['page']['navigation']['setting'].'.'.request()->tab_sub_category)
                </div>
                <!--  end content -->


              </div>
              <!-- end tab -->


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

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->
