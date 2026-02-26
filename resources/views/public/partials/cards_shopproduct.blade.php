@foreach ($products as $productItem)
<div class="col-lg-3 col-md-4 col-sm-6">
    @php
        $images = json_decode($productItem->image) ?? [];
        $firstImage = $images[0] ?? null;
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
