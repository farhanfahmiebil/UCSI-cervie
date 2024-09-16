@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">

  <!-- card body -->
  <div class="card-body">
    <h4 class="card-title">Default form</h4>
    <p class="card-description">
      Basic form layout
    </p>
    <form class="forms-sample">
      <div class="form-group">
        <label for="exampleInputUsername1">Username</label>
        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
      </div>
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
  </div>
  <!-- end card body -->

</div>
<!-- end card -->


@endsection
