@include('public.partials.navbar')


<div class="cart-page py-5">
    <div class="container">

        <h3 class="mb-4">Shopping Cart</h3>

        <div class="row g-4">

            <!-- Cart Items -->
            <div class="col-lg-8">
@foreach ($cartItems as $item)
    

                <!-- Desktop Table -->
                <div class="cart-box d-none d-lg-block">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ $item->product->name }}</th>
                                <th>Rs {{ number_format($item->product->price, 2) }}</th>
                                <th>Qty: {{ $item->quantity }}</th>
                                <th>Rs {{ number_format($item->product->price * $item->quantity, 2) }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('image/' . $item->product->image) }}" class="cart-img">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong>
                                        <p class="mb-0 small text-muted">Stitched</p>
                                    </div>
                                </td>
                                <td>Rs {{ number_format($item->product->price, 2) }}</td>
                                <td><input type="number" class="form-control qty-input" value="{{ $item->quantity }}"></td>
                                <td>Rs {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="d-lg-none">

                    <div class="cart-item-mobile mb-3">
                        <div class="d-flex gap-3">
                            <img src="{{ asset('image/' . $item->product->image) }}" class="cart-img">
                            <div class="flex-grow-1">
                                <strong>{{ $item->product->name }}</strong>
                                <p class="small text-muted mb-1">Stitched</p>
                                <p class="mb-1">Price: Rs {{ number_format($item->product->price, 2) }}</p>

                                <div class="d-flex align-items-center gap-2">
                                    <input type="number" class="form-control qty-input" value="{{ $item->quantity }}">
                                    <button class="btn btn-sm btn-outline-danger">Remove</button>
                                </div>

                                <p class="mt-2 fw-semibold">
                                    Total: Rs {{ number_format($item->product->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
@endforeach
            <!-- Summary -->
            <div class="col-lg-4">
                <div class="cart-box">
                    <h5 class="mb-3">Cart Summary</h5>

                    <ul class="cart-summary">
                        <li>Subtotal <span>Rs 3,500</span></li>
                        <li>Delivery <span>Rs 200</span></li>
                        <li class="total">Total <span>Rs 3,700</span></li>
                    </ul>

                    <a href="/checkout" class="btn btn-dark w-100 mt-3">
                        Proceed to Checkout
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>





@include('public.partials.footer');
