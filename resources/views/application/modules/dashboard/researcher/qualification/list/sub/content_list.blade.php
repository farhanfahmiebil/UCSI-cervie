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
                  <tr class="table_row_data" data-id="{{$value->academic_qualification_id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$value->qualification_type_name}}</td>
                    <td>{{$value->qualification_name}}</td>
                    <td>{{$value->institution_name}}</td>
                    <td>{{$value->date_start}}</td>
                    <td>{{$value->date_end}}</td>
                    <td>
                      @if($access['editable'])
                        <a href="{{route($hyperlink['page']['view'],['id' => $value->academic_qualification_id, 'employee_id' => request()->route('employee_id')])}}" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="mdi mdi-pencil"></i> </a>
                        <i data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$value->academic_qualification_id}}" class="delete mdi mdi-trash-can"></i>
                      @endif
                        <a data-toggle="tooltip" data-placement="top" title="View File" href="{{route($hyperlink['page']['view_file'],['id' => $value->academic_qualification_id, 'employee_id' => request()->route('employee_id')])}}"> <i class="mdi mdi-file"></i> </a>
                    </td>
                  </tr>
                @endforeach
              @else
                <td class="text-center" colspan="7">No Data</td>
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

    /**************************************************************************************
      Get Qualification
    **************************************************************************************/
    $('.table_row_data').click(function(){
       var id = $(this).data("id");

       $(".row_details").fadeIn();

       getQualification(
         {
           'id':id
         }
       );

    });

    /**************************************************************************************
      Get Qualification
    **************************************************************************************/
    function getQualification(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['academic']['qualification']) }}',
        'data':{
          'id':data.id,
        },
        beforeSend:function(){

          $('#qualification_id').val("--Loading--")
          $('#qualification_other').val("--Loading--")
          $('#qualification_name').val("--Loading--")
          $('#date_start').val("--Loading--")
          $('#date_end').val("--Loading--")
          $('#institution_name').val("--Loading--")

        },
        success:function(item){



          console.log(item.result);

          if(item.result !== null){

            var baseUrl = "{{ route($hyperlink['page']['view_file'], ['employee_id' => request()->route('employee_id'), 'id' => '__ID__']) }}";
             // Replace the placeholder '__ID__' with the actual ID
            var url = baseUrl.replace('__ID__', item.result.academic_qualification_id);// Replace placeholder with actual ID

            $('#qualification_id').val(item.result.qualification_type_name)
            $('#qualification_other').val((item.result.qualification_other != null)?item.result.qualification_other:'-')
            $('#qualification_name').val(item.result.qualification_name)
            $('#date_start').val(item.result.date_start)
            $('#date_end').val(item.result.date_end)
            $('#institution_name').val(item.result.institution_name)
            $('#view_file').attr("href", url)

          }
        }

      });

    }


    /**************************************************************************************
      Delete Qualification
    **************************************************************************************/

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
