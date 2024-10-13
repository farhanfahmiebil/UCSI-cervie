@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<style media="screen">
#myCol {
  transition: width 0.5s ease;
}

.expanded {
  width: 100%;
}
</style>

<form action="{{route($hyperlink['page']['create'])}}" method="POST">

  {{csrf_field()}}
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

  <!-- card -->
  <div class="card">

    <!-- card header -->
    <div class="card-header">
      <h3>General Information</h3>
    </div>
    <!-- end card header -->

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

              <!-- salutation -->
              <div class="mb-3">
                <label for="salutation" class="form-label">Salutation</label>
                <input type="text" class="form-control" name="salutation" id="salutation" placeholder="" value="">
              </div>
              <!-- end salutation -->

              <!-- first name -->
              <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control"  name="first_name" id="first_name" placeholder="fIRST Name" value="">
              </div>
              <!-- end first name -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-6">

              <!-- fullname -->
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control"  name="fullName" id="fullName" placeholder="Full Name" value="">
              </div>
              <!-- end fullname -->

              <!-- middle name -->
              <div class="mb-3">
                <label for="middle_name" class="form-label">Middle Name<small><i> (optional)</i></small></label>
                <input type="text" class="form-control"  name="middle_name" id="middle_name" placeholder="Middle Name" value="">
              </div>
              <!-- end middle name -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-6">

              <!-- last name -->
              <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control"  name="last_name" id="last_name" placeholder="Last Name" value="">
              </div>
              <!-- end last name -->

              <!-- birthday -->
              <div class="mb-3">
                <label for="birthDay" class="form-label">Birthday</label>
                <div class="input-group">
                  <input type="date" class="form-control datepicker-opens-left" id="dob"  name="dob" placeholder="DD/MM/YYYY" value=""/>
                  <span class="input-group-text">
                    <i class="bi bi-calendar4"></i>
                  </span>
                </div>
              </div>
              <!-- end birthday -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-6">

              <!-- nickname -->
              <div class="mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" class="form-control" id="nickname" placeholder="Nickname"  name="nickname" value="">
              </div>
              <!-- end nickname -->

              <!-- age -->
              <div class="mb-3">
                <label for="nickname" class="form-label">Employee ID</label>
                <input type="text" class="form-control" id="employee_id" placeholder="Employee ID" name="employee_id"  value="">
              </div>
              <!-- end age -->

            </div>
            <!-- end col -->

          </div>
          <!-- end row -->

        </div>
        <!-- end col -->

      </div>
      <!-- end row -->

      <!-- card -->
      <div>

    </div>
    <!-- end card body -->



  </div>


</div>
<!-- Content wrapper scroll end -->

<div class="card">

  <!-- card header -->
  <div class="card-header">
    <h3>Contact</h3>
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

        <!-- office number -->
        <div class="mb-3">
          <label for="office_no" class="form-label">Office Telephone Number</label>
          <input type="hidden" name="contact_category_id[]" value="">
          <input type="text" class="form-control" name="name[office_no]" id="office_no" placeholder="038754542" value="">
        </div>
        <!-- end office number -->

        <!-- office number extension -->
        <div class="mb-3">
          <label for="office_no_extension" class="form-label">Office Telephone Extension</label>
          <input type="hidden" name="contact_category_id[]" value="">
          <input type="text" class="form-control" name="name[office_no_extension]" id="office_no_extension" placeholder="123" value="">
        </div>
        <!-- end office number extension -->

      </div>
      <!-- end col -->

      <!-- col -->
      <div class="col-6">

        <!-- mobile number -->
        <div class="mb-3">
          <label for="mobile_no" class="form-label">Mobile Number</label>
          <input type="hidden" name="contact_category_id[]" value="">
          <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="010-XXXXXXX" value="">
        </div>
        <!-- end mobile number -->

      </div>
      <!-- end col -->

      <!-- col -->
      <div class="col-12 text-center">

        <button type="submit" class="btn btn-danger">
        																<i class="bi bi-upload"></i> Create User
        															</button>

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

</div>
<!-- end row -->

</form>

<script type="text/javascript">

  $(document).ready(function(){

    $('.company').on('click',function(){

      var id = $(this).data('id');
      console.log(id);

      $(this).toggleClass('col-lg-12');

       // Toggle d-none class on other elements
       $('.company').not(this).toggleClass('d-none');

       $('#user_access').toggleClass('d-none');

    });

  });

</script>


@endsection
