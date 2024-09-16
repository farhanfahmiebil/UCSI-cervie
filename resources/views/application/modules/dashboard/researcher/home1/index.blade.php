@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">

  <!-- card body -->
  <div class="card-body">

    <!-- card title -->
    <h4 class="card-title">New Publication</h4>
    <!-- end card title -->

    <!-- form -->
    <form method="POST">

      <!-- row -->
      <div class="row">

        <!-- publication type -->
        <div class="col-md-6">

          <div class="form-group">
            <label for="publication_type_id">Publication Type</label>
            <input type="text" class="form-control" id="publication_type_id" placeholder="Username">
          </div>

        </div>
        <!-- end publication type -->

        <!-- year -->
        <div class="col-md-6">

          <div class="form-group">
            <label for="year">Year</label>
            <input type="email" class="form-control" id="year" value="{{ old('year') }}" placeholder="2024">
          </div>

        </div>
        <!-- end year -->

      </div>
      <!-- end row -->

      <!-- row -->
      <div class="row">

        <!-- title -->
        <div class="col-md-12">

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title">
          </div>

        </div>
        <!-- end title -->

      </div>
      <!-- end row -->

      <!-- row -->
      <div class="row">

        <!-- author -->
        <div class="col-md-6">

          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="year" value="{{ old('author') }}" placeholder="Author">
          </div>

        </div>
        <!-- end author -->

      </div>
      <!-- end row -->

      <!-- row -->
      <div class="row">

        <!-- journal name -->
        <div class="col-md-6">

          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="year" value="{{ old('author') }}" placeholder="Author">
          </div>

        </div>
        <!-- end author -->

      </div>
      <!-- end row -->


      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputConfirmPassword1">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
      </div>
      <div class="form-check form-check-flat form-check-primary">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input">
          Remember me
        <i class="input-helper"></i></label>
      </div>
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <button class="btn btn-light">Cancel</button>
    </form>
    <!-- end form -->

  </div>
  <!-- end card body -->

</div>
<!-- end card -->


@endsection
