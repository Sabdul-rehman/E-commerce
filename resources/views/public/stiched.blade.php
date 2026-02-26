@include('public.partials.navbar')



<div class="container-fluid px-5">

    <!-- Page Header -->
    <div class="page-header">
        <h1>Stitched Collection</h1>
        <p class="text-muted">Explore our latest stitched designs</p>
    </div>

    <!-- Filters & Search -->

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- Left: Search bar -->
        <div class="d-flex" style="flex: 1; max-width: 350px; gap: 0.2rem;">
            <input type="text" class="form-control" placeholder="Search Products...">
            <button class="btn btn-dark">Search</button>
        </div>

        <!-- Right: Filter dropdown -->
        <div style="flex: 1; max-width: 125px; text-align: right;">
            <select class="form-select">
                <option selected>Filter By</option>
                <option>Discount</option>
                <option>Embroidery</option>
                <option>Low to High</option>
                <option>High to Low</option>
            </select>
        </div>
    </div>
    
    <!-- Product Cards Grid -->
    <div class="row g-2">
        @foreach($products as $productItem)
   
        <!-- Card 1 -->
        @php
         $images = json_decode($productItem->image) ?? [];
         $types = json_decode($productItem->type) ?? [];
        @endphp
            @if(in_array('Stitched', $types))

        <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="product-card">
                    <!-- Carousel Start -->

                    <div id="productCarousel{{ $loop->index }}"  class="carousel slide"  data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach($images as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('image/categories_image/' . $img) }}" class="d-block w-100"
                                        alt="Product Image {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#productCarousel{{ $loop->index }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#productCarousel{{ $loop->index }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- Carousel 1 End -->

                    <div class="product-card-body mt-2 text-center">
                        <h5>{{ $productItem->product_name }}</h5>
                        <p>Rs {{ $productItem->price }}</p>
                        <a href="{{ route('shop.show', $productItem->Cid) }}"
                            class="btn btn-outline-danger">Shop Now</a>
                    </div>
                </div>
            </div>


    @endif
            @endforeach
        </div>
</div>
<!-- Pagination links yahan lagao -->
<div class="pagination-wrapper d-flex justify-content-center mt-5">
    {{ $products->links() }}
</div>
<br>
@include('public.partials.footer');