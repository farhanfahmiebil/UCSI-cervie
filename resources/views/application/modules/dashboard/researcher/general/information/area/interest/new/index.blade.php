@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- content -->
  <div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-12 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card body -->
          <div class="card-body">

            <!-- card title -->
            <h4 class="card-title">Add New Area Interest</h4>
            <!-- end card title -->

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
            <form action="{{ route($hyperlink['page']['create']) }}" method="POST">
              @csrf

              <!-- row 1 -->
              <div class="row">

                <!-- position -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Area Interest Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name">
                  </div>
                </div>
                <!-- end position -->

              </div>
              <!-- end row 1 -->

              <!-- row 4 -->
              <div class="row text-end">

                <div class="col-md-12">
                  <a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-light">Back</a>
                  <input type="hidden" name="form_token" value="{{ $form_token['create'] }}">
                  <button type="submit" class="btn btn-danger text-white me-2">Create</button>
                </div>

              </div>
              <!-- end row 4 -->

            </form>
            <!-- end form -->

          </div>
          <!-- card body -->

        </div>
        <!-- end card -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end content -->

@endsection
