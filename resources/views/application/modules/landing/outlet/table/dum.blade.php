@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

  <!-- container -->
  <div class="container">

    {{-- Check Data Outlet Menu Category Exist --}}
    @if(count($data['outlet']['menu']['category']['main']) > 1)

      {{-- Get Data Outlet Menu Category Exist --}}
      @foreach($data['outlet']['menu']['category']['main'] as $key=>$value)

        <h3 class="display-6 mb-3 mx-auto">{{ strtoupper($value->category_name) }}</h3>

        {{-- Check Data Outlet Menu Category Sub Exist --}}
        @if(count($data['outlet']['menu']['category']['sub']) > 1)

          {{-- Get Data Outlet Menu Category Sub Exist --}}
          @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

            {{-- If Category Match with Category in Sub --}}
            @if($value->category_id == $v->category_id)

              <h3 class="display-7 mb-3 mx-auto">{{ strtoupper($v->category_sub_name) }}</h3>
              <div class="row row-cols-1 row-cols-md-5 g-4">
              {{-- Check Data Outlet Menu Exist --}}
              @if(count($data['outlet']['menu']['item']) > 1)

                {{-- Get Data Outlet Menu Exist --}}
                @foreach($data['outlet']['menu']['item'] as $item)

                  {{-- If Category Sub Match with Category Sub in Sub --}}
                  @if($value->category_id == $item->category_id && $v->category_sub_id == $item->category_sub_id)

                    @php
                      // Check if item_image is not null or empty
                      $image['menu'] = !empty($item->item_image) ? 'data:image/jpeg;base64,'.base64_encode($item->item_image) : asset('images\default\no_image.png');
                    @endphp

                      <div class="col">
                        <div class="card h-100">
                          <img src="{{ $image['menu'] }}" class="card-img-top" alt="Image Item {{ $item->item_id }}" style="height:150px;width:100%;">
                          <div class="card-body">
                            <h6 class="card-title">{{ $item->item_name }}</h6>
                            <p class="card-text">RM{{ $item->item_price }}</p>
                          </div>
                          <div class="card-body">
                            <small class="d-grid">
                              <button type="button" class="btn btn-primary" name="button">Add to Cart</button>
                            </small>
                          </div>
                        </div>
                      </div>

                  @endif
                  {{-- End If Category Match with Category in Sub --}}

                @endforeach
                {{-- End Get Data Outlet Menu Category Exist --}}
                </div>
              @endif
              {{-- End Check Data Outlet Menu Category Exist --}}


            @endif
            {{-- End If Category Match with Category in Sub --}}

          @endforeach
          {{-- End Get Data Outlet Menu Category Exist --}}

        @endif
        {{-- End Check Data Outlet Menu Category Exist --}}

      @endforeach
      {{-- End Get Data Outlet Menu Category Exist --}}

    @endif
    {{-- End Check Data Outlet Menu Category Exist --}}

  </div>


<script type="text/javascript">

// A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );

var hidWidth;
var scrollBarWidths = 40;

var widthOfList = function(){
var itemsWidth = 0;
$('.list_colors.li1 li').each(function(){
  var itemWidth = $(this).outerWidth();
  itemsWidth+=itemWidth;
});
return itemsWidth;
};

var widthOfHidden = function(){
return (($('.wrapper_colors').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
return $('.list_colors.li1').position().left;
};

var reAdjust = function(){
if (($('.wrapper_colors').outerWidth()) < widthOfList()) {
  $('.scroller-right-1').show();
}
else {
  $('.scroller-right-1').hide();
}

if (getLeftPosi()<0) {
  $('.scroller-left-1').show();
}
else {
  $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
  $('.scroller-left-1').hide();
}
}

reAdjust();

$(window).on('resize',function(e){
  reAdjust();
});

$('.scroller-right-1').click(function() {

$('.scroller-left-1').fadeIn('slow');
$('.scroller-right-1').fadeOut('slow');

$('.list_colors.li1').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){

});
});

$('.scroller-left-1').click(function() {

$('.scroller-right-1').fadeIn('slow');
$('.scroller-left-1').fadeOut('slow');

  $('.list_colors.li1').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

  });
});
});
</script>
@endsection
