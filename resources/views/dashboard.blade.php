<x-app-layout>
<style>
    .dashboard-main {
        background: radial-gradient(circle at top right, #e0f2fe 0%, #f8fafc 45%, #f1f5f9 100%);
    }

    .dashboard-title {
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .dashboard-subtitle {
        color: #475569;
        font-size: 0.92rem;
        margin: 0.25rem 0 0;
    }

    .metric-card {
        position: relative;
        border: 0;
        border-radius: 16px;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.16);
    }

    .metric-card .card-body {
        padding: 1rem 1rem 1.1rem;
    }

    .metric-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .metric-label {
        margin: 0;
        font-size: 0.82rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        font-weight: 700;
        opacity: 0.95;
    }

    .metric-value {
        margin: 0.25rem 0 0;
        font-size: 1.65rem;
        font-weight: 800;
        line-height: 1.1;
    }

    .metric-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .metric-icon svg {
        width: 22px;
        height: 22px;
        stroke: #fff;
    }

    .metric-orders {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
    }

    .metric-revenue {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .metric-categories {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .metric-carts {
        background: linear-gradient(135deg, #7c3aed, #ec4899);
    }
</style>
<div class="d-flex" style="min-height:100vh;">

                @include('public.partials.sidebar')


    
    <!-- Main Content -->
    <div class="flex-grow-1 p-4 dashboard-main">
        <!-- Header + Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="dashboard-title">Dashboard Overview</h2>
                <p class="dashboard-subtitle">Track orders, categories and cart activity in one place.</p>
            </div>
            <input type="text" class="form-control w-auto" placeholder="Search...">
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card metric-card metric-orders">
                    <div class="card-body">
                        <div class="metric-header">
                            <h6 class="metric-label">Total Orders</h6>
                            <span class="metric-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                    <path d="M4 7h16M7 3v4m10-4v4M5 11h14v9H5z"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="metric-value">{{$orderCount}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card metric-card metric-revenue">
                    <div class="card-body">
                        <div class="metric-header">
                            <h6 class="metric-label">Revenue</h6>
                            <span class="metric-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                    <path d="M12 2v20M7 7.5C7 5.6 8.8 4 11.2 4H13c2.2 0 4 1.4 4 3.2 0 1.9-1.3 2.8-4 3.5l-2 .5c-2.7.7-4 1.6-4 3.5 0 1.8 1.8 3.3 4 3.3h1.8c2.4 0 4.2-1.6 4.2-3.5"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="metric-value">Rs 250,000</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card metric-card metric-categories">
                    <div class="card-body">
                        <div class="metric-header">
                            <h6 class="metric-label">Total Categories</h6>
                            <span class="metric-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                    <path d="M3 6h8v5H3zM13 6h8v5h-8zM3 13h8v5H3zM13 13h8v5h-8z"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="metric-value">{{ $categoryCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card metric-card metric-carts">
                    <div class="card-body">
                        <div class="metric-header">
                            <h6 class="metric-label">Total Cart Records</h6>
                            <span class="metric-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                    <circle cx="9" cy="20" r="1.6"/>
                                    <circle cx="18" cy="20" r="1.6"/>
                                    <path d="M2.5 4h2.4l2.2 11h11.4l2-8.5H6.2"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="metric-value">{{ $cartCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card metric-card" style="background: linear-gradient(135deg, #be123c, #fb7185);">
                    <div class="card-body">
                        <div class="metric-header">
                            <h6 class="metric-label">Pending Reviews</h6>
                            <span class="metric-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.9">
                                    <path d="M4 5h16v10H7l-3 3z"/>
                                    <path d="M8 9h8M8 12h6"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="metric-value">{{ $pendingReviewCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Review Approval Queue</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingReviews as $index => $review)
                            <tr>
                                <td class="fw-semibold">{{ $index + 1 }}</td>
                                <td>{{ $review->product->product_name ?? 'Product' }}</td>
                                <td>{{ $review->user->name ?? 'Customer' }}</td>
                                <td>{{ $review->rating }}/5</td>
                                <td>{{ \Illuminate\Support\Str::limit($review->comment, 80, '...') ?: 'No comment' }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($review->created_at)->format('d M Y') }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No pending reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

       <div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Orders Management</h5>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.orders.history') }}" class="btn btn-sm btn-outline-secondary">
                Order History
            </a>
            <input type="text" class="form-control form-control-sm" placeholder="Search order...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0 table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $index => $order)
                <tr>
                    <td class="fw-semibold">
                        {{ $orders->firstItem() + $index }}
                    </td>

                    <td>
                        <span class="fw-bold text-dark">
                            {{ $order->order_number }}
                        </span>
                    </td>

                    <td>
                        <div class="fw-semibold">{{ $order->customer_name }}</div>
                        <small class="text-muted">
                            {{ $order->customer_email ?? '—' }}
                        </small>
                    </td>

                    <td>{{ $order->customer_phone }}</td>

                    <td>
                        <span class="badge bg-light text-dark border">
                            {{ $order->shipping_city }}
                        </span>
                    </td>

                    <td>
                        <span class="fw-semibold">
                            {{ $order->items_count ?? $order->items->count() }}
                        </span>
                    </td>

                    <td class="fw-bold text-success">
                        Rs {{ number_format($order->total_amount, 2) }}
                    </td>

                    <td>
                        @if($order->payment_method == 'COD')
                            <span class="badge bg-warning text-dark">COD</span>
                        @else
                            <span class="badge bg-success">{{ $order->payment_method }}</span>
                        @endif
                    </td>

                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'dispatched' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td>
                        <small class="text-muted">
                            {{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d M Y') }}
                        </small>
                    </td>

                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-1">

                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye">View</i>
                            </a>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dispatched" {{ $order->status === 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="removed" {{ $order->status === 'removed' ? 'selected' : '' }}>Removed</option>
                                </select>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-4 text-muted">
                        No orders found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-white">
        {{ $orders->links() }}
    </div>
</div>
    </div>
</div>
</x-app-layout>
