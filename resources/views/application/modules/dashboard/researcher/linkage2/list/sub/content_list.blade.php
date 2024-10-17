<!-- row -->
<div class="row">

  <!-- col -->
  <div class="col-lg-12 grid-margin stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <div class="alert alert-info" role="alert">
          Click on the table row to view more details
        </div>

        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Linkage</h4>
          @if($access['editable'])
          <div class="dropdown">
            <a href="{{route($hyperlink['page']['new'],['employee_id' => request()->route('employee_id')])}}" class="text-success btn btn-danger text-white">New Linkage</a>
          </div>
          @endif
        </div>

        <!-- table responsive -->
        <div class="table-responsive">

          <!-- table -->
          <table class="table table-hover">

            <!-- thead -->
            <thead>
              <tr>
                <th>#</th>
                <th>Organization</th>
                <th>Project Title</th>
                <th>Duration (Month (s))</th>
              </tr>
            </thead>
            <!-- end thead -->

            <!-- tbody -->
            <tbody>
              @if(count($data['main']) >= 1)
                @foreach($data['main'] as $key=>$value)
                  <tr class="table_row_data" data-id="{{$value->linkage_id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$value->organization}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{\Carbon\Carbon::parse($value->date_start)->diffInMonths(\Carbon\Carbon::parse($value->date_end))}}</td>
                    <td>
                      @if($access['editable'] && Auth::user())
                        <a href="{{route($hyperlink['page']['view'],['id' => $value->linkage_id, 'employee_id' => request()->route('employee_id')])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil"></i></a>
                        <i data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$value->linkage_id}}" class="delete mdi mdi-trash-can"></i>
                      @endif
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

       getLinkage(
         {
           'id':id
         }
       );

       getLinkageEvidence(
         {
           'id':id,
           'category' : 'cervie_researcher_linkage'
         }
       );

    });

    /**************************************************************************************
      Get Linkage
    **************************************************************************************/
    function getLinkage(data){

      //Set Header
      $.ajaxSetup({
        'headers':{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['page']['ajax']['linkage']) }}',
        'data':{
          'id':data.id
        },
        beforeSend:function(){

          $('#title').val("--Loading--")
          $('#organization').val("--Loading--")
          $('#linkage_category_id').val("--Loading--")
          $('#agreement_type_id').val("--Loading--")
          $('#agreement_level_id').val("--Loading--")
          $('#amount').val("--Loading--")
          $('#date_start').val("--Loading--")
          $('#date_end').val("--Loading--")
          $('#linkage_category_id').val("--Loading--")
          $('#country_id').val("--Loading--")

        },
        success:function(item){


          if(item.result !== null){

            $('#title').val(item.result.title)
            $('#organization').val(item.result.organization)
            $('#linkage_category_id').val(item.result.linkage_category_name)
            $('#date_start').val(item.result.date_start)
            $('#date_end').val(item.result.date_end)
            $('#amount').val(item.result.amount)
            $('#country_id').val(item.result.country_name)
            $('#agreement_type_id').val(item.result.agreement_type_name)
            $('#agreement_level_id').val(item.result.agreement_level_name)

          }
        }

      });

    }

    /**************************************************************************************
      Get Linkage Evidence
    **************************************************************************************/
    function getLinkageEvidence(data) {
    // Set Header
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Set Request
    $.ajax({
        type: 'GET',
        url: '{{ route($hyperlink['page']['ajax']['evidence']) }}',
        data: {
            id: data.id,
            category: data.category,
        },
        beforeSend: function() {
            // Clear table while loading
            $('#linkageTable tbody').empty().append(`
                <tr>
                    <td colspan="3" class="text-center">--Loading--</td>
                </tr>
            `);
        },
        success: function(item) {

          console.log(item.result);

            const tableBody = $('#linkageTable tbody');
            tableBody.empty(); // Clear existing rows

            if (item.result) {
                // Assuming item.result is an array of evidence data
                $.each(item.result, function(index, value) {

                  // Generate the file URL using Laravel route
                  const fileUrl = "{{ route($hyperlink['page']['view_file'], ['id' => '__ID__', 'employee_id' => request()->route('employee_id')]) }}".replace('__ID__', value.evidence_id);

                    const newRow = `
                        <tr>
                            <td class="row-number">${index + 1}</td>
                            <td class="col-md-11">
                                <input type="text" class="form-control" value="${value.description}" required>
                            </td>
                            <td class="col-md-1">
                            <a class="btn btn-danger" href="${fileUrl}">
                                    <i class="mdi mdi-file"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    tableBody.append(newRow); // Append new row to the table body
                });
            } else {
                // Handle case where result is null or not found
                tableBody.append(`
                    <tr>
                        <td colspan="3" class="text-center">No data found for the selected ID.</td>
                    </tr>
                `);
            }
        },
        error: function(xhr, status, error) {

            $('#linkageTable tbody').empty().append(`
                <tr>
                    <td colspan="3" class="text-center">An error occurred. Please try again.</td>
                </tr>
            `);
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
