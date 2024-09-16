<!-- footer -->
<footer class="footer bg-light position-relative">

    <!-- svg -->
    <svg class="position-absolute start-0 top-0 w-100 text-white flip-y" preserveAspectRatio="none" width="100%"
    height="64" viewBox="0 0 800 200" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd"
      d="M0 176L33 148C67 120 133 64 200 32C267 0 333 -8 400 8C467 24 533 64 600 96C667 128 733 152 767 164L800 176V200H767C733 200 667 200 600 200C533 200 467 200 400 200C333 200 267 200 200 200C133 200 67 200 33 200H0V176Z"
      fill="currentColor" />
    </svg>
    <!-- end svg -->

    <!-- back to top -->
    <a href="#top" data-scroll class="d-flex position-absolute end-0 bottom-0 mb-4 me-4 z-index-1">
      <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor"
      xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd"
      d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
      </svg>
    </a>
    <!-- end back to top -->

    <!-- container -->
    <div class="container pt-10 pb-6">

      <!-- row -->
      <div class="row">
        <div class="col-sm-12 text-center">
          <ul class="list-inline f-social">
            <li class="list-inline-item mx-2">
              <a href="#" class="text-muted">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 512 512">
                    <path
                        d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221v-49.36c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42.02h62.12l-9.92 64.77h-52.2v156.53C398.1 461.85 480 369.18 480 257.35z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
              </a>
            </li>
            <li class="list-inline-item mx-2"><a href="#" class="text-muted">
                <svg viewBox="0 0 512 512" fill="currentColor" width="24" height="24">
                  <path
                    d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z">
                  </path>
                  <path
                    d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z">
                  </path>
                </svg>
              </a>
            </li>
          </ul>
          <small class="d-block text-muted">© UCSI Group {{ Carbon\Carbon::now()->format("Y") }} All right reserved</small>
        </div>
      </div>
      <!-- end row -->

    </div>
    <!-- end container -->

</footer>
<!-- end footer -->
