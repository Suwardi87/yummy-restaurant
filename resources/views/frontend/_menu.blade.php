<section id="menu" class="menu section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
    </div><!-- End Section Title -->

    <div class="container">

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
                    <h4>Starters</h4>
                </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
                    <h4>Breakfast</h4>
                </a><!-- End tab nav item -->

            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
                    <h4>Lunch</h4>
                </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
                    <h4>Dinner</h4>
                </a>
            </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

            <div class="tab-pane fade active show" id="menu-starters">

                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Starters</h3>
                </div>

                <div class="row gy-5">

                    @forelse ($menu_starters as $starter)
                    <div class="col-lg-4 menu-item">
                        <a href="" class="glightbox"><img src="{{ asset('storage/' . $starter->photo) }}"
                                class="menu-img img-fluid" alt=""></a>
                        <h4>{{ $starter->name }}</h4>
                        <p class="ingredients">
                            {{ $starter->description }}
                        </p>
                        <p class="price">
                            Rp. {{ number_format($starter->price, 0, ',', '.') }}
                        </p>
                    </div><!-- Menu Item -->
                    @empty
                    <div class="alert-warning text-center text-warning">No Menu Available</div>
                    @endforelse

                </div>
            </div><!-- End Starter Menu Content -->

            <div class="tab-pane fade" id="menu-breakfast">

                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Breakfast</h3>
                </div>

                <div class="row gy-5">

                    @forelse ($menu_breakfasts as $breakfast)
                    <div class="col-lg-4 menu-item">
                        <a href="" class="glightbox"><img src="{{ asset('storage/' . $breakfast->photo) }}"
                                class="menu-img img-fluid" alt=""></a>
                        <h4>{{ $breakfast->name }}</h4>
                        <p class="ingredients">
                            {{ $breakfast->description }}
                        </p>
                        <p class="price">
                            Rp. {{ number_format($breakfast->price, 0, ',', '.') }}
                        </p>
                    </div><!-- Menu Item -->
                    @empty
                    <div class="alert-warning text-center text-warning">No Menu Available</div>
                    @endforelse

                </div>
            </div><!-- End Breakfast Menu Content -->

            <div class="tab-pane fade" id="menu-lunch">

                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Lunch</h3>
                </div>

                <div class="row gy-5">

                    @forelse ($menu_lunches as $lunch)
                    <div class="col-lg-4 menu-item">
                        <a href="" class="glightbox"><img src="{{ asset('storage/' . $lunch->photo) }}"
                                class="menu-img img-fluid" alt=""></a>
                        <h4>{{ $lunch->name }}</h4>
                        <p class="ingredients">
                            {{ $lunch->description }}
                        </p>
                        <p class="price">
                            Rp. {{ number_format($lunch->price, 0, ',', '.') }}
                        </p>
                    </div><!-- Menu Item -->
                    @empty
                    <div class="alert-warning text-center text-warning">No Menu Available</div>
                    @endforelse

                </div>
            </div><!-- End Lunch Menu Content -->

            <div class="tab-pane fade" id="menu-dinner">

                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Dinner</h3>
                </div>

                <div class="row gy-5">

                    @forelse ($menu_dinners as $dinner)
                    <div class="col-lg-4 menu-item">
                        <a href="" class="glightbox"><img src="{{ asset('storage/' . $dinner->photo) }}"
                                class="menu-img img-fluid" alt=""></a>
                        <h4>{{ $dinner->name }}</h4>
                        <p class="ingredients">
                            {{ $dinner->description }}
                        </p>
                        <p class="price">
                            Rp. {{ number_format($dinner->price, 0, ',', '.') }}
                        </p>
                    </div><!-- Menu Item -->
                    @empty
                    <div class="alert-warning text-center text-warning">No Menu Available</div>
                    @endforelse

                </div>
            </div><!-- End Dinner Menu Content -->

        </div>

    </div>

</section>
