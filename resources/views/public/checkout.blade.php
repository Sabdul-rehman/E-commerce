@include('public.partials.navbar')



<div class="checkout-page py-5">
    <div class="container">

        <h3 class="mb-4">Checkout</h3>

        <form action="/place-order" method="POST">
            @csrf

            <div class="row g-4">

                <!-- Billing Details -->
                <div class="col-lg-7">
                    <div class="checkout-box">

                        <h5 class="mb-3">Billing Details</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email (optional)">
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" name="address" rows="4" placeholder="Complete Address" required></textarea>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" name="city" required>
                                <option value="">Select City</option>
                                <option>Lahore</option>
                                <option>Karachi</option>
                                <option>Islamabad</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="checkout-box">

                        <h5 class="mb-3">Your Order</h5>

                        <ul class="order-summary">
                            <li>
                                Elegant Lawn Suit × 1
                                <span>Rs 3,500</span>
                            </li>
                            <li>
                                Delivery Charges
                                <span>Rs 200</span>
                            </li>
                            <li class="total">
                                Total
                                <span>Rs 3,700</span>
                            </li>
                        </ul>

                        <!-- Payment Method -->
                        <div class="payment-method mt-4">
                            <label class="fw-semibold">Payment Method</label>

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" checked>
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