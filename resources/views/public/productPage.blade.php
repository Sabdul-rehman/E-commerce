@include('public.partials.navbar')

<div class="single-product-page py-5">
    <div class="container">

        @foreach($products as $productItem)

        <div class="row g-5">

            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-image-box">
                    @php
                        $images = json_decode($productItem->image) ?? [];
                    @endphp

                    <div id="productImageSlider{{ $loop->index }}" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach($images as $key => $img)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('image/categories_image/' . $img) }}"
                                         class="d-block w-100 product-main-img">
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#productImageSlider{{ $loop->index }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon custom-arrow"></span>
                        </button>

                        <button class="carousel-control-next" type="button"
                                data-bs-target="#productImageSlider{{ $loop->index }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon custom-arrow"></span>
                        </button>
                    </div>

                    <div class="product-thumbs mt-3">
                        @foreach($images as $key => $img)
                            <img src="{{ asset('image/categories_image/' . $img) }}"
                                 class="thumb {{ $loop->first ? 'active' : '' }}"
                                 data-bs-target="#productImageSlider{{ $loop->index }}"
                                 data-bs-slide-to="{{ $key }}">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ✅ FORM START -->
            <div class="col-lg-6">
                <form action="{{ route('cart') }}" method="POST">
                    @csrf

                    <!-- Hidden Product Info -->
                    <input type="hidden" name="product_id" value="{{ $productItem->id }}">
                    <input type="hidden" name="price" value="{{ $productItem->price }}">

                    <h3 class="product-title">{{ $productItem->product_name }}</h3>

                    <p class="product-price">
                        Rs {{ $productItem->price }}
                        Rs<span class="old-price text-decoration-line-through text-muted">
                            {{ $productItem->old_price }}</span>
                    </p>

                    <p class="product-desc">
                        {{ $productItem->description }}
                    </p>

                    <!-- Options -->
                    <div class="product-options">

                        <div class="mb-3">
                            <label class="form-label">Size</label>
                            <select class="form-select" name="size" required>
                                <option value="">Select Size</option>
                                @foreach(json_decode($productItem->size ?? '[]') as $size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                @foreach(json_decode($productItem->type ?? '[]') as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity"
                                   class="form-control" value="1" min="1" required>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="product-buttons d-flex gap-3">
                        <button type="submit" class="btn btn-dark px-4">
                            Add to Cart
                        </button>

                        <button type="submit" name="buy_now" value="1"
                                class="btn btn-outline-dark px-4">
                            Buy Now
                        </button>
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta mt-4">
                        <p><strong>Category:</strong> {{ $productItem->category }}</p>
                        <p><strong>Availability:</strong> {{ $productItem->availability }}</p>
                        <p><strong>SKU:</strong> {{ $productItem->sku }}</p>
                    </div>

                </form>
            </div>
            <!-- ✅ FORM END -->

        </div>

        <!-- Tabs Section -->
        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description{{ $loop->index }}">
                        Description
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details{{ $loop->index }}">
                        Additional Details
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping{{ $loop->index }}">
                        Shipping & Returns
                    </button>
                </li>
            </ul>

            <div class="tab-content p-4 bg-white shadow-sm">

                <div class="tab-pane fade show active" id="description{{ $loop->index }}">
                    <p>{{ $productItem->description }}</p>
                </div>

                <div class="tab-pane fade" id="details{{ $loop->index }}">
                    <ul>
                        <li>Fabric: {{ $productItem->fabric }}</li>
                        <li>Style: {{ implode(', ', json_decode($productItem->type ?? '[]')) }}</li>
                        <li>Care: {{ $productItem->care }}</li>
                        <li>Color: {{ $productItem->color }}</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="shipping{{ $loop->index }}">
                    <p>
                        Nationwide delivery within 3 to 5 working days.
                        Easy return or exchange within 7 days of delivery.
                    </p>
                </div>

            </div>
        </div>

        @endforeach

    </div>
</div>



<script>
    document.querySelectorAll('.product-thumbs .thumb').forEach((thumb, index) => {
        thumb.addEventListener('click', function () {
            let carousel = document.querySelector('#productImageSlider');
            let bsCarousel = bootstrap.Carousel.getOrCreateInstance(carousel);
            bsCarousel.to(index);

            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>


{{-- ZOOM image --}}
<script>
    const images = document.querySelectorAll('.product-main-img');

    images.forEach(img => {
        img.addEventListener('mousemove', function (e) {
            const rect = img.getBoundingClientRect();
            const x = e.clientX - rect.left; // mouse X inside image
            const y = e.clientY - rect.top;  // mouse Y inside image

            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;

            img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            img.style.transform = 'scale(2.2)'; // zoom amount
        });

        img.addEventListener('mouseleave', function () {
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)'; // reset
        });
    });

</script>
@include('public.partials.footer');