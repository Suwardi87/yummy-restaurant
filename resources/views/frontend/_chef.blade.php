<section id="chefs" class="chefs section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>chefs</h2>
      <p><span>Our</span> <span class="description-title">Proffesional Chefs<br></span></p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        @foreach ($chefs as $key => $chef)
        <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('storage/' . $chef->photo) }}" class="img-fluid" alt="">
                <div class="social">
                  <a href="{{ $chef->linkedin_link}}"><i class="bi bi-linkedin"></i></a>
                  <a href="{{ $chef->instagram_link }}"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{ $chef->name }}</h4>
                <span>{{ $chef->position }}</span>
                <p>{{ $chef->description }}</p>
              </div>
            </div>
          </div><!-- End Chef Team Member -->
        @endforeach

      </div>

    </div>

  </section>
