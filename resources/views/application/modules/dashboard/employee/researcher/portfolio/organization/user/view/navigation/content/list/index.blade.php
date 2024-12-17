@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

  <!-- subscriber body -->
  <div class="subscriber-body">

    {{-- Breadcrumb --}}
    @include($page['navigation']['header']['breadcrumb'])

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

              {{-- Tab Header --}}
              @include($page['navigation']['tab']['header'])

              <!-- tab content -->
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

                {{-- Sub Navigation Tab Main --}}
                @include($page['navigation']['tab']['main'])

              </div>
              <!-- end tab content -->

            </div>
            <!-- end custom tabs container -->

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
