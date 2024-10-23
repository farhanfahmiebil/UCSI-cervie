<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.landing.layout').'.header.favicon.index')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.landing.layout').'.header.title.index')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.landing.layout').'.header.meta.index')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.landing.layout').'.header.style.index')

      {{-- Script --}}
      @include(Config::get('routing.application.modules.landing.layout').'.header.script.index')

    </head>

    <!-- body -->
    <body>

      {{-- Navigation - Header --}}
      @include(Config::get('routing.application.modules.landing.layout').'.navigation.header.index')

      {{-- Navigation - Right --}}
      @include(Config::get('routing.application.modules.landing.layout').'.navigation.right.index')


      <!--Page hero-->
      <section class="position-relative overflow-hidden bg-light">
       <div class="container pt-8 pb-6 text-center position-relative">
           <div class="row pt-4 pt-lg-6 justify-content-center text-center">
               <div class="col-lg-8 col-md-10">
                   <h1 class="display-3 mb-3 mx-auto">
                       Extended Grid</h1>
                   <p class="lead mb-0">
                       The best food in town at one of the best locations
                   </p>
               </div>
           </div>
       </div>
       </section>

   <!--Main content-->
   <main id="main">

     {{-- Main Content --}}
      @yield('main-content')


   </main>


<!--Divider-->
<svg preserveAspectRatio="none" width="100%" height="64" viewBox="0 0 1015 162" fill="none"
xmlns="http://www.w3.org/2000/svg">
<g class="text-primary">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M1061 32.6481L1038.9 39.8343C1016.79 47.0205 972.583 61.393 928.375 54.2067C884.167 47.0205 839.958 18.2756 795.75 29.055C751.542 39.8343 707.333 90.1378 663.125 90.1378C618.917 90.1378 574.708 39.8343 530.5 25.4619C486.292 11.0894 442.083 32.6481 397.875 29.055C353.667 25.4619 309.458 -3.28301 265.25 0.310095C221.042 3.9032 176.833 39.8343 132.625 61.3929C88.4167 82.9516 44.2083 90.1378 22.1041 93.7309L0 97.324V162H22.1041C44.2083 162 88.4167 162 132.625 162C176.833 162 221.042 162 265.25 162C309.458 162 353.667 162 397.875 162C442.083 162 486.292 162 530.5 162C574.708 162 618.917 162 663.125 162C707.333 162 751.542 162 795.75 162C839.958 162 884.167 162 928.375 162C972.583 162 1016.79 162 1038.9 162H1061V32.6481Z"
        fill="currentColor"></path>
</g>
<g class="text-dark">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M1015 42.2297L993.854 48.8836C972.708 55.5375 930.417 68.8453 888.125 62.1914C845.833 55.5375 803.542 28.9219 761.25 38.9027C718.958 48.8836 676.667 95.4609 634.375 95.4609C592.083 95.4609 549.792 48.8836 507.5 35.5758C465.208 22.268 422.917 42.2297 380.625 38.9027C338.333 35.5758 296.042 8.96017 253.75 12.2871C211.458 15.6141 169.167 48.8836 126.875 68.8453C84.5833 88.807 42.2916 95.4609 21.1458 98.7879L0 102.115V162H21.1458C42.2916 162 84.5833 162 126.875 162C169.167 162 211.458 162 253.75 162C296.042 162 338.333 162 380.625 162C422.917 162 465.208 162 507.5 162C549.792 162 592.083 162 634.375 162C676.667 162 718.958 162 761.25 162C803.542 162 845.833 162 888.125 162C930.417 162 972.708 162 993.854 162H1015V42.2297Z"
        fill="currentColor"></path>
</g>
</svg>

<footer class="footer bg-dark text-white position-relative">
<a href="#top" data-scroll class="d-flex position-absolute end-0 bottom-0 mb-4 me-4 z-index-1">
    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
    </svg>
</a>
<div class="container pb-8 pt-8">
    <div class="row justify-content-lg-between">
        <div class="col-lg-4 me-auto col-md-10 mb-5">
            <h5 class="mb-4">
                Subscribe and stay up to date
            </h5>
            <form>
                <div class="d-flex flex-column mb-3">
                    <div class="mb-2">
                        <input type="email" class="form-control w-100 border-0 form-control-lg shadow-none"
                            placeholder="Enter your Email" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg btn-hover-scale">
                            <span>Submit</span>
                        </button>
                    </div>
                </div>
            </form>
            <p class="mb-0 small text-muted">
                We'll never share your email.
            </p>
        </div>
        <div class="col-lg-3 me-auto me-md-0 col-sm-6 col-md-5 mb-4">
            <ul class="list-unstyled mb-0">
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Home
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        About us
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        News
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Events
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Career
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Customers
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Support
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-6 mb-4">
            <ul class="list-unstyled mb-0">
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Menu
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Dessert
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Drink & Wine
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Shop
                    </a>
                </li>

                <li class="mb-3">
                    <a href="#" class="mb-0">
                        Reservation
                    </a>
                </li>
                <li>
                    <a href="#" class="mb-0">
                        Catering
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div
        class="border-top pt-4 text-center d-md-flex justify-content-md-between align-items-center">
        <ul class="list-inline mb-4 mb-md-0">
            <li class="list-inline-item"><a href="#!">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 512 512">
                        <path
                            d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221v-49.36c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42.02h62.12l-9.92 64.77h-52.2v156.53C398.1 461.85 480 369.18 480 257.35z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </a></li>
            <li class="list-inline-item ms-2"><a href="#!">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 512 512">
                        <path
                            d="M496 109.5a201.8 201.8 0 01-56.55 15.3 97.51 97.51 0 0043.33-53.6 197.74 197.74 0 01-62.56 23.5A99.14 99.14 0 00348.31 64c-54.42 0-98.46 43.4-98.46 96.9a93.21 93.21 0 002.54 22.1 280.7 280.7 0 01-203-101.3A95.69 95.69 0 0036 130.4c0 33.6 17.53 63.3 44 80.7A97.5 97.5 0 0135.22 199v1.2c0 47 34 86.1 79 95a100.76 100.76 0 01-25.94 3.4 94.38 94.38 0 01-18.51-1.8c12.51 38.5 48.92 66.5 92.05 67.3A199.59 199.59 0 0139.5 405.6a203 203 0 01-23.5-1.4A278.68 278.68 0 00166.74 448c181.36 0 280.44-147.7 280.44-275.8 0-4.2-.11-8.4-.31-12.5A198.48 198.48 0 00496 109.5z">
                        </path>
                    </svg>
                </a></li>
            <li class="list-inline-item ms-2"><a href="#!">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 512 512">
                        <path
                            d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z">
                        </path>
                        <path
                            d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z">
                        </path>
                    </svg>
                </a></li>
        </ul>
        <small class="d-block text-muted">© Copyright <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
           document.write(new Date().getFullYear())

       </script>. All right reserved. Resto</small>
    </div>
</div>
</footer>

      {{-- Script --}}
      @include(Config::get('routing.application.modules.landing.layout').'.footer.script.index')

    </body>
    <!-- end body -->

</html>
<!-- end html -->
