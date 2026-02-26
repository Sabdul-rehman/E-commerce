@include('public.partials.navbar')

<div class="checkout-page py-5">
    <div class="container">

        <h3 class="mb-4">Checkout</h3>

        <form action="{{ route('checkoutStore') }}" method="POST">
            @csrf

            @if ($errors->has('checkout'))
                <div class="alert alert-danger">
                    {{ $errors->first('checkout') }}
                </div>
            @endif

            <div class="row g-4">

                <!-- Billing Details -->
                <div class="col-lg-7">
                    <div class="checkout-box">

                        <h5 class="mb-3">Billing Details</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required>
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email (optional)">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="4" placeholder="Complete Address" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City" required>
                            @error('city')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="checkout-box">

                        <h5 class="mb-3">Your Order</h5>

                        <ul class="order-summary">
                            @foreach($cartItems as $item)
                            <li>
                               {{ $item->product->product_name }}
                                <span>Rs {{ number_format($item->product->price * $item->quantity, 0) }}</span>
                            </li>
                            @endforeach
                            <li>
                                Delivery Charges
                                <span>@if($cartItems->sum(fn($item) => $item->product->price * $item->quantity) > 4000) 0 @else 200 @endif    
                                </span>
                            </li>
                            <li class="total">
                                Total
                                <span>Rs {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 200, 0) }}</span>
                            </li>
                        </ul>

                        <!-- Payment Method -->
                        <div class="payment-method mt-4">
                            <label class="fw-semibold">Payment Method</label>

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="COD" checked>
                                <label class="form-check-label">
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mt-4">
                            Confirm Order
                        </button>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>




@include('public.partials.footer')
