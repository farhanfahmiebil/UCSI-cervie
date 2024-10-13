@php

  $navigation_alignment = '';

@endphp
<!-- pagination navigation -->
{{-- Pagination Has Pages --}}
@if($paginator->hasPages())

  {{-- Get Navigation Alignment Exist --}}
  @if(isset($navigation['alignment']))

    {{-- Get Navigation Alignment --}}
    @switch($navigation['alignment'])

      {{-- Center --}}
      @case('center')

        @php
          $navigation_alignment = 'justify-content-center';
        @endphp

      @break

    @endswitch
    {{-- End Get Navigation Alignment --}}

  @endif
  {{-- End Check Navigation Alignment Exist --}}

  <!-- pagination desktop -->
  <div class="d-none d-sm-none d-md-block">

    <!-- pagination -->
    <ul class="pagination {{ $navigation_alignment }}">

      {{-- Previous Page Link --}}
      @if(!$paginator->onFirstPage())
        <li class="paginate_button page-item disabled"><span class="page-link">Previous</span></li>
      @endif
      {{--  End Previous Page Link --}}

      {{-- If Current Page Link More Than 3 --}}
      @if($paginator->currentPage() > 3)
        <li class="paginate_button page-item">
          <a class="page-link" href="{{ $paginator->toArray()['first_page_url'] }}">First</a>
        </li>
      @endif
      {{-- End If Current Page Link More Than 3 --}}

      {{-- If Current Page Link More Than 4 --}}
      @if($paginator->currentPage() > 4)
        <li class="paginate_button page-item">
          <span class="page-link">...</span>
        </li>
      @endif
      {{-- End If Current Page Link More Than 4 --}}

      {{-- Get Page Number --}}
      @foreach(range(1,$paginator->lastPage()) as $i)

        {{-- Check Page Number Less or More Than 2 --}}
        @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)

          {{-- Get Current Page To Set Active And Get Beside Page --}}
          @if($i == $paginator->currentPage())
            <li class="paginate_button page-item active">
              <span class="page-link">{{ $i }}</span>
            </li>

          {{-- Get Beside Page --}}
          @else
            <li class="paginate_button page-item">
              <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
          @endif
          {{-- End Get Current Page To Set Active And Get Beside Page --}}

        @endif
        {{-- End Check Page Number Less or More Than 2 --}}

      @endforeach
      {{-- End Get Page Number --}}

      {{-- If Current Page Link Less Than Last Page By 3 --}}
      @if($paginator->currentPage() < $paginator->lastPage() - 3)
        <li class="paginate_button page-item">
          <span class="page-link">...</span>
        </li>
      @endif
      {{-- End If Current Page Link Less Than Last Page By 3 --}}

      {{-- If Current Page Link Less Than Last Page By 2 --}}
      @if($paginator->currentPage() < $paginator->lastPage() - 2)
        <li class="paginate_button page-item hidden-xs">
          <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        </li>
      @endif
      {{-- End If Current Page Link Less Than Last Page By 2 --}}

      {{-- Next Page Link --}}
      @if($paginator->hasMorePages())
        <li class="paginate_button page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
        </li>
      @endif
      {{-- End Next Page Link --}}

    </ul>
    <!-- end pagination -->

  </div>
  <!-- end pagination desktop -->

  <!-- pagination mobile -->
  <div class="py-3 d-block d-sm-none">

    <!-- form group -->
    <div class="form-group">

      <!-- label -->
      <label for="pagination_no_mobile">Page No</label>
      <!-- end label -->

      <!-- select -->
      <select class="form-control select2" name="pagination_no_mobile">

        {{-- Pagination Elements --}}
        @foreach($elements as $element)

          {{-- Array Of Links --}}
          @if(is_array($element))

            {{-- Get Page --}}
            @foreach($element as $page => $url)
              <option value="{{ $url }}" {{ (($page == ($paginator->currentPage()))?'selected':'') }}>{{ $page }}</option>
            @endforeach
            {{-- End Get Page --}}

          @endif
          {{-- End Array Of Links --}}

        @endforeach
        {{-- End Pagination Elements --}}

      </select>
      <!-- end select -->

    </div>
    <!-- end form group -->

  </div>
  <!-- end pagination mobile -->

@endif
<!-- end pagination navigation -->
