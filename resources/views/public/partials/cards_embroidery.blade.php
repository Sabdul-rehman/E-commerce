@foreach($products as $productItem)
    @php
        $images = json_decode($productItem->image) ?? [];
    @endphp
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="product-card">
            <div id="productCarousel{{ $loop->index }}" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach($images as $key => $img)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('image/categories_image/' . $img) }}" class="d-block w-100"
                                alt="Product Image {{ $key + 1 }}">
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button"
                    data-bs-target="#productCarousel{{ $loop->index }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button"
                    data-bs-target="#productCarousel{{ $loop->index }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>

            <div class="product-card-body mt-2 text-center">
                <h5>{{ $productItem->product_name }}</h5>
                <p>Rs {{ $productItem->price }}</p>
                <a href="{{ route('shop.show', $productItem->Cid) }}" class="btn btn-outline-danger">Shop Now</a>
            </div>
        </div>
    </div>
@endforeach
