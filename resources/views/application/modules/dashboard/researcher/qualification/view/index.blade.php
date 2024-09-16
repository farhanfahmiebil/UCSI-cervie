@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">
  <!-- card body -->
  <div class="card-body">
      <!-- card title -->
      <h4 class="card-title">Edit Qualification</h4>
      <hr>

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

      <!-- form -->
      <form class="forms-sample" method="POST" action="{{route($hyperlink['page']['update'],['id' => $data['main']->academic_qualification_id, 'employee_id' => request()->route('employee_id')])}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <!-- row start -->
          <div class="row">
              <!-- col-md-6 start -->
              <div class="col-md-12">
                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="qualification_type">Qualification Type</label>
                      <select id="qualification_id" name="qualification_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                          <option value="">-Please Select Qualification Type-</option>
                          @if(count($data['general']['qualification']) >= 1)
                            @foreach($data['general']['qualification'] as $key=>$value)
                              <option value="{{$value->qualification_id}}" {{(($data['main']->qualification_id == $value->qualification_id)?'selected':'')}}>{{$value->qualification_name}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                  <!-- form-group end -->

              </div>
              <!-- col-md-6 end -->

              <!-- col-md-12 start -->
              <div class="col-md-12">

                <!-- form-group hide start -->
                <div class="form-group hide">
                    <label for="qualification_other">Other (Please Specify)</label>
                    <input type="text" class="form-control" value="{{$data['main']->qualification_other}}" name="qualification_other" id="qualification_other" placeholder="Master of Business Administration">
                </div>
                <!-- form-group hide end -->

              </div>
              <!-- col-md-12 end -->

              <!-- col-md-6 start -->
              <div class="col-md-6">

                <!-- form-group start -->
                <div class="form-group">
                    <label for="qualification_name">Qualification Name</label>
                    <input type="text" class="form-control" value="{{$data['main']->qualification_name}}" name="qualification_name" id="qualification_name" placeholder="Master of Business Administration" required>
                </div>
                <!-- form-group end -->

                <!-- form-group start -->
                <div class="form-group">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control" value="{{$data['main']->date_start}}" name="date_start" id="date_start" placeholder="DD/MM/YYYY" required>
                </div>
                <!-- form-group end -->

                <!-- form-group start -->
                <div class="form-group">
                    <label for="filename">View File</label>
                    <br>
                    <a class="btn btn-danger me-2" data-toggle="tooltip" data-placement="top" title="View File" href="{{route($hyperlink['page']['view_file'],['id' => $data['main']->academic_qualification_id, 'employee_id' => request()->route('employee_id')])}}"> <i class="mdi mdi-file"></i> </a>
                </div>
                <!-- form-group end -->

              </div>
              <!-- col-md-6 end -->

              <!-- col-md-12 start -->
              <div class="col-md-6">

                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="exampleInputPassword1">Institution Name</label>
                      <input type="text" class="form-control" value="{{$data['main']->institution_name}}" name="institution_name" id="institution_name" placeholder="University of Oxford" required>
                  </div>
                  <!-- form-group end -->

                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="date_end">Date End</label>
                      <input type="date" class="form-control" value="{{$data['main']->date_end}}" name="date_end" id="date_end" placeholder="DD/MM/YYYY" required>
                  </div>
                  <!-- form-group end -->

                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="filename">Upload New File <small class="text-danger">*This will replace the current file</small></label>
                      <input type="file" accept="application/pdf" name="filename" class="form-control" id="filename" placeholder="Bachelor.pdf">
                  </div>
                  <!-- form-group end -->

              </div>
              <!-- col-md-12 end -->
          </div>
          <!-- row end -->

          <!-- button group start -->
          <div class="text-center">
              <hr>
              <a href="{{route($hyperlink['page']['list'],['employee_id' => request()->route('employee_id')])}}" class="btn btn-light">Back</a>
              <button type="submit" class="btn btn-danger me-2">Update</button>
          </div>
          <!-- button group end -->
      </form>
      <!-- form end -->
  </div>
  <!-- card body end -->


</div>
<!-- end card -->

<script>
$(document).ready(function() {
    $(".hide").hide();

    /**************************************************************************************
      Session
    **************************************************************************************/
    @if(Session('message'))

    Swal.fire({
      title: "{{ ucwords(Session::get('alert_type')) }}",
      text: "{{ ucwords(Session::get('message')) }}",
      icon: "{{Session::get('alert_type')}}",
      confirmButtonColor: "#ee5b5b"

    });

    @endif


    if("{{$data['main']->qualification_id}}" == 'Q15'){
      $(".hide").show();
    }

    $('#qualification_id').change(function(){

      var value = $(this).find(":selected").val()

      if(value == 'Q15'){
        $(".hide").fadeIn();
      }else{
        $(".hide").fadeOut();
      }


    });


});
</script>

@endsection
