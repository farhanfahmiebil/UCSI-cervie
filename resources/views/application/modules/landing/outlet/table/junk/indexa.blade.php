@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<style media="screen">
.wrapper_colors {
  position:relative;
  margin:0 auto;
  overflow:hidden;
padding:5px;
  height:50px;
}

.list_colors {
  position:absolute;
  left:0px;
  top:0px;
  min-width:3000px;
  margin-left:12px;
  margin-top:0px;
}

.list_colors li{
display:table-cell;
  position:relative;
  text-align:center;
  cursor:grab;
  cursor:-webkit-grab;
  color:#efefef;
  vertical-align:middle;
}

.scroller {
text-align:center;
cursor:pointer;
display:none;
padding:7px;
padding-top:11px;
white-space:no-wrap;
vertical-align:middle;
background-color:#fff;
}

.scroller-right-1{
float:right;
}

.scroller-left-1 {
float:left;
}
</style>
  <!-- container -->
  <i class="bi bi-arrow-left text-danger"></i></div>
  <div class="container">
    <div class="scroller scroller-left-1"><i class="bi bi-arrow-left"></i></div>
    <div class="scroller scroller-right-1"><i class="bi bi-arrow-right"></i></div>
    <div class="wrapper_colors">
      <ul class="nav nav-pills list_colors li1">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">All</a>
        </li>
        {{-- Check Data Outlet Menu Category Exist --}}
        @if(count($data['outlet']['menu']['category']['sub']) > 1)

          {{-- Get Data Outlet Menu Category Exist --}}
          @foreach($data['outlet']['menu']['category']['sub'] as $key=>$value)

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">{{ $value->category_sub_name }}</a>
          </li>

          @endforeach
          {{-- End Get Data Outlet Menu Category Exist --}}

        @endif
        {{-- End Check Data Outlet Menu Category Exist --}}
      </ul>
    </div>
  </div>

<style media="screen">
body {
padding : 10px ;

}

#exTab1 .tab-content {
color : white;
background-color: #428bca;
padding : 5px 15px;
}

#exTab2 h3 {
color : white;
background-color: #428bca;
padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
color : white;
background-color: #428bca;
padding : 5px 15px;
}






</style>
  <div class="wrap" id="fifth-a">
      <h2>5.1. Dissappearing arrows</h2>
      <p>These arrows initially show that the menu can scroll, and they can be clicked on as alternatives to touch. However once the menu is swiped or scrolled via touch, the arrows dissappear</p>

    <div class="scroll-arrow"  id="hideOnTouch">
      <a href="#!" class="arrow left scrollarrow" id="arrowFiveLeft-A">&lsaquo;</a>
      <a href="#!" class="arrow right scrollarrow" id="arrowFiveRight-A">&rsaquo;</a>
    <div class="scroll-wrapper">
    <ul class="nav nav-tabs nav2">
            <li role="presentation" class="active"><a href="#!" class="active">Prescriptions</a></li>
            <li role="presentation"><a href="#!">Rx Status</a></li>
            <li role="presentation"><a href="#!">Rx Transfers</a></li>
            <li role="presentation"><a href="#!">Statement Report</a></li>
            <li role="presentation" class="last"><a href="#!">Customer Info.</a></li>
        </ul>
  </div>
      </div>
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
