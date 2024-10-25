<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  {{-- Favicon --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.favicon.index')

  {{-- Title --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.title.index')

  {{-- Meta --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.meta.index')

  {{-- Style --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.style.index')

  {{-- Script --}}
  @include(Config::get('routing.application.modules.landing.cervie.layout').'.header.script.index')

</head>

  <!-- body -->
  <body data-spy="scroll" data-target=".navbar-nav" data-offset="90">

    <!-- Loader -->
    <div class="loader" id="loader-fade">
      <div class="loader-container">
        <div class="circle"></div>
      </div>
    </div>
    <!-- Loader ends -->

    <!-- Header start -->
    <header>
        <nav class="navbar navbar-top-default navbar-expand-lg static-nav black nav-radius transparent-bg bottom-nav box-nav not-full no-animation">
            <div class="container radius nav-box-shadow">
                <a class="logo link" href="javascript:void(0)">
                    <img src="personal-profile/img/logo.png" alt="logo" title="Logo">
                </a>
                <div class="collapse navbar-collapse d-none d-lg-block">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"> <a href="#home" class="scroll nav-link link">home</a>
                        </li>
                        <li class="nav-item"> <a href="#features" class="scroll nav-link link">features</a>
                        </li>
                        <li class="nav-item"> <a href="#work" class="scroll nav-link link">work</a>
                        </li>
                        <li class="nav-item"> <a href="#pricing" class="scroll nav-link link">pricing</a>
                        </li>
                        <li class="nav-item"> <a href="#clients" class="scroll nav-link link">clients</a>
                        </li>
                        <li class="nav-item"> <a href="#blog" class="scroll nav-link link">blog</a>
                        </li>
                        <li class="nav-item"> <a href="#contact" class="scroll nav-link link">contact</a>
                        </li>
                    </ul>
                </div>

                <!-- side menu open button -->
                <a class="menu_bars d-inline-block menu-bars-setting menu-inner" id="sidemenu_toggle">
                    <div class="menu-lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </nav>

        <!-- Side Menu -->
        <div class="side-menu">
            <div class="inner-wrapper nav-icon">
                <span class="btn-close link" id="btn_sideNavClose"></span>
                <nav class="side-nav w-100">
                    <div class="navbar-nav">
                        <a class="nav-link link scroll active" href="#home">Home</a>
                        <a class="nav-link link scroll" href="#features">Features</a>
                        <a class="nav-link link scroll" href="#work">Work</a>
                        <a class="nav-link link scroll" href="#pricing">Pricing</a>
                        <a class="nav-link link scroll" href="#clients">Clients</a>
                        <a class="nav-link link scroll" href="#blog">Blog</a>
                        <a class="nav-link link scroll" href="#contact">Contact</a>
                        <span class="menu-line"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </div>
                </nav>

                <div class="side-footer text-white w-100">
                    <ul class="social-icons-simple">
                        <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-facebook-f color-white"></i> </a> </li>
                        <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-instagram color-white"></i> </a> </li>
                        <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fab fa-twitter color-white"></i> </a> </li>
                    </ul>
                    <p class="text-white">&copy; 2024 MegaOne. Made With Love by Themesindustry</p>
                </div>
            </div>
        </div>
        <a id="close_side_menu" href="javascript:void(0);"></a>
        <!--Side Menu-->
    </header>
    <!-- Header end -->

    <!-- Main Section start -->
    <section id="home" class="p-0 particles-version center-block">
        <h2 class="d-none">hidden</h2>
        <div id="particles-js" class="particle2 parallax-setting bg-img-1 bg-img-setting not-full">
        <div class="bg-overlay bg-gradient"></div>
        <div class="not-fullscreen">
            <div class="col-lg-12 text-center center-col">
                <div class="personal-box">
                    <div class="myphoto">
                        <img src="personal-profile/img/personal.jpg" alt="image">
                    </div>
                    <div class="color-white">
                        <h2>Hello, I'm allen</h2>
                        <h3 id="personal"></h3>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Main Section end -->

    <!-- Features start -->
    <section id="features">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="main-title wow fadeIn" data-wow-delay="300ms">
                        <h5> Amazing creativity </h5>
                        <h2> Adorable features </h2>
                        <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12 d-xs-none wow fadeInLeft">
                    <div>
                        <img alt="features" src="personal-profile/img/features1.png">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 mx-auto wow fadeInRight">
                    <div class="feature-item mt-0">
                        <div class="laptop-features-icon">
                            <span class="icon"><i class="fa fa-image color-summer-sky"></i></span>
                        </div>
                        <div class="features-content">
                            <h4 class="color-black font-weight-500 mb-10px">Unique Layout</h4>
                            <p>A robust, multipurpose template built with modularity at the core.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="laptop-features-icon">
                            <span class="icon"><i class="fa fa-server color-summer-sky"></i></span>
                        </div>
                        <div class="features-content">
                            <h4 class="color-black font-weight-500 mb-10px">Online Live Support</h4>
                            <p>You can build your site in-browser with modular interface blocks.</p>
                        </div>
                    </div>
                    <div class="feature-item mb-xs-0">
                        <div class="laptop-features-icon">
                            <span class="icon"><i class="fa fa-tablet color-summer-sky"></i></span>
                        </div>
                        <div class="features-content">
                            <h4 class="color-black font-weight-500 mb-10px">Responsive Design</h4>
                            <p>There are many variations of passages of Lorem Ipsum available.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Features ends -->

    <!-- Stats start -->
    <section class="stats bg-light-gray">
        <h2 class="d-none">heading</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center wow fadeIn" data-wow-delay="300ms">
                    <div class="main-title mb-md-5 wow fadeIn" data-wow-delay="300ms">
                        <h5> Look at our achievements </h5>
                        <h2> More Valued Facts </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 stats-box mb-xs-2rem">
                    <div class="serial-box center-block wow zoomIn" data-wow-delay="400ms">
                        <i class="fa fa-smile" aria-hidden="true"></i>
                        <p class="pt-3 pb-3 numscroller">1391</p>
                        <h6 class="mb-0">Customers</h6>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 stats-box mb-xs-2rem">
                    <div class="serial-box center-block wow zoomIn" data-wow-delay="500ms">
                        <i class="fa fa-sticky-note" aria-hidden="true"></i>
                        <p class="pt-3 pb-3 numscroller">445</p>
                        <h6 class="mb-0">Total Web Pages</h6>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 stats-box mb-xs-2rem">
                    <div class="serial-box center-block wow zoomIn" data-wow-delay="600ms">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                        <p class="pt-3 pb-3 numscroller">133</p>
                        <h6 class="mb-0">Accolades Collect</h6>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 stats-box sm-mt-2rem mb-xs-2rem">
                    <div class="serial-box center-block wow zoomIn" data-wow-delay="700ms">
                        <i class="fa fa-code" aria-hidden="true"></i>
                        <p class="pt-3 pb-3 numscroller">775</p>
                        <h6 class="mb-0">Line of Code</h6>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 stats-box mt-md-2rem">
                    <div class="serial-box center-block wow zoomIn" data-wow-delay="800ms">
                        <i class="fa fa-podcast" aria-hidden="true"></i>
                        <p class="pt-3 pb-3 numscroller">555</p>
                        <h6 class="mb-0">Cups Of Coffee</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Stats ends -->

    <!-- About start -->
    <section class="half-section p-0">
        <h2 class="d-none">heading</h2>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 p-0 order-lg-2">
                    <div class="hover-effect">
                        <img alt="about" src="personal-profile/img/about-img.jpg" class="about-img w-100">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="skill-box">
                        <div class="main-title mb-5 text-md-left wow fadeIn" data-wow-delay="300ms">
                            <h5> Basic info about us </h5>
                            <h2> our professional achievements! </h2>
                            <p> Hoxan is a design studio founded in London. Nowadays, we've grown and expanded our services, and have become a multinational firm, offering a variety of services and solutions Worldwide. </p>
                        </div>
                        <ul class="text-left">
                            <li class="custom-progress">
                                <h6 class="font-18 mb-0 text-capitalize">Mobile app designs <span class="float-right"><b class="font-weight-500 numscroller">95</b>%</span></h6>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-summer-sky" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </li>
                            <li class="custom-progress">
                                <h6 class="font-18 mb-0 text-capitalize">Design and branding<span class="float-right"><b class="font-weight-500 numscroller">88</b>%</span></h6>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-summer-sky" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </li>
                            <li class="custom-progress">
                                <h6 class="font-18 mb-0 text-capitalize">custom web solutions<span class="float-right"><b class="font-weight-500 numscroller">83</b>%</span></h6>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-summer-sky" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </li>
                            <li class="custom-progress mb-0">
                                <h6 class="font-18 mb-0">Risk management <span class="float-right"><b class="font-weight-500 numscroller">91</b>%</span></h6>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-summer-sky" role="progressbar" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About ends -->

    <!-- Phone starts -->
    <section class="absolute-img-wrap">
        <h2 class="d-none">heading</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 text-lg-left text-md-center md-mb-5">
                    <div class="main-title mb-2rem text-lg-left wow fadeIn" data-wow-delay="300ms">
                        <h5> Information about company </h5>
                        <h2> Modeling Agency </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mauris arcu, lobortis id interdum vitae, interdum eget elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mauris arcu, lobortis id interdum vitae, interdum eget elit.</p>
                    </div>
                    <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-summer-sky color-white">Read More
                        <span class="btn-hvr-setting btn-hvr-transparent">
                            <span class="btn-hvr-setting-inner">
                                <span class="btn-hvr-effect"></span>
                                <span class="btn-hvr-effect"></span>
                                <span class="btn-hvr-effect"></span>
                                <span class="btn-hvr-effect"></span>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-12 absolute-img right-img">
                    <div class="d-lg-inline-block">
                        <div class="image"><img alt="SEO" src="personal-profile/img/phone.png"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Phone ends -->

    <!-- Video start -->
    <section class="half-section p-0">
        <h2 class="d-none">heading</h2>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-12 p-0 equalheight col-video video-bg">
                    <div class="image hover-effect">
                        <img alt="stats" src="personal-profile/img/video-bg.jpg" class="equalheight video-img-setting">
                    </div>
                    <a data-fancybox="" href="https://www.youtube.com/watch?v=7e90gBu4pas" class="video-play-button position-absolute">
                        <i class="fa fa-play"></i>
                    </a>

                </div>

                <div class="col-md-6 col-sm-12 p-0 equalheight col-video bg-summer-sky order-lg-2">
                    <div class="video-content-setting center-block text-left text-xs-center equalheight">
                        <h2 class="color-white font-weight-light text-capitalize mb-2rem mb-xxs-3">design for companies and freelancers.</h2>
                        <p class="color-white">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Video ends -->

    <!-- Work Starts -->
    <section id="work" class="portfolio-two">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title mb-2rem wow fadeIn" data-wow-delay="300ms">
                        <h5> Some of the best work </h5>
                        <h2> minimal portfolio </h2>
                        <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
                    </div>
                </div>
            </div>

            <div class="row m-0 d-block">
                <div class="filtering col-sm-12 text-center pt-2 mb-40px">
                    <span data-filter="*" class="active">All</span>
                    <span data-filter=".artwork">Art Work</span>
                    <span data-filter=".web">Design</span>
                    <span data-filter=".printmedia">Print Media</span>
                </div>

                <div class="gallery text-center">

                    <!-- gallery item -->
                    <div class="col-md-4 items web">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Modern Portfolio</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items web">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio2.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio2.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Digital Art Works</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items web">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio3.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio3.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Photography</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items artwork printmedia">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio4.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio4.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Recent Work</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items printmedia">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio5.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio5.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Graphic Works</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-8 items artwork">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio6.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio6.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Creative Art Work</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items artwork">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio7.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio7.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Modern Workspace</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items artwork">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio8.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio8.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Digital Agency</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items artwork">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio9.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio9.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Recent Workspace</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- gallery item -->
                    <div class="col-md-4 items artwork">
                        <div class="item-img">
                            <a href="personal-profile/img/portfolio10.jpg" data-fancybox="images">
                                <img src="personal-profile/img/portfolio10.jpg" alt="image">
                                <div class="item-img-overlay valign">
                                    <div class="overlay-info">
                                        <span class="plus mb-3"></span>
                                        <h4 class="mb-1">Recent Workspace</h4>
                                        <p>Elegant Images</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Work ends -->

    <!-- Pricing start -->
    <section id="pricing" class="bg-light-gray">
        <div class="container">
            <div class="row m-0">
                <div class="col-md-12">
                    <div class="main-title wow fadeIn" data-wow-delay="300ms">
                        <h5> Chose the best one </h5>
                        <h2> Our Pricing Plans </h2>
                        <p> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.</p>
                    </div>
                </div>
            </div>

            <div class="row two-col-pricing">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center md-mb-5 wow fadeInLeft">
                    <div class="pricing-item">
                        <div class="price-box clearfix">
                            <div class="price_title">
                                <h4 class="text-capitalize">Basic Plan</h4>
                                <p>If you are a small business and you are interested in small rebranding then this is a perfect plan for you</p>
                            </div>
                        </div>
                        <div class="price">
                            <h2 class="position-relative"><span class="dollar">$</span>14<span class="month">/ month</span></h2>
                        </div>
                        <div class="price-description">
                            <p>Full Access</p>
                            <p>Unlimited Bandwidth</p>
                            <p>Email Accounts</p>
                            <p class="not"><span class="not-support">Professional project</span></p>
                            <p class="not"><span class="not-support">Support and care</span></p>
                        </div>
                        <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-black text-uppercase">go basic
                            <span class="btn-hvr-setting">
                                 <span class="btn-hvr-setting-inner">
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 </span>
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 text-center md-mb-5 wow fadeInUp">
                    <div class="pricing-item advanced-plan">
                        <div class="price-box clearfix">
                            <div class="price_title">
                                <h4 class="text-capitalize">Advanced Plan</h4>
                                <p>If you are a small business and you are interested in small rebranding then this is a perfect plan for you</p>
                            </div>
                        </div>
                        <div class="price">
                            <h2 class="position-relative"><span class="dollar">$</span>20<span class="month">/ month</span></h2>
                        </div>
                        <div class="price-description">
                            <p>Full Access</p>
                            <p>Unlimited Bandwidth</p>
                            <p>Email Accounts</p>
                            <p>Professional project</p>
                            <p class="not"><span class="not-support">Support and care</span></p>
                        </div>
                        <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-summer-sky text-uppercase">go advanced
                            <span class="btn-hvr-setting">
                                 <span class="btn-hvr-setting-inner">
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 </span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 text-center wow fadeInRight">
                    <div class="pricing-item premium-plan">
                        <div class="price-box clearfix">
                            <div class="price_title">
                                <h4 class="text-capitalize">Premium Plan</h4>
                                <p>If you are a small business and you are interested in small rebranding then this is a perfect plan for you</p>
                            </div>
                        </div>
                        <div class="price">
                            <h2 class="position-relative"><span class="dollar">$</span>38<span class="month">/ month</span></h2>
                        </div>
                        <div class="price-description">
                            <p>Full Access</p>
                            <p>Unlimited Bandwidth</p>
                            <p>Email Accounts</p>
                            <p>Professional project</p>
                            <p>Support and care</p>
                        </div>
                        <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-black text-uppercase">go premium
                            <span class="btn-hvr-setting">
                                 <span class="btn-hvr-setting-inner">
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 </span>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Pricing ends -->

    <!-- Clients start -->
    <section id="clients" class="p-0">
        <h2 class="d-none">heading</h2>
        <section class="parallax-setting parallaxie parallax1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center wow fadeInLeft">
                        <p class="mb-10px font-18 font-weight-normal color-summer-sky">Some of the popular views</p>
                        <h2 class="color-black mb-25px font-weight-light line-height-normal"> Client's Feedback</h2>
                    </div>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-testimonial order-xs-2">
                        <div class="owl-thumbs owl-dots text-md-left">
                            <div class="owl-dot active"><img src="personal-profile/img/testimonial1.png" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial2.png" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial3.png" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial4.png" alt=""></div>

                            <div class="owl-dot"><img src="personal-profile/img/testimonial5.png" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial6.png" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial7.jpg" alt=""></div>
                            <div class="owl-dot"><img src="personal-profile/img/testimonial8.jpg" alt=""></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="owl-carousel owl-theme testimonial-two wow fadeInUp">
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial1.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">David Walker</h5>
                                        <p class="color-catalina-blue"> Chairman, AcroEx </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial2.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Christina Williams</h5>
                                        <p class="color-catalina-blue"> HR Manager </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial3.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Sarah Jones</h5>
                                        <p class="color-catalina-blue"> Sales Executive </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial4.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Chris Gorgano</h5>
                                        <p class="color-catalina-blue"> Photographer </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial5.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Kate Carter</h5>
                                        <p class="color-catalina-blue"> Model </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial6.png" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Alex Curtis </h5>
                                        <p class="color-catalina-blue"> Manager </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial7.jpg" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Ashley Wilson</h5>
                                        <p class="color-catalina-blue"> Actor </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="color-black testimonial-para mb-15px"> Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>

                                <div class="testimonial-post">
                                    <a href="javascript:void(0)" class="post"><img src="personal-profile/img/testimonial8.jpg" alt="image"></a>
                                    <div class="text-content">
                                        <h5 class="color-black text-capitalize">Johnny Perkins</h5>
                                        <p class="color-catalina-blue"> Athlete </p>
                                        <div class="rating">
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                            <i class="ti ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Clients ends -->

    <!-- Blog start -->
    <section id="blog" class="bg-light-gray">
        <h2 class="d-none">heading</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title wow fadeIn" data-wow-delay="300ms">
                        <h5>  Read our blogs </h5>
                        <h2> Website Blogging </h2>
                        <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.                    </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-xs-5">
                    <div class="news_item shadow blog-one">
                        <div class="image split-blog-scale">
                            <img src="personal-profile/img/blog.jpg" alt="Latest News" class="img-fluid">
                        </div>
                        <div class="news_desc">
                            <h3 class="text-capitalize line-height-normal"><a href="javascript:void(0)" class="color-black">Make Strategic Solutions</a></h3>
                            <ul class="meta-tags mt-20px mb-20px">
                                <li><a href="javascript:void(0)"><i class="fa fa-calendar"></i>Apr 14</a></li>
                                <li><a href="javascript:void(0)"> <i class="fa fa-user"></i> Bill </a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-comment"></i>5 </a></li>
                            </ul>
                            <p class="mb-35px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                            <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-black text-white btn-hvr">Read more
                                <span class="btn-hvr-setting btn-hvr-summer-sky">
						     <span class="btn-hvr-setting-inner">
							 <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             </span>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="news_item shadow blog-two">
                        <div class="image split-blog-scale">
                            <img src="personal-profile/img/blog2.jpg" alt="Latest News" class="img-fluid">
                        </div>
                        <div class="news_desc">
                            <h3 class="text-capitalize line-height-normal"><a href="javascript:void(0)" class="color-black">Creating better experience</a></h3>
                            <ul class="meta-tags mt-20px mb-20px">
                                <li><a href="javascript:void(0)"><i class="fa fa-calendar"></i>Feb 28</a></li>
                                <li><a href="javascript:void(0)"> <i class="fa fa-user"></i> Barry </a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-comment"></i>5 </a></li>
                            </ul>
                            <p class="mb-35px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                            <a href="javascript:void(0)" class="btn-setting btn-hvr-setting-main btn-summer-sky text-white btn-hvr">Read more
                                <span class="btn-hvr-setting btn-hvr-black">
						     <span class="btn-hvr-setting-inner">
							 <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             <span class="btn-hvr-effect"></span>
                             </span>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog ends -->

    <!-- Brands starts -->
    <section>
        <h2 class="d-none">heading</h2>
        <div class="container">
            <div class="brand-carousel owl-carousel owl-theme">
                <div class="item">
                    <img src="personal-profile/img/client-one.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-two.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-three.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-four.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-five.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-one.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-two.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-three.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-four.png" alt="Logo">
                </div>
                <div class="item">
                    <img src="personal-profile/img/client-five.png" alt="Logo">
                </div>
            </div>
        </div>
    </section>
    <!-- Brands ends -->

    <!-- Contact & Map starts -->
    <section id="contact" class="bg-light-gray">
        <div class="container">
            <div class="row pb-half pb-xs-0">
                <div class="col-lg-6 col-md-12 col-sm-12 mb-5 wow fadeInUp" data-wow-delay="400ms">
                    <div class="contact-box-shadow">
                        <div class="text-left sm-text-center w-100">
                            <h2 class="color-black font-weight-normal mb-2rem"> Connect with MegaOne.</h2>
                            <p class="contact-para-setting">
                                Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend.
                            </p>
                        </div>
                        <div class="contact-info sm-text-center">
                            <div class="icon-box">
                                <i class="fa fa-mobile color-summer-sky"></i>
                                <p class="color-grey"> +(34) 609 33 17 54</p>
                            </div>
                            <div class="icon-box">
                                <i class="fa fa-envelope color-summer-sky"></i>
                                <p> <a href="mailto:email@website.com" class="color-grey">email@website.com</a></p>
                            </div>
                            <div class="icon-box">
                                <i class="fa fa-server color-summer-sky"></i>
                                <p> <a href="mailto:support@website.com" class="color-grey">support@website.com</a></p>
                            </div>

                            <div class="icon-box">
                                <i class="fa fa-map-marker color-summer-sky"></i>
                                <p class="color-grey"> 201 Oak Street Building 27 Manchester, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mb-5 col-map wow fadeInUp" data-wow-delay="400ms">
                    <div id="google-map" class="bg-light-gray map"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-title wow fadeIn" data-wow-delay="300ms">
                        <h5> Leave a message </h5>
                        <h2> Need Assistance? </h2>
                        <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.                    </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 contact-form-center wow fadeInUp" data-wow-delay="400ms">

                    <div class="col-sm-12 p-0" id="result"></div>

                    <div class="company-contact-form">
                        <form class="contact-form-outer contact-form" id="contact-form-data">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-form-textfield pb-4">
                                        <input type="text" placeholder="Name" class="form-control" required="" id="name" name="userName">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-form-textfield pb-4">
                                        <input type="email" placeholder="Email" class="form-control" required="" id="email" name="userEmail">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-form-textfield pb-4">
                                        <input type="tel" placeholder="Contact No" class="form-control" id="phone" name="userPhone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-form-textfield pb-4">
                                        <input type="text" placeholder="Subject" class="form-control" id="subject" name="userSubject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-form-textfield pb-4">
                                        <textarea placeholder="Message" class="form-control message" id="message" name="userMessage"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 pt-xs-25px text-center">
                                    <button type="button" class="btn-setting btn-hvr-setting-main btn-summer-sky btn-hvr contact_btn" id="submit_btn"><i class="fa fa-reload ti-reload mr-2 d-none" aria-hidden="true"></i><b class="font-weight-normal">Contact Now</b>
                                        <span class="btn-hvr-setting btn-hvr-black">
                                 <span class="btn-hvr-setting-inner">
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 <span class="btn-hvr-effect"></span>
                                 </span>
                                </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact & Map ends -->

    <!-- Footer starts -->
    <footer class="p-half bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <ul class="footer-icons mb-4">
                        <li><a href="javascript:void(0)" class="wow fadeInUp facebook"><i class="fab fa-facebook-f"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="wow fadeInDown twitter"><i class="fab fa-twitter"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="wow fadeInUp google"><i class="fab fa-google"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="wow fadeInDown linkedin"><i class="fab fa-linkedin-in"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="wow fadeInUp instagram"><i class="fab fa-instagram"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="wow fadeInDown pinterest"><i class="fab fa-pinterest-p"></i> </a> </li>
                    </ul>
                    <p class="copyrights mt-2 mb-2">&copy; 2024 MegaOne. Made with love by <a href="javascript:void(0)">themesindustry</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->

    <!--Animated Cursor-->
    <div id="animated-cursor">
        <div id="cursor">
            <div id="cursor-loader"></div>
        </div>
    </div>
    <!--Animated Cursor End-->

    {{-- Script --}}
    @include(Config::get('routing.application.modules.landing.cervie.layout').'.footer.script.index')

  </body>
  <!-- end body -->

</html>
<!-- end html -->