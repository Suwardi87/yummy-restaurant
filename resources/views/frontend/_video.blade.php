<section id="videos" class="testimonials section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Video</h2>
      <p>See Our Restaurant in <span class="description-title">Action</span></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "spaceBetween": 20,
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 0
              },
              "768": {
                "slidesPerView": 2,
                "spaceBetween": 20
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 20
              }
            }
          }
        </script>
        <div class="swiper-wrapper">

          @forelse($videos as $video)
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="testimonial-img">
                <iframe width="100%" height="150" src="{{ $video->video_link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="footer"><h3>{{ $video->name }}</h3></div>
            </div>
          </div><!-- End testimonial item -->
          @empty

          @endforelse
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  </section>

