<!-- section introduction -->
<section class="pt-5 mt-5">

  <!-- title -->
  <h2 class="d-none">heading</h2>
  <!-- end title -->

  <!-- container -->
  <div class="container-fluid pt-5">
    <div class="row align-items-center text-center">

      <div class="col-lg-4 col-md-12 p-0 order-lg-2">
        <div class="hover-effect">
          <img alt="about" src="{{ asset($asset['avatar'].'index.png') }}" class="about-img" style="width:200px">
        </div>
      </div>

        <div class="col-lg-8 col-md-12">
            <div class="skill-box">
                <div class="main-title mb-5 text-md-left wow fadeIn" data-wow-delay="300ms">
                    <h5> About us </h5>
                    <h2> {{ $data['researcher']['main']->full_name }}</h2>
                    <p> Hoxan is a design studio founded in London. Nowadays, we've grown and expanded our services, and have become a multinational firm, offering a variety of services and solutions Worldwide. </p>
                </div>
                
            </div>
        </div>
    </div>
  </div>
  <!-- end container -->

</section>
<!-- end section introduction -->
