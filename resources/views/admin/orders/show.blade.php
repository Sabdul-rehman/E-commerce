<x-app-layout>
    <style>
        .order-view-main {
            background: radial-gradient(circle at top right, #e0f2fe 0%, #f8fafc 45%, #f1f5f9 100%);
        }

        .order-view-title {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .order-view-sub {
            margin: 0.25rem 0 0;
            color: #475569;
            font-size: 0.92rem;
        }

        .summary-card {
            border: 0;
            border-radius: 16px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.16);
            height: 100%;
        }

        .summary-card .card-body {
            padding: 1rem;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .summary-label {
            margin: 0;
            font-size: 0.82rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.95;
        }

        .summary-value {
            margin: 0.3rem 0 0;
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .summary-icon svg {
            width: 20px;
            height: 20px;
            stroke: #fff;
        }

        .summary-customer { background: linear-gradient(135deg, #2563eb, #06b6d4); }
        .summary-status { background: linear-gradient(135deg, #7c3aed, #ec4899); }
        .summary-total { background: linear-gradient(135deg, #059669, #10b981); }

        .details-card,
        .items-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.1);
        }

        .detail-chip {
            border: 1px solid #e2e8f0;
            background: #fff;
            border-radius: 12px;
            padding: 0.8rem 0.9rem;
            height: 100%;
        }

        .detail-label {
            display: block;
            color: #64748b;
            font-size: 0.78rem;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            font-weight: 700;
        }

        .detail-value {
            color: #0f172a;
            font-weight: 700;
            margin: 0;
        }
    </style>
    <div class="d-flex" style="min-height:100vh;">
        @include('public.partials.sidebar')

        <div class="flex-grow-1 p-4 order-view-main">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="order-view-title">Order Details</h3>
                    <p class="order-view-sub">{{ $order->order_number }}</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Back</a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="summary-card summary-customer card">
                        <div class="card-body">
                            <div class="summary-top">
                                <p class="summary-label">Customer</p>
                                <span class="summary-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                        <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm-7 7a7 7 0 0 1 14 0"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="summary-value">{{ $order->customer_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="summary-card summary-status card">
                        <div class="card-body">
                            <div class="summary-top">
                                <p class="summary-label">Status</p>
                                <span class="summary-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                        <path d="M4 12l4.5 4.5L20 5"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="summary-value">{{ ucfirst($order->status) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="summary-card summary-total card">
                        <div class="card-body">
                            <div class="summary-top">
                                <p class="summary-label">Order Total</p>
                                <span class="summary-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                        <path d="M12 2v20M7 7.5C7 5.6 8.8 4 11.2 4H13c2.2 0 4 1.4 4 3.2 0 1.9-1.3 2.8-4 3.5l-2 .5c-2.7.7-4 1.6-4 3.5 0 1.8 1.8 3.3 4 3.3h1.8c2.4 0 4.2-1.6 4.2-3.5"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="summary-value">Rs {{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card details-card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">Customer</small>
                                <p class="detail-value">{{ $order->customer_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">Phone</small>
                                <p class="detail-value">{{ $order->customer_phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">City</small>
                                <p class="detail-value">{{ $order->shipping_city }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="detail-chip">
                                <small class="detail-label">Shipping Address</small>
                                <p class="detail-value">{{ $order->shipping_address ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">Payment</small>
                                <p class="detail-value">{{ $order->payment_method }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">Status</small>
                                <p class="detail-value">{{ ucfirst($order->status) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-chip">
                                <small class="detail-label">Total</small>
                                <p class="detail-value">Rs {{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card items-card">
                <div class="card-header bg-white">
                    <strong>Items</strong>
                </div>
                <div class="table-responsive p-2 pt-0">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-light">
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
