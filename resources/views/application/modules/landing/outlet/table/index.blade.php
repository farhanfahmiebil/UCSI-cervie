@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<style media="screen">

.navigation-tab-scroller {
    /* width: 350px; */
    margin: 0 auto;
    position: relative;
}
.tab-wrapper{
    width: 100%;
    height: 34px;
    overflow: hidden;
    position: relative;
}
.tabs {
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0;
    bottom: -25px;
    left: 0;
    right: 0;
    white-space: nowrap;
    overflow: auto;
}
.tabs li {
    display: inline-block;
    /* background-color: #ccc; */
    background-color: white;
    /* border:1px solid red; */

    padding: 3px 8px;
    cursor: pointer;
}


.tabs li.active {
    /* background-color: white; */
    border-bottom:2px solid #dd0000 !important;
}
.next, .previous {
  cursor: pointer;
  position: absolute;
  padding: 2px 4px;
  top: 0;
  background-color: white;
}
.next {
    right: -25px;
}
.previous {
    left: -25px;
}
.tabContent {
    width: 100%;
    background-color: white;
    padding: 15px;
}
</style>

<!-- container -->
<div class="container">

  <!-- wrapper menu -->
  <div class="wrapper_menu">

    <!-- menu nav -->
  	<nav id="menu_navigation" class="menu_nav dragscroll mouse-scroll" role="tablist">

      <!-- container fluid -->
      <div class="container-fluid navigation-tab-scroller">

        <!-- tab wrapper -->
        <div class="tab-wrapper">
          <ul class="tabs">

            {{-- Check Data Outlet Menu Category Sub Exist --}}
            @if(count($data['outlet']['menu']['category']['sub']) > 1)

              {{-- Get Data Outlet Menu Category Sub Exist --}}
              @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

                <li data-id="item-{{ $k }}" class="{{ (($k==0)?'active':'') }}">{{ strtoupper($v->category_sub_name) }}</li>

              @endforeach
              {{-- End Get Data Outlet Menu Category Exist --}}

            @endif
            {{-- End Check Data Outlet Menu Category Exist --}}

          </ul>
        </div>
        <span class="next"><i class="bi bi-arrow-right"></i></span>
        <span class="previous"><i class="bi bi-arrow-left"></i></span>
      </div>
      <!-- end tab wrapper -->

    </nav>
    <!-- end menu nav -->

    <!-- tab content -->
    <div class="tabContent">

      {{-- Check Data Outlet Menu Category Sub Exist --}}
      @if(count($data['outlet']['menu']['category']['sub']) > 1)

        {{-- Get Data Outlet Menu Category Sub --}}
        @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

          <!-- content -->
          <div class="content item-{{ $k }}">

            {{-- Check Data Item Menu Exist --}}
            @if(count($data['outlet']['menu']['item']) > 1)

              <!-- row -->
              <div class="row row-cols-1 row-cols-md-5 g-4">

                {{-- Get Data Outlet Menu Exist --}}
                @foreach($data['outlet']['menu']['item'] as $item)

                  {{-- If Category Sub Match with Category Sub in Sub --}}
                  @if($v->category_sub_id == $item->category_sub_id)

                    @php

                      // Check if item_image is not null or empty
                      $image['menu'] = !empty($item->item_image) ? 'data:image/jpeg;base64,'.base64_encode($item->item_image) : asset('images\default\no_image.png');

                    @endphp

<style media="screen">


.cart-button {
  position: relative;
  width: 200px;
  height: 60px;
  font-size:12px;
}

.cart-button:active {
transform: scale(.9);
}

.cart-button .bi-cart-check {
position: absolute;
z-index: 2;
top: 50%;
left: -10%;
font-size: 2em;
transform: translate(-50%,-50%);
}
.cart-button .bi-boxes {
position: absolute;
z-index: 3;
top: -20%;
left: 52%;
font-size: 1.2em;
transform: translate(-50%,-50%);
}
.cart-button span {
position: absolute;
z-index: 3;
left: 50%;
top: 50%;
font-size: 1.2em;
color: #fff;
transform: translate(-50%,-50%);
}
.cart-button span.add-to-cart{opacity:1;}
.cart-button span.added{ opacity:0;}

.cart-button.clicked .bi-cart-check {
animation: cart 1.5s ease-in-out forwards;
}
.cart-button.clicked .bi-boxes {
animation: box 1.5s ease-in-out forwards;
}
.cart-button.clicked span.add-to-cart {
animation: txt1 1.5s ease-in-out forwards;
}
.cart-button.clicked span.added {
animation: txt2 1.5s ease-in-out forwards;
}
@keyframes cart {
0% {
  left: -10%;
}
40%, 60% {
  left: 50%;
}
100% {
  left: 110%;
}
}
@keyframes box {
0%, 40% {
  top: -20%;
}
60% {
  top: 40%;
  left: 52%;
}
100% {
  top: 40%;
  left: 112%;
}
}
@keyframes txt1 {
0% {
  opacity: 1;
}
20%, 100% {
  opacity: 0;
}
}
@keyframes txt2 {
0%, 80% {
  opacity: 0;
}
100% {
  opacity: 1;
}
}

</style>
                    <!-- col -->
                    <div class="col">
                      <div class="card h-100">
                        <img src="{{ $image['menu'] }}" class="card-img-top" alt="Image Item {{ $item->item_id }}" style="height:150px;width:100%;">
                        <div class="card-body">
                          <h6 class="card-title">{{ $item->item_name }}</h6>
                          <p class="card-text"></p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                          <small class="d-grid text-center">
                            RM{{ $item->item_price }}
                          </small>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                          <small class="d-grid">
                            <button type="button" class="cart-button btn btn-primary" name="item" value="{{ $item->item_id }}">
                              <span class="add-to-cart">Add to Cart</span>
                              <span class="added">Added</span>
                            	<i class="bi bi-cart-check"></i>
                            	<i class="bi bi-boxes"></i>
                            </button>

                          </small>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                  @endif
                  {{-- End If Category Match with Category in Sub --}}

                @endforeach

              </div>
              <!-- end row -->

            @endif
            {{-- End Check Data Item Menu Exist --}}

          </div>
          <!-- end content -->

        @endforeach
        {{-- End Get Data Outlet Menu Category Sub --}}

      @endif
      {{-- End Check Data Outlet Menu Category Sub Exist --}}

    </div>
    <!-- end tab content -->

  </div>
  <!-- end wrapper menu -->

</div>
<!-- end container -->


<script type="text/javascript">

$(document).ready(function() {
  $('.wrapper_menu .tabContent .content:not(:first)').toggle();

     // hide the previous button
     $('.wrapper_menu .previous').hide();

     $('.wrapper_menu .tabs li').click(function () {

         if ($(this).is(':last-child')) {
             $('.next').hide();
         } else {
             $('.next').show();
         }

         if ($(this).is(':first-child')) {
             $('.previous').hide();
         } else {
             $('.previous').show();
         }

         var position = $(this).position();
         var corresponding = $(this).data("id");

         // scroll to clicked tab with a little gap left to show previous tabs
         scroll = $('.wrapper_menu .tabs').scrollLeft();
         $('.wrapper_menu .tabs').animate({
             'scrollLeft': scroll + position.left - 30
         }, 200);

         // hide all content divs
         $('.wrapper_menu .tabContent .content').hide();

         // show content of corresponding tab
         $('.wrapper_menu div.' + corresponding).toggle();

         // remove active class from currently not active tabs
         $('.wrapper_menu .tabs li').removeClass('active');

         // add active class to clicked tab
         $(this).addClass('active');
     });

 $('.wrapper_menu div a').click(function(e){
     e.preventDefault();
     $('.wrapper_menu li.active').next('li').trigger('click');
 });
 $('.wrapper_menu .next').click(function(e){
     e.preventDefault();
     $('.wrapper_menu li.active').next('li').trigger('click');
 });
 $('.wrapper_menu .previous').click(function(e){
     e.preventDefault();
     $('.wrapper_menu li.active').prev('li').trigger('click');
 });

 $('.cart-button').on('click',function(){
    var button = $(this);
    button.addClass('clicked');

    
    setTimeout(function() {
      // Remove the 'clicked' class after the delay
      button.removeClass('clicked');
    }, 2000);


  });

});




</script>
@endsection
