@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

  <!-- header banner -->
  <div class="subscribe-header">
    <img src="{{ asset('images/background/red_stripe.svg') }}" class="img-fluid w-100" alt="Header" />
  </div>
  <!-- end header banner -->

  <!-- subscriber body -->
  <div class="subscriber-body">

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

    <!-- row start -->
    <div class="row justify-content-center mt-4">
      <div class="col-lg-12">
        <div class="card light">
          <div class="card-body">
            <div class="custom-tabs-container">
              <ul class="nav nav-tabs" id="customTab2" role="tablist">

                <!-- avatar -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'avatar')?'active':'') }}" id="tab-avatar" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'avatar']) }}" role="tab"
                    aria-controls="avatar" aria-selected="false">
                    Avatar
                  </a>
                </li>
                <!-- end avatar -->

                <!-- personal -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'personal')?'active':'') }}" id="tab-personal" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'personal']) }}" role="tab"
                    aria-controls="personal" aria-selected="false">
                    Personal
                  </a>
                </li>
                <!-- end personal -->

                <!-- general information -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'general_information')?'active':'') }}" id="tab-general-information" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'general_information']) }}" role="tab"
                    aria-controls="general_information" aria-selected="false">
                    General Information
                  </a>
                </li>
                <!-- end general information -->

                <!-- qualification -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'qualification')?'active':'') }}" id="tab-qualification" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'qualification']) }}" role="tab"
                    aria-controls="qualification" aria-selected="true">
                    Qualification
                  </a>
                </li>
                <!-- end qualification -->

                <!-- publication -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'publication')?'active':'') }}" id="tab-publication" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'publication']) }}" role="tab"
                    aria-controls="publication]" aria-selected="true">
                    Publication
                  </a>
                </li>
                <!-- end publication -->

                <!-- contact -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'status')?'active':'') }}" id="tab-status" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'status']) }}" role="tab"
                    aria-controls="contact" aria-selected="false">
                    Status
                  </a>
                </li>
                <!-- end contact -->

                <!-- setting -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link {{ ((request()->tab_category == 'setting')?'active':'') }}" id="tab-setting" href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'setting']) }}" role="tab"
                    aria-controls="contact" aria-selected="false">
                    Setting
                  </a>
                </li>
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

                <!-- card -->
                <div class="card">

                  <!-- card body -->
                  <div class="card-body">

                    <!-- row -->
                    <div class="row gx-3">

                      <!-- col -->
                      <div class="col-sm-12 col-12">

                        <!-- row -->
                        <div class="row gx-3">

                          <!-- col -->
                          <div class="col-12">

                            <!-- row -->
                            <div class="row justify-content-center mt-5">

                              <!-- content -->
                              <div class="col-xxl-8 col-sm-12 col-12 order-xxl-2 order-xl-1 order-lg-1 order-md-1 order-sm-1">
                                <div class="card">

                                  <div class="card-body">
                                    <h5 class="card-title mb-2">Position</h5>

                                    <!-- table responsive -->
                                    <div class="table-responsive pt-5">

                                      <!-- table -->
                                      <table class="table table-striped">

                                        <!-- thead -->
                                        <thead class="bg-danger text-white mx-3">

                                          <th>ds</th>
                                          <th>ds</th>

                                        </thead>
                                        <!-- end thead -->

                                        <!-- tbody -->
                                        <tbody>

                                          <td>ds</td>
                                          <td>ds</td>


                                        </tbody>
                                        <!-- end tbody -->

                                      </table>
                                      <!-- end table -->

                                      <!-- pagination -->
                                      <div class="col-12 pt-3">


                                      </div>
                                      <!-- end pagination -->

                                    </div>
                                    <!-- end table responsive -->

                                  </div>
                                </div>
                              </div>
                              <!-- end content -->

                              <!-- content navigation right -->
                              <div class="col-xxl-3 col-sm-4 col-12 order-xxl-3 order-xl-3 order-lg-3 order-md-3 order-sm-3">

                                <!-- position -->
                                <div class="stats-tile d-flex align-items-center tile-red">
                                  <div class="sale-icon icon-box xl rounded-5 me-3">
                                    <i class="bi bi-boxes font-2x text-red"></i>
                                  </div>
                                  <div class="sale-details text-white">
                                    <h5>Position</h5>
                                  </div>
                                </div>
                                <!-- end position -->

                                <!-- area interest -->
                                <div class="stats-tile d-flex align-items-center border">
                                  <div class="sale-icon icon-box xl rounded-5 me-3">
                                    <i class="bi bi-joystick font-2x text-red"></i>
                                  </div>
                                  <div class="sale-details text-secondary">
                                    <h5>Area Interest</h5>
                                  </div>
                                </div>
                                <!-- end area interest -->

                              </div>
                              <!-- end content navigation right -->

                            </div>
                            <!-- end row -->

                          </div>
                          <!-- end col -->

                        </div>
                        <!-- end row -->

                      </div>
                      <!-- end col -->

                    </div>
                    <!-- end row -->

                  </div>
                  <!-- end card body -->

                </div>
                <!-- end card -->

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

  {{-- Pop Alert --}}
  @include($hyperlink['navigation']['layout']['dashboard']['employee']['modal']['pop_alert'])

  <script type="text/javascript">

    /**************************************************************************************
      Document On Load
    **************************************************************************************/
    $(document).ready(function($){

      /**************************************************************************************
        Session
      **************************************************************************************/
      @if(Session('message'))

        alertModal(
          {
            'modal_name':'modal-alert',
            'title':'{{ ucwords(Session::get('alert_type')) }}',
            'message':'{{ ucwords(Session::get('message')) }}'
          }
        );
      @endif

    });

  </script>

@endsection
