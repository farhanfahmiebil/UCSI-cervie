<!-- row -->
<div class="row">

  <!-- col -->
  <div class="col-lg-12 grid-margin stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Qualification</h4>
          <div class="dropdown">
            <a href="{{route($hyperlink['page']['new'],['employee_id' => request()->route('employee_id')])}}" class="text-success btn btn-danger text-white">New Qualification</a>
          </div>
        </div>

        <!-- table responsive -->
        <div class="table-responsive">

          <!-- table -->
          <table class="table table-hover">

            <!-- thead -->
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Name</th>
                <th>Institution</th>
                <th>Date Start</th>
                <th>Date End</th>
                <th>Action</th>
              </tr>
            </thead>
            <!-- end thead -->

            <!-- tbody -->
            <tbody>
              @if(count($data['main']) >= 1)
                @foreach($data['main'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->qualification_type_name}}</td>
                    <td>{{$value->qualification_name}}</td>
                    <td>{{$value->institution_name}}</td>
                    <td>{{$value->date_start}}</td>
                    <td>{{$value->date_end}}</td>
                    <td>
                      <i class="mdi mdi-pencil"></i>
                      <i class="mdi mdi-magnify"></i>
                      <i data-id="{{$value->academic_qualification_id}}" class="delete mdi mdi-trash-can"></i>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
            <!-- end tbody -->

          </table>
          <!-- end table -->

        </div>
        <!-- end table responsive -->

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

    $('.delete').click(function(){

      var baseUrl = "{{ route($hyperlink['page']['delete'], ['employee_id' => request()->route('employee_id'), 'id' => '__ID__']) }}";
      var id = $(this).data('id');
       // Replace the placeholder '__ID__' with the actual ID
       var url = baseUrl.replace('__ID__', id);// Replace placeholder with actual ID

      Swal.fire({
        title: "Are you sure?",
        text: "Any action cannot be undone",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ee5b5b",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url; // Redirect to the URL
        }
      });

    });

  });

</script>
