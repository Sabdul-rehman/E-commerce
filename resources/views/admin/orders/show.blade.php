<x-app-layout>
    <div class="d-flex" style="min-height:100vh;">
        @include('public.partials.sidebar')

        <div class="flex-grow-1 p-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Order Details</h3>
                    <p class="text-muted mb-0">{{ $order->order_number }}</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Back</a>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Customer</small>
                            <strong>{{ $order->customer_name }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Phone</small>
                            <strong>{{ $order->customer_phone }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">City</small>
                            <strong>{{ $order->shipping_city }}</strong>
                        </div>
                        <div class="col-md-12">
                            <small class="text-muted d-block">Shipping Address</small>
                            <strong>{{ $order->shipping_address ?? '-' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Payment</small>
                            <strong>{{ $order->payment_method }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Status</small>
                            <strong>{{ ucfirst($order->status) }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Total</small>
                            <strong>Rs {{ number_format($order->total_amount, 2) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <strong>Items</strong>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->product_name_snapshot }}</td>
                                    <td>{{ $item->size ?? '-' }}</td>
                                    <td>{{ $item->type ?? '-' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rs {{ number_format($item->price_snapshot, 2) }}</td>
                                    <td>Rs {{ number_format($item->line_total, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
