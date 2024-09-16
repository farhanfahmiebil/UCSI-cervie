@extends(Config::get('routing.application.modules.error.layout').'.structure.error')

@section('page-title')
 Error
@endsection

@section('main-content')

  <!-- message -->
  <div class="message">

   <!-- title -->
   <h1>Error <span class="errorcode">555</span></h1>
   <!-- end title -->

   <!-- description -->
   <p class="output">
     System Error
     {{--  @inject('data','App\Http\Models\General\MYSQL\Table\Error') --}}
     {{-- $data->errorName($exception->getMessage())->error_id --}}
    <br>
    {{-- $data->errorName($exception->getMessage())->name --}}


    <h2>{{ $exception->getMessage() }}</h2>
    <br>
    <br>

    Please Email csd@ucsigroup.com.my to investigate your issue. Thank you.
   </p>
   <!-- end description -->

   <!-- redirect -->
   <p class="output">Click <a href="#">Here</a> to go back to Dashboard</p>
   <!-- end redirect -->

  </div>
  <!-- end message -->

@endsection
