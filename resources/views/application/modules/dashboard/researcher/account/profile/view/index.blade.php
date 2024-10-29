@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

  <!-- subscriber body -->
  <div class="subscriber-body">

    <!-- row start -->
    <div class="row justify-content-center mt-4">
      <div class="col-lg-12">
        <div class="card light">
          <div class="card-body">
            <div class="custom-tabs-container">
              <ul class="nav nav-tabs" id="customTab2" role="tablist">

                <!-- avatar -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'avatar')?'active':'') }}" id="tab-avatar" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'avatar']) }}" role="tab"
                    aria-controls="avatar" aria-selected="false">
                    Avatar
                  </a>
                </li>
                <!-- end avatar -->

                <!-- my qr -->
                <!-- <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'work')?'active':'') }}" id="tab-work" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'work']) }}" role="tab"
                    aria-controls="work" aria-selected="false">
                    Work
                  </a>
                </li> -->
                <!-- end my qr -->

                <!-- personal -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'personal')?'active':'') }}" id="tab-personal" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'personal']) }}" role="tab"
                    aria-controls="personal" aria-selected="true">
                    Personal
                  </a>
                </li>
                <!-- end personal -->

                <!-- profile -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'profile')?'active':'') }}" id="tab-profile" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'profile']) }}" role="tab"
                    aria-controls="personal" aria-selected="true">
                    Profile
                  </a>
                </li>
                <!-- end profile -->

                <!-- contact -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'contact')?'active':'') }}" id="tab-qr" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'contact']) }}" role="tab"
                    aria-controls="contact" aria-selected="false">
                    Contact
                  </a>
                </li>
                <!-- end contact -->

                <!-- setting -->
                <!-- <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'setting')?'active':'') }}" id="tab-setting" href="{{ route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'setting']) }}" role="tab"
                    aria-controls="contact" aria-selected="false">
                    Setting
                  </a>
                </li> -->
                <!-- end setting -->

                <!-- <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                    aria-controls="twoA" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                    aria-controls="threeA" aria-selected="false">Credit Cards</a>
                </li> -->
              </ul>

              <!-- tab content -->
              <div class="tab-content h-350">

                {{-- Check Authorization User Status Stop Submit --}}
                @if(in_array(Auth::user()->employee->status->name,array('pending')))
                  <div class="alert alert-secondary text-dark" role="alert">
                    Updating Information is Currently Disabled. Your Status is <strong><u>{{ strtoupper(Auth::user()->employee->status->name) }}</u></strong> Please Wait for System to Approved.
                  </div>
                @endif
                {{-- End Check Authorization User Status Stop Submit --}}

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

                {{-- Sub Navigation Main --}}
                @include($hyperlink['page']['navigation']['main'].'.'.request()->tab_category)

              </div>
              <!-- end tab content -->

            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- end row -->

  </div>
  <!-- end subscriber body -->

  <script type="text/javascript">

    /**************************************************************************************
      Document On Load
    **************************************************************************************/
    $(document).ready(function($){

      /**************************************************************************************
        Session
      **************************************************************************************/
      @if(Session('message'))
        Swal.fire({
          title: '{{ ucwords(Session::get('alert_type')) }}',
          text: '{{ ucwords(Session::get('message')) }}',
          icon: '{{ strtolower(Session::get('alert_type')) }}'
        });
      @endif

    });

  </script>

@endsection
