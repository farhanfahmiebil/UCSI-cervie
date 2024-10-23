@extends(Config::get('routing.application.modules.landing.layout').'.structure.index')

@section('main-content')

<style media="screen">

/*--- Remove Bootstrap's styling for Nav Class if needed ---*/
#menu_navigation .nav{
  display: inherit;
  flex-wrap: inherit;
  padding-left: inherit;
  margin-bottom: inherit;
  list-style: inherit;
}

/*--- Wrap Up ---*/
.wrapper_menu {
  position: relative;
  padding: 0 11px;
  box-sizing: border-box;
}

.menu_nav {
  /* Make this scrollable when needed */
  overflow-x: auto;
  /* We don't want vertical scrolling */
  overflow-y: hidden;
  /* For WebKit implementations, provide inertia scrolling */
  -webkit-overflow-scrolling: touch;
  /* We don't want internal inline elements to wrap */
  white-space: nowrap;
  /* If JS present, let's hide the default scrollbar */
  /* positioning context for advancers */
  position: relative;
  font-size: 0;
}
.js .menu_nav{
  /* Make an auto-hiding scroller for the 3 people using a IE */
  -ms-overflow-style: -ms-autohiding-scrollbar;
  /* Remove the default scrollbar for WebKit implementations */
}
.js .menu_nav::-webkit-scrollbar {
  display: none;
}

.wrapper_menu .menu_nav .content{
  float: left;
  transition: transform 0.2s ease-in-out;
  position: relative;
}

.ProductNav_Contents-no-transition {
  transition: none;
}

.wrapper_menu .menu_nav .nav_link {
  text-decoration: none;
  color: #7f868b;
  font-size: 0.85rem;
  font-weight: 500;
  display: table-cell;
  vertical-align: middle;
  padding: 8px 12px;
  line-height: 1.35;
}
.wrapper_menu .nav_link[aria-selected=true] {
  color: #6a2c79;
}

.wrapper_menu .advancer {
  /* Reset the button */
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background: transparent;
  padding: 0;
  border: 0;
  /* Now style it as needed */
  position: absolute;
  top: 0;
  bottom: 0;
  /* Set the buttons invisible by default */
  opacity: 0;
  transition: opacity 0.3s;
}
.wrapper_menu .advancer:focus{outline:0;}
.wrapper_menu .advancer:hover{cursor:pointer;}

.wrapper_menu .advancer.left{left:0;}

.wrapper_menu  [data-overflowing=both] ~ .advancer.left,
.wrapper_menu [data-overflowing=left] ~ .advancer.left{
  opacity:1;
}

.wrapper_menu .advancer.right{right:0;}

.wrapper_menu [data-overflowing=both] ~ .advancer.right,
.wrapper_menu [data-overflowing=right] ~ .advancer.right{
  opacity:1;
}

.wrapper_menu .advancer .icon{
  width: 12px;
  height: 44px;
  fill: #bbb;
}

.wrapper_menu .indicator{
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3px;
  width: 100px;
  background-color: transparent;
  transform-origin: 0 0;
  transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
}
</style>
<div class="container">
	<div class="wrapper_menu">

	<nav id="menu_navigation" class="menu_nav dragscroll mouse-scroll" role="tablist">
		<div id="menu_navigation_content" class="nav content">
      {{-- Check Data Outlet Menu Category Sub Exist --}}
      @if(count($data['outlet']['menu']['category']['sub']) > 1)

        {{-- Get Data Outlet Menu Category Sub Exist --}}
        @foreach($data['outlet']['menu']['category']['sub'] as $k=>$v)

		      <a class="nav_link active" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">{{ strtoupper($v->category_sub_name) }}</a>


        @endforeach
        {{-- End Get Data Outlet Menu Category Exist --}}

      @endif
      {{-- End Check Data Outlet Menu Category Exist --}}

      <span id="Indicator" class="indicator"></span>
    </div>
  </nav>

	<button id="advancer_left" class="advancer left" type="button">
		<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"/></svg>
	</button>
	<button id="advancer_right" class="advancer right" type="button">
		<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
	</button>

</div>

	<div class="card">
		<div class="card-body">
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Home</div>
			  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile</div>
			  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
var SETTINGS = {
	navBarTravelling: false,
	navBarTravelDirection: "",
 	navBarTravelDistance: 150
}

var colours = {
    0: "#fead00"
/*
Add Numbers And Colors if you want to make each tab's indicator in different color for eg:
1: "#FF0000",
2: "#00FF00", and so on...
*/
}

document.documentElement.classList.remove('no-js');
document.documentElement.classList.add('js');

// Out advancer buttons
var advancer_left = document.getElementById('advancer_left');
var advancer_right = document.getElementById('advancer_right');

// the indicator
var Indicator = document.getElementById('Indicator');
var menu_navigation = document.getElementById('menu_navigation');
var menu_navigation_content = document.getElementById('menu_navigation_content');


menu_navigation.setAttribute('data-overflowing', determineOverflow(menu_navigation_content, menu_navigation));


// Set the indicator
moveIndicator(menu_navigation.querySelector('[aria-selected=\"true\"]'), colours[0]);


// Handle the scroll of the horizontal container
var last_known_scroll_position = 0;
var ticking = false;

function doSomething(scroll_pos) {
    menu_navigation.setAttribute('data-overflowing', determineOverflow(menu_navigation_content, menu_navigation));
}

menu_navigation.addEventListener('scroll', function() {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function() {
            doSomething(last_known_scroll_position);
            ticking = false;
        });
    }
    ticking = true;
});


advancer_left.addEventListener('click', function() {
// If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the left
    if (determineOverflow(menu_navigation_content, menu_navigation) === 'left' || determineOverflow(menu_navigation_content, menu_navigation) === 'both') {
        // Find how far this panel has been scrolled
        var availableScrollLeft = menu_navigation.scrollLeft;
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
            menu_navigation_content.style.transform = "translateX(" + availableScrollLeft + "px)";
        } else {
            menu_navigation_content.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        menu_navigation_content.classList.remove("ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = 'left';
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    menu_navigation.setAttribute('data-overflowing', determineOverflow(menu_navigation_content, menu_navigation));
});

advancer_right.addEventListener('click', function() {
    // If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }


    // If we have content overflowing both sides or on the right
    if (determineOverflow(menu_navigation_content, menu_navigation) === 'right' || determineOverflow(menu_navigation_content, menu_navigation) === 'both') {
        // Get the right edge of the container and content
        var navBarRightEdge = menu_navigation_content.getBoundingClientRect().right;
        var navBarScrollerRightEdge = menu_navigation.getBoundingClientRect().right;
        // Now we know how much space we have available to scroll
        var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
            menu_navigation_content.style.transform = "translateX(-" + availableScrollRight + "px)";
        } else {
            menu_navigation_content.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        menu_navigation_content.classList.remove('ProductNav_Contents-no-transition');
        // Update our settings
        SETTINGS.navBarTravelDirection = 'right';
        SETTINGS.navBarTravelling = true;
    }
        console.log(32);
    // Now update the attribute in the DOM
    menu_navigation.setAttribute('data-overflowing', determineOverflow(menu_navigation_content, menu_navigation));
});

menu_navigation_content.addEventListener(
    'transitionend',
    function() {
        // get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
        var styleOfTransform = window.getComputedStyle(menu_navigation_content, null);
        var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue('transform');
        // If there is no transition we want to default to 0 and not null
        var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
        menu_navigation_content.style.transform = "none";
        menu_navigation_content.classList.add("ProductNav_Contents-no-transition");
        // Now lets set the scroll position
        if (SETTINGS.navBarTravelDirection === 'left') {
            menu_navigation.scrollLeft = menu_navigation.scrollLeft - amount;
        } else {
            menu_navigation.scrollLeft = menu_navigation.scrollLeft + amount;
        }
        SETTINGS.navBarTravelling = false;
    },
    false
);


// Handle setting the currently active link
menu_navigation_content.addEventListener("click", function(e) {
var links = [].slice.call(document.querySelectorAll("#menu_navigation_content .nav_link"));
links.forEach(function(item) {
item.setAttribute("aria-selected", "false");
})
e.target.setAttribute("aria-selected", "true");
// Pass the clicked item and it's colour to the move indicator function
moveIndicator(e.target, colours[links.indexOf(e.target)]);
});


// var count = 0;
function moveIndicator(item, color) {
    var textPosition = item.getBoundingClientRect();
    var container = menu_navigation_content.getBoundingClientRect().left;
    var distance = textPosition.left - container;
 var scroll = menu_navigation_content.scrollLeft;
    Indicator.style.transform = "translateX(" + (distance + scroll) + "px) scaleX(" + textPosition.width * 0.01 + ")";
// count = count += 100;
// Indicator.style.transform = "translateX(" + count + "px)";

    if (color) {
        Indicator.style.backgroundColor = color;
    }
}


function determineOverflow(content, container) {
    var containerMetrics = container.getBoundingClientRect();
    var containerMetricsRight = Math.floor(containerMetrics.right);
    var containerMetricsLeft = Math.floor(containerMetrics.left);
    var contentMetrics = content.getBoundingClientRect();
    var contentMetricsRight = Math.floor(contentMetrics.right);
    var contentMetricsLeft = Math.floor(contentMetrics.left);
 if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
        return 'both';
    } else if (contentMetricsLeft < containerMetricsLeft) {
        return 'left';
    } else if (contentMetricsRight > containerMetricsRight) {
        return 'right';
    } else {
        return 'none';
    }
}

/*------------------- ACTIVE LINK POSITION ------------------------*/
$('#menu_navigation .nav_link').click(function() {

   centerLI(this, '#menu_navigation');

 });



 //http://stackoverflow.com/a/33296765/350421
 function centerLI(target, outer) {
   var out = $(outer);
   var tar = $(target);
   var x = out.width() - 50;
   var y = tar.outerWidth(true);
   var z = tar.index();
   var q = 0;
   var m = out.find('.nav_link');
   for (var i = 0; i < z; i++) {
     q += $(m[i]).outerWidth(true);
   }

 //out.scrollLeft(Math.max(0, q - (x - y)/2));
 var xy = x - y;
 if(q > xy){
out.animate({
  scrollLeft: Math.max(0, q - (x - y) + 100)
}, 500);
 } else {
 out.animate({
  scrollLeft: Math.max(0, q/2 - 50)
}, 500);
 }

 }


$(document).ready(function() {
$('.mouse-scroll').mousewheel(function(e, delta) {
this.scrollLeft -= (delta * 50);
e.preventDefault();
});
});

</script>
@endsection
