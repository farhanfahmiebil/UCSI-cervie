<!-- row -->
<div class="row row_details">

  <!-- col -->
  <div class="col-lg-12 grid-margin stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Linkage Details</h4>
          <div class="dropdown">
            <button class="close btn btn-danger">x</button>
          </div>
        </div>

        <!-- row start -->
        <div class="row">

          <!-- col-md-12 start -->
          <div class="col-md-12">

            <!-- form-group hide start -->
            <div class="form-group hide">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Synergy in Action: The Apple and IBM Collaboration" readonly>
            </div>
            <!-- form-group hide end -->

          </div>
          <!-- col-md-12 end -->

          <!-- col-md-6 start -->
          <div class="col-md-6">

            <!-- form-group hide start -->
            <div class="form-group hide">
                <label for="organization">Organization</label>
                <input type="text" class="form-control" name="organization" id="organization" placeholder="Apple Inc. and IBM" readonly>
            </div>
            <!-- form-group hide end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="agreement_level_id">Agreement Level</label>
                <input type="text" class="form-control" name="agreement_level_id" id="agreement_level_id" placeholder="Agreement Level" readonly>

            </div>
            <!-- form-group end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="qualification_name">Amount</label>
                <input type="number" class="form-control" name="amount" id="amount" placeholder="" readonly>
            </div>
            <!-- form-group end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="date_start">Date Start</label>
                <input type="text" class="form-control" name="date_start" id="date_start" placeholder="DD/MM/YYYY" readonly>
            </div>
            <!-- form-group end -->

          </div>
          <!-- col-md-6 end -->

          <!-- col-md-6 start -->
          <div class="col-md-6">

            <!-- form-group start -->
            <div class="form-group">
                <label for="linkage_category_id">Category</label>
                <input type="text" class="form-control" name="linkage_category_id" id="linkage_category_id" placeholder="Category" readonly>

            </div>
            <!-- form-group end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="agreement_type_id">Agreement Type</label>
                <input type="text" class="form-control" name="agreement_type_id" id="agreement_type_id" placeholder="Agreement Type" readonly>

            </div>
            <!-- form-group end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="country_id">Country</label>
                <input type="text" class="form-control" name="country_id" id="country_id" placeholder="Country" readonly>

            </div>
            <!-- form-group end -->

            <!-- form-group start -->
            <div class="form-group">
                <label for="date_end">Date End</label>
                <input type="text" class="form-control" name="date_end" id="date_end" placeholder="DD/MM/YYYY" readonly>
            </div>
            <!-- form-group end -->

          </div>
          <!-- col-md-6 end -->

          <!-- Linkage Table -->
          <h4 class="card-title">Linkage Evidence</h4>
          <hr>
          <table class="table table-bordered table-danger" id="linkageTable">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Description</th>
                      <th>File</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="row-number">1</td>
                      <td class="col-md-11"><input type="text" class="form-control" placeholder="Enter Description" required></td>
                      <td class="col-md-1">
                        <a class="btn btn-danger">
                          <i class="mdi mdi-file"></i>
                        </a>
                      </td>
                  </tr>
              </tbody>
          </table>


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
