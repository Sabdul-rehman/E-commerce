@include('public.partials.navbar')

<div class="cart-page py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h3 class="mb-4">Shopping Cart</h3>

                <!-- Desktop Table -->
                <div class="cart-box d-none d-lg-block">
                    <table class="table align-middle">
                        <thead>
                          <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty:</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr  id="cart-row-{{ $item->id }}">
                                    <td class="d-flex align-items-center gap-3">
                                        @php
                                            $images = json_decode(optional($item->product)->image) ?? [];
                                            $image = $images[0] ?? 'default.jpg';
                                        @endphp
                                        <img src="{{ asset('image/categories_image/' . $image) }}" class="cart-img">
                                        <div>
                                            <strong>{{ $item->product->product_name }}</strong>
                                            {{-- <p class="mb-0 small text-muted">Stitched</p> --}}
                                            <p>{{ $item->product->sku }}</p>
                                        </div>
                                    </td>
                                    <td>Rs {{ number_format($item->product->price, 2) }}</td>
                                    <td><input type="number" class="form-control qty-input" value="{{ $item->quantity }}">
                                    </td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td >
                                        {{-- <form action="{{ route('cart.remove', $item->id) }} " method="POST"
                                            class="remove-form">
                                            @csrf
                                            @method('DELETE') --}}

                                            <button class="btn btn-danger remove-btn" data-id="{{ $item->id }}">
                                                Remove
                                            </button>

                                            {{--
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Cards -->
            <div class="d-lg-none">
                @foreach ($cartItems as $item)
                    @php
                        $images = json_decode(optional($item->product)->image) ?? [];
                        $image = $images[0] ?? 'default.jpg';
                    @endphp
                    <div class="cart-item-mobile mb-3">
                        <div class="d-flex gap-3">
                            <img src="{{ asset('image/categories_image/' . $image) }}" class="cart-img">
                            <div class="flex-grow-1">
                                <strong>{{ $item->product->product_name }}</strong>
                                <p class="small text-muted mb-1">Stitched</p>
                                <p class="mb-1">Price: Rs {{ number_format($item->product->price, 2) }}</p>

                                <div class="d-flex align-items-center gap-2">
                                    <input type="number" class="form-control qty-input" value="{{ $item->quantity }}">
                                    <form action="{{ route('cart.remove', $item->product->Cid) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                </div>

                                <p class="mt-2 fw-semibold">
                                    Total: Rs {{ number_format($item->product->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>

            <!-- Cart Summary -->
            <div class="col-lg-3  mt-lg-0 ">
                <div class="cart-box " style="margin-top: 70px">
                    <h5 class="mb-3">Cart Summary</h5>
                    <ul class="cart-summary">
                        @php
                            $subtotal = $cartItems->sum(function ($item) {
                                return $item->product->price * $item->quantity;
                            });
                            if ($subtotal > 4000) {
                                $delivery = '0.00';

                            } else {

                                $delivery = 200;
                            }
                        @endphp
                        <li>Subtotal <span>Rs {{ number_format($subtotal, 2) }}</span></li>
                        <li>Delivery <span>Rs {{ number_format($delivery, 2) }}</span></li>
                        <li class="total">Total <span>Rs {{ number_format($subtotal + $delivery, 2) }}</span></li>
                    </ul>
                    <a href="{{ route('Checkout') }}" class="btn btn-dark w-100 mt-3">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.querySelectorAll('.remove-btn').forEach(button => {

    button.addEventListener('click', function(){

        let id = this.dataset.id;

        Swal.fire({
            title: 'Remove item?',
            text: 'This item will be removed from cart',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it'
        })
        .then((result) => {

            if(result.isConfirmed)
            {
                fetch(`/cart/${id}`, {

                    method: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }

                })
                .then(response => response.json())
                .then(data => {

                    if(data.success)
                    {
                        // remove instantly without refresh
                        document.getElementById('cart-row-' + id).remove();

                        Swal.fire(
                            'Removed!',
                            'Item removed successfully',
                            'success'
                        );
                    }

                });

            }

        });

    });

});
</script>


@include('public.partials.footer');