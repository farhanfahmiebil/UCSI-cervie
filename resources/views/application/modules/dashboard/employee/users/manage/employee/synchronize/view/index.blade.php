@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<form action="{{route($hyperlink['page']['synchronize']['search'])}}" method="POST">
{{csrf_field()}}

  <!-- card -->
  <div class="card">

  <!-- card header -->
  <div class="card-header">
    <h3>Synchronize Employee</h3>
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
      <div class="row">

        <!-- col -->
        <div class="col-12">

          <!-- synchronize type -->
          <div class="mb-3">
            <label for="synchronize_type" class="form-label">Synchronize Type</label>
            <select class="form-control select2" id="synchronize_category" name="synchronize_category">
              <option value="">--Please Select--</option>
              <option value="employee_id">By Employee ID</option>
              <option value="employee_name">By Employee Name</option>
              <!-- <option value="name">All</option> -->
            </select>
          </div>
          <!-- end synchronize type -->

        </div>
        <!-- end col -->

        <!-- col -->
        <div id="category_single" class="col-12 d-none">

          <!-- name -->
          <div class="mb-3">
            <label for="name" id="label_name" class="form-label">Category</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="">
          </div>
          <!-- end name -->

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
    <input type="hidden" name="form_token" value="{{ $form_token['search'] }}">
    <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-dark">Back to List</a>
    <button type="submit" class="btn btn-primary">Search</button>
  </div>
  <!-- end control -->

</form>

<script type="text/javascript">

  $(document).ready(function(){

    //Slide Up Category Single Up
    $('#category_single').addClass('d-none').slideUp();

    $('#synchronize_category').on('change',function(){

      var category = $(this).val();

      //Get Category
      switch(category){

        //Employee ID
        case 'employee_id':

          //Set Label Name
          $('#label_name').text('Employee ID');
          $('#name').attr('placeholder','Employee ID');

          //Slide Down Category Single
          $('#category_single').hide().removeClass('d-none').slideDown();

        break;

        //Employee Name
        case 'employee_name':

          //Set Label Name
          $('#label_name').text('Employee Name');
          $('#name').attr('placeholder','Employee Name');

          //Slide Down Category Single Up
          $('#category_single').hide().removeClass('d-none').slideDown();

        break;

        //Set Default
        default:
        console.log(32);
          //Slide Up Category Single Up
          $('#category_single').slideUp(function() {
            $(this).addClass('d-none');
          });

        break;

      }
      console.log(category);

      $(this).toggleClass('col-lg-12');

       // Toggle d-none class on other elements
       $('.company').not(this).toggleClass('d-none');

       $('#user_access').toggleClass('d-none');

    });

  });

</script>


@endsection
