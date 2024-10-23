<!-- main header -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">

  <div class="d-flex align-items-center justify-content-center">
    <div class="page-icon">

      {{-- Breadcrumb Icon --}}
      @if(isset($data['breadcrumb']['icon']))
        {!! $data['breadcrumb']['icon'] !!}
      @endif
      {{-- End Breadcrumb Icon --}}

    </div>
    <div class="page-title d-none d-md-block">
      <ul class="d-flex align-items-center">

        {{-- Breadcrumb Title --}}
        @if(isset($data['breadcrumb']['title']))

          {{-- Breadcrumb Title --}}
          @foreach($data['breadcrumb']['title'] as $key=>$value)

            {{-- IF Key Not Zero --}}
            @if($key != 0)

              <li>
                <h5>
                  > {{ ucwords($value) }} &nbsp;
                </h5>
              </li>

            @else

              <li>
                <h3>
                  {{ ucwords($value) }} &nbsp;
                </h3>
              </li>

            @endif
            {{-- End IF Key Not Zero --}}

          @endforeach
          {{-- End Breadcrumb Title --}}

        @endif
        {{-- End Breadcrumb Title --}}

      </ul>

    </div>
  </div>
  <!-- Live updates start -->
  <ul class="updates d-flex align-items-end flex-column overflow-hidden" id="updates">
    <li>
      <a href="javascript:void(0)">
        <i class="bi bi-envelope-paper text-primary font-1x me-2"></i>
        <span></span>
      </a>
    </li>
  </ul>

</div>
<!-- end main header -->
