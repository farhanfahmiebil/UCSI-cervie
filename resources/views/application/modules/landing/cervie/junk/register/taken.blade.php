@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container py-5">

  <!-- section customer information -->
  <section class="position-relative overflow-hidden bg-light pb-5 mb-5">

    <div class="container py-5 pb-6 text-center position-relative">
     <div class="row  pt-lg-6 justify-content-center text-center">
       <div class="col-lg-8 col-md-10">
         <h1 class="display-3 mb-3 mx-auto">
           Sorry This Table {{ request()->table_no }} is Already Taken.
           <br><br>
           Please Find Another Table
         </h1>
       </div>
     </div>
    </div>

   </section>
  <!-- end section customer information -->

</div>
<!-- end container -->

@endsection
