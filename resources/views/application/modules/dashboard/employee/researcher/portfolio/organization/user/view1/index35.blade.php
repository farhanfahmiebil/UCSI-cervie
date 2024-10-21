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
    <style media="screen">
    .custom-tabs-container .tab-header{
      display: flex;
      align-items: center;
    }

    .scrollable-nav {
      display: flex;
      overflow: hidden;
      flex-wrap: nowrap;
      list-style: none;
      padding: 0;
      margin: 0 10px;
    }

    .nav-tabs .nav-item {
      flex-shrink: 0;
    }

    .tab-content {
      margin-top: 20px;
    }

    .previous, .next {
      margin: 0 20px;
      cursor: pointer;
    }

    </style>
    <!-- row start -->
    <div class="row justify-content-center mt-4">

      <!-- col -->
      <div class="col-lg-12">

        <!-- card light -->
        <div class="card light">

          <!-- card body -->
          <div class="card-body">

            <!-- custom tabs container -->
            <div class="custom-tabs-container">

              <div class="tab-header">

                <!-- tab previous button -->
                <button class="previous btn btn-dark"><i class="bi bi-chevron-double-left"></i></button>
                <!-- end tab previous button -->

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs scrollable-nav" id="customTab2" role="tablist">
                  @foreach($data['navigation']['category']['main'] as $key=>$value)
                    <li class="nav-item" role="presentation">
                      <a class="nav-link {{ (request()->tab_category == strtolower($value->navigation_category_code) ? 'active' : '') }}"
                         id="tab-{{ $value->navigation_category_id }}"
                         href="{{ route($hyperlink['page']['researcher']['view'],['organization_id' => request()->organization_id, 'id' => request()->id, 'tab' => 'tab', 'tab_category' => strtolower($value->navigation_category_id)]) }}"
                         role="tab"
                         aria-controls="{{ strtolower($value->navigation_category_id) }}"
                         aria-selected="{{ (request()->tab_category == strtolower($value->navigation_category_code) ? 'true' : 'false') }}">
                         {{ $value->navigation_category_name }}
                      </a>
                    </li>
                  @endforeach
                </ul>

                <!-- tab next button -->
                <button class="next btn btn-dark"><i class="bi bi-chevron-double-right"></i></button>
                <!-- end tab next button -->

              </div>

              <!-- Tab Content -->
              <div class="tab-content h-350">

                {{-- Check Error --}}
                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                {{-- End Check Error --}}

                {{-- Sub Navigation Tab Main
                @include($hyperlink['page']['navigation']['main'].'.tab.content.main.index') --}}

              </div>

            </div>

          </div>
          <!-- end card body -->

        </div>
        <!-- end card light -->

      </div>
      <!-- end col -->

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

      const tabContainer = $('.scrollable-nav');

  // Hide the previous button at the start
  $('.previous').hide();

  // Manage next/previous button visibility
  function manageButtonVisibility() {
    const scrollLeft = tabContainer.scrollLeft();
    const maxScroll = tabContainer[0].scrollWidth - tabContainer.outerWidth();

    if (scrollLeft <= 0) {
      $('.previous').hide();
    } else {
      $('.previous').show();
    }

    if (scrollLeft >= maxScroll) {
      $('.next').hide();
    } else {
      $('.next').show();
    }
  }

  // Initial button visibility check
  manageButtonVisibility();

  // Next button click event
  $('.next').click(function() {
    tabContainer.animate({
      scrollLeft: tabContainer.scrollLeft() + 200 // Scroll amount
    }, 300, manageButtonVisibility);
  });

  // Previous button click event
  $('.previous').click(function() {
    tabContainer.animate({
      scrollLeft: tabContainer.scrollLeft() - 200 // Scroll amount
    }, 300, manageButtonVisibility);
  });

  // Trigger button visibility on tab click
  $('.nav-tabs .nav-link').click(function() {
    manageButtonVisibility();
  });

  // Trigger scroll event to manage button visibility
  tabContainer.on('scroll', manageButtonVisibility);

    });

  </script>

@endsection
