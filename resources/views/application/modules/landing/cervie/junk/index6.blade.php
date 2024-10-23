@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

  <!-- container -->
  <div class="container">

    {{-- Check Data Outlet Menu Category Exist --}}
    @if(count($data['outlet']['menu']['category']['main']) > 1)

      {{-- Get Data Outlet Menu Category Exist --}}
      @foreach($data['outlet']['menu']['category']['main'] as $key=>$value)

        <h3 class="display-6 mb-3 mx-auto">{{ $value->category_name }}</h3>

        {{-- Check Data Outlet Menu Category Exist --}}
        @if(count($data['outlet']['menu']['category']['sub']) > 1)

          {{-- Get Data Outlet Menu Category Exist --}}
          @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

            @if($value->category_id == $v->category_id)

              <div class="container">
                <div class="wrapper_colors">
                  <ul class="nav nav-pills list_colors li1">
                    <li class="nav-item">
                      <a class="nav-link fw-bold" aria-current="page" href="#">{{ $v->category_sub_name }}</a>
                    </li>
                  </ul>
                </div>
              </div>

            @endif

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
