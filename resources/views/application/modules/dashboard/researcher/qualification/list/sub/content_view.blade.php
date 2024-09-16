<!-- row -->
<div class="row row_details">

  <!-- col -->
  <div class="col-lg-12 grid-margin stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Qualification Details</h4>
          <div class="dropdown">
            <button class="close btn btn-danger">x</button>
          </div>
        </div>

        <!-- row start -->
        <div class="row">
            <!-- col-md-6 start -->
            <div class="col-md-12">
                <!-- form-group start -->
                <div class="form-group">
                    <label for="qualification_type">Qualification Type</label>
                    <input type="text" class="form-control" name="qualification_id" id="qualification_id" placeholder="Master" readonly>
                </div>
                <!-- form-group end -->

            </div>
            <!-- col-md-6 end -->

            <!-- col-md-12 start -->
            <div class="col-md-12">

              <!-- form-group hide start -->
              <div class="form-group hide">
                  <label for="qualification_other">Other</label>
                  <input type="text" class="form-control" name="qualification_other" id="qualification_other" placeholder="Master of Business Administration" readonly>
              </div>
              <!-- form-group hide end -->

            </div>
            <!-- col-md-12 end -->

            <!-- col-md-6 start -->
            <div class="col-md-6">

              <!-- form-group start -->
              <div class="form-group">
                  <label for="qualification_name">Qualification Name</label>
                  <input type="text" class="form-control" name="qualification_name" id="qualification_name" placeholder="Master of Business Administration" readonly>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="date_start">Date Start</label>
                  <input type="text" class="form-control" name="date_start" id="date_start" placeholder="DD/MM/YYYY" readonly>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="filename">View Certificate</label>
                  <br>
                  <a target="_blank" id="view_file" class="btn btn-danger me-2" data-toggle="tooltip" data-placement="top" title="View File"> <i class="mdi mdi-file"></i> </a>
              </div>
              <!-- form-group end -->

            </div>
            <!-- col-md-6 end -->

            <!-- col-md-12 start -->
            <div class="col-md-6">

                <!-- form-group start -->
                <div class="form-group">
                    <label for="exampleInputPassword1">Institution Name</label>
                    <input type="text" class="form-control" name="institution_name" id="institution_name" placeholder="University of Oxford" readonly>
                </div>
                <!-- form-group end -->

                <!-- form-group start -->
                <div class="form-group">
                    <label for="date_end">Date End</label>
                    <input type="text" class="form-control" name="date_end" id="date_end" placeholder="DD/MM/YYYY" readonly>
                </div>
                <!-- form-group end -->

            </div>
            <!-- col-md-12 end -->
        </div>
        <!-- row end -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end col -->

</div>
<!-- end row -->

<script type="text/javascript">

  $(document).ready(function(){

    /**************************************************************************************
      Get Qualification
    **************************************************************************************/
    $('.close').click(function(){
      $(".row_details").fadeOut();

    });


  });

</script>
