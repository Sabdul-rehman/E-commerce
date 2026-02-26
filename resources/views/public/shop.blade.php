@include('public.partials.navbar')

<section class="py-5 bg-light">
    <div class="container">

        <!-- Heading -->
        <h2 class="text-center mb-3 fw-bold text-uppercase" style="letter-spacing: 1px; color: #333;">
            Shop Our Exclusive Collection
        </h2>
        <p class="text-center mb-5 text-muted" style="max-width: 700px; margin: 0 auto; line-height: 1.6;">
            Discover handpicked styles, timeless designs, and quality products crafted to elevate your everyday look.
            Explore our latest arrivals and find something special for every occasion.
        </p>


        <!-- Search + Filter -->
        <div class="row mb-4 align-items-center">

            <!-- Search -->
            <div class="col-md-8">
                <div class="input-group" style="width: 50%;">
                    <input type="text" class="form-control" placeholder="Search products...">
                    <button class="btn btn-danger">Search</button>
                </div>
            </div>

            <!-- Filter (same simple style) -->
            <div class="col-md-4 text-end">
                <select class="form-select w-auto d-inline">
                    <option selected>Filter</option>
                    <option value="low">Price: Low to High</option>
                    <option value="high">Price: High to Low</option>
                    <option value="new">Newest</option>
                </select>
            </div>

        </div>


        <!-- Cards -->
        {{-- <div class="row g-2">
            @foreach ($products as $productItem)
            <div class="col-lg-3 col-md-4 col-sm-6">
                @php
                $images = json_decode($productItem->image) ?? [];
                $firstImage = $images[0] ?? null; // pehli image
                @endphp
                <div class="shop-card">
                    @if($firstImage)
                    <img src="{{ asset('image/categories_image/' . $firstImage) }}" alt="">
                    @endif
                    <div class="shop-card-body">
                        <h5>{{ $productItem->product_name }}</h5>
                        <p>Rs {{ $productItem->price }}</p>
                        <a href="/shop/{{ $productItem->Cid }}" class="btn btn-outline-danger w-100">Shop Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div> --}}
        <div class="row g-2" id="shop-product-container">
            @include('public.partials.cards_shopproduct')
        </div>
    </div>
</section>


<div class="text-center m-3">
    <button id="shop-load-more-btn" class="btn btn-dark px-4 py-2">
        Load More
    </button>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- ajax for load more --}}

<script>
    let page = 1;

    $('#shop-load-more-btn').click(function () {
        page++;

        $.ajax({
            url: "?page=" + page,
            type: "GET",
            beforeSend: function () {
                $('#shop-load-more-btn').text('Loading...');
            },
            success: function (response) {

                if (response.trim() == '') {
                    $('#shop-load-more-btn').text('No More Products');
                    $('#shop-load-more-btn').prop('disabled', true);
                    return;
                }   

                $('#shop-product-container').append(response);
                $('#shop-load-more-btn').text('Load More');
            }
        });

    });
</script>



@include('public.partials.footer')