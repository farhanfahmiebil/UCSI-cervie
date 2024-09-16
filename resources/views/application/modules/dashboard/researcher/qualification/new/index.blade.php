@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">
  <!-- card body -->
  <div class="card-body">
      <!-- card title -->
      <h4 class="card-title">New Qualification</h4>
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
      <form class="forms-sample" method="POST" action="{{route($hyperlink['page']['create'],['employee_id' => request()->route('employee_id')])}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <!-- row start -->
          <div class="row">
              <!-- col-md-6 start -->
              <div class="col-md-12">
                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="qualification_type">Qualification Type</label>
                      <select name="qualification_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                          <option value="">-Please Select Qualification Type-</option>
                          @if(count($data['general']['qualification']) >= 1)
                            @foreach($data['general']['qualification'] as $key=>$value)
                              <option value="{{$value->qualification_id}}">{{$value->qualification_name}}</option>
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
                    <input type="text" class="form-control" name="qualification_other" id="qualification_other" placeholder="Master of Business Administration">
                </div>
                <!-- form-group hide end -->

              </div>
              <!-- col-md-12 end -->

              <!-- col-md-6 start -->
              <div class="col-md-6">

                <!-- form-group start -->
                <div class="form-group">
                    <label for="qualification_name">Qualification Name</label>
                    <input type="text" class="form-control" name="qualification_name" id="qualification_name" placeholder="Master of Business Administration" required>
                </div>
                <!-- form-group end -->

                <!-- form-group start -->
                <div class="form-group">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control" name="date_start" id="date_start" placeholder="DD/MM/YYYY" required>
                </div>
                <!-- form-group end -->

                <!-- form-group start -->
                <div class="form-group">
                    <label for="filename">Upload File</label>
                    <input type="file" name="filename" class="form-control" id="filename" placeholder="Bachelor.pdf" required>
                </div>
                <!-- form-group end -->

              </div>
              <!-- col-md-6 end -->

              <!-- col-md-12 start -->
              <div class="col-md-6">

                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="exampleInputPassword1">Institution Name</label>
                      <input type="text" class="form-control" name="institution_name" id="institution_name" placeholder="University of Oxford" required>
                  </div>
                  <!-- form-group end -->

                  <!-- form-group start -->
                  <div class="form-group">
                      <label for="date_end">Date End</label>
                      <input type="date" class="form-control" name="date_end" id="date_end" placeholder="DD/MM/YYYY" required>
                  </div>
                  <!-- form-group end -->

              </div>
              <!-- col-md-12 end -->
          </div>
          <!-- row end -->

          <!-- button group start -->
          <div class="text-center">
              <hr>
              <a href="{{route($hyperlink['page']['list'])}}" class="btn btn-light">Back</a>
              <button type="submit" class="btn btn-danger me-2">Submit</button>
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

});
</script>

@endsection
