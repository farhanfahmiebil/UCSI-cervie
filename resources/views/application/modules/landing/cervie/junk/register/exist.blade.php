@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container">

  <!-- section customer information -->
  <section class="position-relative overflow-hidden bg-light pb-5 mb-5">

    <div class="container pt-8 pb-6 text-center position-relative">
     <div class="row pt-4 pt-lg-6 justify-content-center text-center">
       <div class="col-lg-8 col-md-10">
         <h1 class="display-3 mb-3 mx-auto">
           Is this Mobile Number Linked with Table {{ request()->table_no }}
         </h1>
       </div>
     </div>
    </div>

   </section>
  <!-- end section customer information -->

  <!-- table responsive -->
  <div class="table-responsive">

    <!-- table -->
    <table class="table table-bordered">

      <thead class="table-danger">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Table No</th>
          <th scope="col">Name</th>
          <th scope="col">Mobile Number</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody>

        <!-- end table responsive -->
        {{-- Check Data Customer Exist --}}
        @if(count($data['customer']) > 0)

          {{-- Get Data Customer Exist --}}
          @foreach($data['customer'] as $key=>$value)

            <tr>
              <th scope="row">{{ ($key+1) }}</th>
              <td>{{ $value->table_no }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->mobile_number }}</td>
              <td>
                <a href="{{ route($hyperlink['page']['menu'],['outlet_id'=>$value->outlet_id,'table_no'=>$value->table_no,'order_id'=>$value->order_id]) }}" class="btn btn-danger">Continue</a>
              </td>
            </tr>

          @endforeach
          {{-- End Get Data Customer Exist --}}

        @endif
        {{-- End Check Data Customer Exist --}}

      </tbody>

    </table>
    <!-- end table -->

  </div>

  <div class="row pb-5 mb-5">

    <div class="col-12 text-center">

      <div class="form-group">
        <button type="button" class="btn btn-danger" name="button">No, This Data Not Linked As My Mobile Number</button>
      </div>

    </div>

  </div>

</div>
<!-- end container -->

@endsection
