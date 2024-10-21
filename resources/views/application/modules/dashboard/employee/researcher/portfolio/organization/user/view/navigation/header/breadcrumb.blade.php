<!-- header banner -->
<div class="subscribe-header">
  <img src="{{ asset('images/background/red_stripe.svg') }}" class="img-fluid w-100" alt="Header" />
</div>
<!-- end header banner -->

<!-- account profile image and name -->
<div class="row justify-content-center mt-4">

  <!-- col -->
  <div class="col-lg-12">

    <!-- row -->
    <div class="row align-items-end">

      <!-- avatar -->
      <div class="col-auto">
        <img src="{{-- $avatar --}}" class="img-7xx rounded-circle border border-secondary border-3" />
      </div>
      <!-- end avatar -->

      <!-- account profile name -->
      <div class="col mt-4">
        <h6>{{-- $data['employee']['position']->position --}}</h6>
        <h4 class="m-0">{{ $data['main']['data']->full_name }}</h4>
      </div>
      <!-- end account profile name -->

      <!-- profile percentage completed -->
      <!-- <div class="col-12 col-md-auto">
        <span class="badge shade-red">79% Completed</span>
      </div> -->
      <!-- end profile percentage completed -->

    </div>
    <!-- end row -->

  </div>
  <!-- end col -->

</div>
<!-- end account profile image and name -->
