<!-- content -->
<div class="col-lg-12 col-sm-12 flex-column d-flex stretch-card">

  <!-- row 1 -->
  <div class="row">

    {{-- Graph --}}
    @include($page['sub'].'.statistic')

    {{-- Publication --}}
    @include($page['sub'].'.publication')

  </div>
  <!-- end row 1 -->

</div>
<!-- end content -->
