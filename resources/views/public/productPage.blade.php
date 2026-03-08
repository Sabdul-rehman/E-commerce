@include('public.partials.navbar')

<div class="single-product-page py-5">
    <div class="container">
        @if(session('review_status'))
            <div class="alert alert-success review-alert mb-4">
                {{ session('review_status') }}
            </div>
        @endif

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
                                    data-bs-target="#productImageSlider{{ $loop->index }}" data-bs-slide-to="{{ $key }}">
                            @endforeach
                        </div>
                    </div>
                </div>  

                <!-- ✅ FORM START -->
                <div class="col-lg-6">
                    <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart">
                        @csrf

                        <!-- Hidden Product Info -->
                        <input type="hidden" name="product_id" value="{{ $productItem->Cid  }}">
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
                                <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="product-buttons d-flex gap-3">

                            
                                <button type="submit" class="btn btn-dark px-4 add-btn">
                                    Add to Cart
                                </button>

                          



                            <button type="submit" name="buy_now" value="1" class="btn btn-outline-dark px-4">
                                Buy Now
                            </button>
                            <!-- View Button -->
                            <button type="button" class="btn btn-outline-info px-4" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $productItem->Cid }}">
                                View
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="viewModal{{ $productItem->Cid }}" tabindex="-1"
                                aria-labelledby="viewModalLabel{{ $productItem->Cid }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $productItem->Cid }}">
                                                {{ $productItem->product_name }} Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @php
                                                        $image = json_decode($productItem->image);
                                                    @endphp
                                                    @if($productItem->image)
                                                        <img src="{{ asset('image/categories_image/' . $image[0]) }}"
                                                            class="img-fluid rounded" alt="{{ $productItem->product_name }}"
                                                            height="100%">
                                                    @else
                                                        <p>No Image</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><strong>Price:</strong> Rs
                                                            {{ $productItem->price }}
                                                        </li>
                                                        <li class="list-group-item"><strong>Old Price:</strong> Rs
                                                            {{ $productItem->old_price ?? 'N/A' }}
                                                        </li>
                                                        <li class="list-group-item"><strong>Description:</strong>
                                                            {{ $productItem->description }}</li>
                                                        <li class="list-group-item"><strong>Size:</strong>
                                                            {{ $productItem->size }}</li>
                                                        <li class="list-group-item"><strong>Type:</strong>
                                                            {{ $productItem->type }}</li>
                                                        <li class="list-group-item"><strong>Quantity:</strong>
                                                            {{ $productItem->quantity }}</li>
                                                        <li class="list-group-item"><strong>Category:</strong>
                                                            {{ $productItem->category }}</li>
                                                        <li class="list-group-item"><strong>Availability:</strong>
                                                            {{ $productItem->availability }}</li>
                                                        <li class="list-group-item"><strong>SKU:</strong>
                                                            {{ $productItem->sku }}</li>
                                                        <li class="list-group-item"><strong>Fabric:</strong>
                                                            {{ $productItem->fabric ?? 'N/A' }}</li>
                                                        <li class="list-group-item"><strong>Style Detail:</strong>
                                                            {{ $productItem->style_detail ?? 'N/A' }}</li>
                                                        <li class="list-group-item"><strong>Care:</strong>
                                                            {{ $productItem->care ?? 'N/A' }}</li>
                                                        <li class="list-group-item"><strong>Color:</strong>
                                                            {{ $productItem->color ?? 'N/A' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
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
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#description{{ $loop->index }}">
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

            @php
                $reviews = $productItem->approvedReviews->sortByDesc('created_at')->values();
                $reviewCount = $reviews->count();
                $averageRating = $reviewCount ? round($reviews->avg('rating'), 1) : 0;
                $ratingPercentage = $reviewCount ? ($averageRating / 5) * 100 : 0;
                $userReview = auth()->check() ? $productItem->reviews->firstWhere('user_id', auth()->id()) : null;
            @endphp

            <div class="reviews-section mt-5">
                <div class="reviews-head d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1">Customer Reviews</h4>
                        <p class="text-muted mb-0">Real feedback from verified users of Zyra Atelier.</p>
                    </div>
                    <div class="reviews-summary">
                        <div class="reviews-rating-number">{{ number_format($averageRating, 1) }}/5</div>
                        <div class="reviews-stars-track">
                            <span class="reviews-stars-fill" style="width: {{ $ratingPercentage }}%;">★★★★★</span>
                            <span class="reviews-stars-base">★★★★★</span>
                        </div>
                        <small class="text-muted">{{ $reviewCount }} {{ $reviewCount === 1 ? 'review' : 'reviews' }}</small>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-lg-5">
                        <div class="review-form-card">
                            <h5 class="mb-3">{{ $userReview ? 'Update Your Review' : 'Write a Review' }}</h5>

                            @auth
                                <form action="{{ route('shop.review.store', $productItem->Cid) }}" method="POST">
                                    @csrf
                                    @if($userReview && $userReview->status === 'pending')
                                        <div class="alert alert-warning py-2 mb-3">
                                            Your latest review is pending admin approval.
                                        </div>
                                    @elseif($userReview && $userReview->status === 'rejected')
                                        <div class="alert alert-danger py-2 mb-3">
                                            Your previous review was rejected. You can submit an updated review.
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="rating-{{ $productItem->Cid }}" class="form-label">Rating</label>
                                        <select id="rating-{{ $productItem->Cid }}" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                            <option value="">Select rating</option>
                                            @for($star = 5; $star >= 1; $star--)
                                                <option value="{{ $star }}" {{ (string)old('rating', optional($userReview)->rating) === (string)$star ? 'selected' : '' }}>
                                                    {{ $star }} Star{{ $star > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment-{{ $productItem->Cid }}" class="form-label">Comment</label>
                                        <textarea id="comment-{{ $productItem->Cid }}" name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror" placeholder="Share your experience with quality, fitting, and delivery...">{{ old('comment', optional($userReview)->comment) }}</textarea>
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-dark px-4">Submit Review</button>
                                </form>
                            @else
                                <p class="text-muted mb-3">Login required to post a review for this product.</p>
                                <a href="{{ route('frontend.login') }}" class="btn btn-outline-dark px-4">Login to Review</a>
                            @endauth
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="review-list-card">
                            @forelse($reviews as $review)
                                <article class="review-item">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <h6 class="mb-1">{{ $review->user->name ?? 'Customer' }}</h6>
                                            <div class="review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="{{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $review->created_at?->format('d M Y') }}</small>
                                    </div>
                                    @if($review->comment)
                                        <p class="mb-0 mt-2">{{ $review->comment }}</p>
                                    @endif
                                </article>
                            @empty
                                <div class="empty-reviews">
                                    <p class="mb-0">No reviews yet. Be the first to review this product.</p>
                                </div>
                            @endforelse
                        </div>
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

{{-- sweet alert --}}

<script>
 document.querySelectorAll('.add-to-cart').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Added to Cart!',
            text: 'Product added successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {

            form.submit();

        });

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
