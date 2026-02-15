{{-- <div class="bg-dark text-white text-center py-1 small top-offer">
    🚚 Free Delivery on Orders Above Rs 3000 | 📞 Support: 0300-1234567
</div> --}}

@include('public.partials.navbar')
<html>

<body>
    <button id="backToTop" aria-label="Back to top">
        ↑
    </button>



    <div class="container-fluid p-0 ">

        {{-- Banner --}}
        <div class="banner-wrap position-relative text-white">

            <!-- Background Image -->

            <img src="{{ asset('image/11.webp') }}" class="banner-bg" alt="Banner">

            <!-- Overlay for blur + darken effect -->
            <div class="banner-overlay"></div>

            <!-- Content: text + buttons -->
            <div class="banner-content text-center">
                <h1 class="mb-3">Explore Our Traditional Suits</h1>
                <p class="mb-4">Elegant Designs for Every Occasion</p>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://wa.me/923001234567" target="_blank"
                        class="btn btn-success hero-btn d-flex align-items-center gap-2 px-4 py-2 shadow">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>

                    <a href="/shop" class="btn btn-danger hero-btn d-flex align-items-center gap-2 px-4 py-2 shadow">
                        Shop Now
                    </a>
                </div>
            </div>

        </div>

    </div>

    {{-- carousel cards --}}
    <section class="featured-carousel py-5 bg-light" style="overflow-x:hidden;">
        <div class="container">
            <h2 class="text-center mb-4">Our Latest Product</h2>

            <div class="carousel-wrapper position-relative">

                <!-- Left Arrow -->
                <button class="carousel-arrow left">&#10094;</button>

                <div class="cards-viewport">
                    <div class="cards-wrapper">

                        @foreach ($products as $productItem)

                            @php
                                $homepage_choice = json_decode($productItem->homepage_choice) ?? [];
                                $images = json_decode($productItem->image) ?? [];
                            @endphp

                            @if(in_array('Featured Product', $homepage_choice) && !empty($images))

                                <div class="card-item position-relative">
                                    <img src="{{ asset('image/categories_image/' . $images[0]) }}"
                                        alt="{{ $productItem->product_name }}">

                                    <a href="/shop/{{ $productItem->Cid }}" class="btn btn-danger card-btn position-absolute">
                                        Shop Now
                                    </a>
                                </div>

                            @endif

                        @endforeach

                    </div>
                </div>

                <!-- Right Arrow -->
                <button class="carousel-arrow right">&#10095;</button>

            </div>
        </div>
    </section>

    {{-- new section --}}

    <section class="accessories-section py-5">
        <div class="container">
            <h2 class="text-center mb-5 accessories-title"> <b> Featured Collection </b></h2>

            @foreach ($products as $productItem)

                @php
                    $type = json_decode($productItem->type) ?? [];
                    $images = json_decode($productItem->image) ?? [];
                @endphp
                @if(in_array('Stitched', $type))
                @endif
            @endforeach
            <div class="row g-4">
                <!-- Left Large -->
                <div class="col-lg-4 col-md-6">
                    <div class="acc-card acc-large">
                        <img src="{{ asset('image/categories_image/' . $images[0]) }}" alt="Wraps">
                        <div class="acc-overlay">
                            <h5>Stitched</h5>
                            <a href="{{ route('stiched') }}" class="acc-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>


                <!-- Middle Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="row g-4">

                        <div class="col-12">
                            <div class="acc-card acc-small">
                                <img src="{{ asset('image/n2.jfif') }}" alt="Bags">
                                <div class="acc-overlay">
                                    <h5>View All</h5>
                                    <a href="/shop" class="acc-btn">SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                        @foreach ($products as $productItem)

                            @php
                                $type = json_decode($productItem->type) ?? [];
                                // dd($type);
                                $images = json_decode($productItem->image) ?? [];
                            @endphp
                            @if(in_array('Embroidery', $type))

                                <div class="col-12">
                                    <div class="acc-card acc-small">
                                        <img src="{{ asset('image/categories_image/' . $images[0]) }}" alt="Footwear">
                                        <div class="acc-overlay">
                                            <h5>Embroidery</h5>
                                            <a href="/shop" class="acc-btn">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                                @break; <!-- Stop after first match -->
                            @endif
                        @endforeach

                    </div>
                </div>
                @foreach ($products as $productItem)

                    @php
                        $type = json_decode($productItem->type) ?? [];
                        $images = json_decode($productItem->image) ?? [];
                    @endphp
                    @if(in_array('Unstitched', $type))
                    @endif
                @endforeach
                <!-- Right Large -->
                <div class="col-lg-4 col-md-12">
                    <div class="acc-card acc-large">
                        <img src="{{ asset('image/categories_image/' . $images[1]) }}" alt="Bottom">
                        <div class="acc-overlay">
                            <h5>Unstitched</h5>
                            <a href="{{ route('unstiched') }}" class="acc-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>



    {{-- top seller --}}

    <section class="top-seller-new py-5 bg-light" style="overflow:hidden;">
        <div class="container position-relative">
            <h2 class="text-center mb-4">Bestsellers of the Month</h2>

            <!-- Arrows -->
            <button class="ts-arrow ts-left">&#10094;</button>
            <button class="ts-arrow ts-right">&#10095;</button>

            <div class="ts-viewport">
                <div class="ts-wrapper">
                    @foreach ($products as $productItem)

                        @php
                            $homepage_choice = json_decode($productItem->homepage_choice) ?? [];
                            $images = json_decode($productItem->image) ?? [];
                            //    dd($productItem->homepage_choice);
                        @endphp

                        @if(in_array('Bestsellers of the Month', $homepage_choice) && !empty($images))

                            <div class="ts-card-wrapper">
                                <div class="top-card">
                                    <img src="{{ asset('image/categories_image/' . $images[0]) }}" alt="{{ $productItem->product_name }}">
                                    <a href="/shop/{{ $productItem->Cid }}" class="top-card-btn">Shop Now</a>
                                </div>
                                <div class="top-card-info">
                                    <h5>{{ $productItem->product_name }}</h5>
                                    <p>Rs {{ $productItem->price }}</p>
                                </div>
                            </div>

                        @endif
                        @endforeach
                    {{-- <!-- Card 1 -->
                    <div class="ts-card-wrapper">
                        <div class="top-card">
                            <img src="{{ asset('image/n11.jpg') }}" alt="Top Seller 1">
                            <a href="/shop" class="top-card-btn">Shop Now</a>
                        </div>
                        <div class="top-card-info">
                            <h5>Elegant Suit 1</h5>
                            <p>Rs 4,500</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="ts-card-wrapper">
                        <div class="top-card">
                            <img src="{{ asset('image/n9.webp') }}" alt="Top Seller 2">
                            <a href="/shop" class="top-card-btn">Shop Now</a>
                        </div>
                        <div class="top-card-info">
                            <h5>Elegant Suit 2</h5>
                            <p>Rs 3,800</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="ts-card-wrapper">
                        <div class="top-card">
                            <img src="{{ asset('image/n1.jfif') }}" alt="Top Seller 3">
                            <a href="/shop" class="top-card-btn">Shop Now</a>
                        </div>
                        <div class="top-card-info">
                            <h5>Elegant Suit 3</h5>
                            <p>Rs 5,200</p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="ts-card-wrapper">
                        <div class="top-card">
                            <img src="{{ asset('image/n2.jfif') }}" alt="Top Seller 4">
                            <a href="/shop" class="top-card-btn">Shop Now</a>
                        </div>
                        <div class="top-card-info">
                            <h5>Elegant Suit 4</h5>
                            <p>Rs 4,900</p>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>


    {{-- Reviews --}}
    <section class="testimonials-section py-5" style="  overflow-x: hidden; ">
        <div class="container text-center">
            <h2 class="text-white mb-4">Top Sellers Reviews</h2>
            <div class="testimonials-marquee">
                <div class="testimonials-track">
                    <div class="testimonial-card">
                        <img src="{{ asset('image/n9.webp') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Ali R.</h5>
                        <p class="testimonial-comment">Amazing quality suits, totally worth it!</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/n1.jfif') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Sana K.</h5>
                        <p class="testimonial-comment">Fabric aur stitching dono top class.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/n2.jfif') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Usman A.</h5>
                        <p class="testimonial-comment">Fast delivery & beautiful design.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/n3.webp') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Ayesha M.</h5>
                        <p class="testimonial-comment">Perfect fitting, will order again.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>

                    <!-- Duplicate for seamless infinite scroll -->
                    <div class="testimonial-card">
                        <img src="{{ asset('image/n11.jpg') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Ali R.</h5>
                        <p class="testimonial-comment">Amazing quality suits, totally worth it!</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/user-icon.png') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Sana K.</h5>
                        <p class="testimonial-comment">Fabric aur stitching dono top class.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/user-icon.png') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Usman A.</h5>
                        <p class="testimonial-comment">Fast delivery & beautiful design.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐</div>
                    </div>
                    <div class="testimonial-card">
                        <img src="{{ asset('image/user-icon.png') }}" alt="User" class="testimonial-icon">
                        <h5 class="testimonial-name">Ayesha M.</h5>
                        <p class="testimonial-comment">Perfect fitting, will order again.</p>
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    @include('public.partials.footer')


    </div>

    <script>

        const cardsWrapper = document.querySelector('.cards-wrapper');
        const cards = document.querySelectorAll('.card-item');
        const leftArrow = document.querySelector('.carousel-arrow.left');
        const rightArrow = document.querySelector('.carousel-arrow.right');

        let index = 0;

        function getVisibleCards() {
            return window.innerWidth <= 768 ? 1 : 2;
        }

        function updateCarousel() {
            const visible = getVisibleCards();
            const gap = 20; // same as CSS
            const cardWidth = cards[0].offsetWidth + gap;

            // move wrapper
            cardsWrapper.style.transform = `translateX(-${index * cardWidth}px)`;

            // reset active
            cards.forEach(card => card.classList.remove('active'));
            const middleIndex = index + Math.floor(visible / 2);
            if (cards[middleIndex]) cards[middleIndex].classList.add('active');
        }

        // arrow clicks
        leftArrow.onclick = () => {
            if (index > -1) index--;
            updateCarousel();
        };
        rightArrow.onclick = () => {
            if (index < cards.length - getVisibleCards()) index++;
            updateCarousel();
        };

        window.addEventListener('resize', updateCarousel);

        // initial
        updateCarousel();
    </script>



    <script>
        // const cardsWrapper = document.querySelector('.cards-wrapper');
        // const cards = document.querySelectorAll('.card-item');
        // const leftArrow = document.querySelector('.carousel-arrow.left');
        // const rightArrow = document.querySelector('.carousel-arrow.right');

        // let currentIndex = 1; // index of first visible card (0-based)
        // function getVisibleCards() {
        //     return window.innerWidth <= 768 ? 1 : 2;
        // }

        // const totalCards = cards.length;

        // function updateCarousel() {
        //     // slide using transform
        //     const gap = window.innerWidth <= 768 ? 0 : 40;
        //     const cardWidth = cards[0].offsetWidth + gap;

        //     cardsWrapper.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

        //     // update active middle card
        //     cards.forEach((card, i) => card.classList.remove('active'));
        //     const middleIndex = currentIndex + 1; // middle of 3 cards
        //     if (cards[middleIndex]) cards[middleIndex].classList.add('active');
        // }

        // // Left arrow click
        // leftArrow.addEventListener('click', () => {
        //     if (currentIndex > -1) currentIndex--;
        //     updateCarousel();
        // });

        // // Right arrow click
        // rightArrow.addEventListener('click', () => {
        //     if (currentIndex < totalCards - getVisibleCards()) currentIndex++;

        //     updateCarousel();
        // });
        // window.addEventListener('resize', updateCarousel);
        // updateCarousel(); // initial setup

    </script>

    {{-- // Two big cardss --}}


    <script>
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.animate-card').forEach(el => {
            observer.observe(el);
        });
    </script>

    {{-- back to top button --}}
    <script>
        const btn = document.getElementById("backToTop");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        });

        btn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

    {{-- topseller carousel --}}
    <script>
        const tsWrapper = document.querySelector('.ts-wrapper');
        const tsCards = document.querySelectorAll('.ts-card-wrapper');
        const tsLeft = document.querySelector('.ts-left');
        const tsRight = document.querySelector('.ts-right');

        let tsIndex = 0;

        function tsVisibleCards() {
            return window.innerWidth <= 768 ? 1 : 4;
        }

        function updateTopSeller() {
            const cardWidth = tsCards[0].offsetWidth + 20;
            tsWrapper.style.transform = `translateX(-${tsIndex * cardWidth}px)`;
        }

        tsRight.addEventListener('click', () => {
            if (tsIndex < tsCards.length - tsVisibleCards()) {
                tsIndex++;
                updateTopSeller();
            }
        });

        tsLeft.addEventListener('click', () => {
            if (tsIndex > 0) {
                tsIndex--;
                updateTopSeller();
            }
        });

        window.addEventListener('resize', updateTopSeller);

        updateTopSeller();
    </script>


</body>

</html>