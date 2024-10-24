<!-- section organization -->
<section id="our_faculties" class="bg-light-gray">

  <!-- heading -->
  <h2 class="d-none">heading</h2>
  <!-- end heading -->

  <!-- container -->
  <div class="container">

    <!-- title -->
    <div class="row">
      <div class="col-md-12">
        <div class="main-title wow fadeIn" data-wow-delay="300ms">
          <h2>Our Faculties </h2>
        </div>
      </div>
    </div>
    <!-- end title -->

    {{-- Check Organization Exist --}}
    @if(count($data['organization']) >= 1)

      {{-- Initialize a counter --}}
      @foreach($data['organization'] as $key => $value)

        {{-- Start a new row for every 3 items --}}
        @if($key % 3 == 0)
          <div class="row pt-3">
        @endif

        <!-- column content -->
        <div class="col-md-4 col-sm-12 d-flex align-items-stretch">

          <!-- news item -->
          <div class="news_item shadow blog-two d-flex flex-column">
            <div class="image split-blog-scale">
              <img src="{{ asset($asset['image'] . 'organization/' . $value->organization_id . '.png') }}" alt="Latest News" class="img-fluid card-fixed">
            </div>
            <div class="news_desc mt-auto">
              <h3 class="text-capitalize line-height-normal">
                <a href="javascript:void(0)" class="color-black">{{ $value->name }}</a>
              </h3>
            </div>
          </div>
          <!-- end news item -->

        </div>
        <!-- end column content -->


        {{-- Close the row after every 3rd item --}}
        @if(($key + 1) % 3 == 0)
          </div>
        @endif

      @endforeach

      {{-- Close the last row if it's not closed (i.e., if there are fewer than 3 items in the last row) --}}
      @if(count($data['organization']) % 3 != 0)
          </div>
      @endif

    @endif
    {{-- End Check Organization Data Exist --}}

  </div>
  <!-- end container -->

</section>
<!-- end section organization -->
