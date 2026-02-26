<x-app-layout>
<div class="d-flex" style="min-height:100vh;">

                @include('public.partials.sidebar')


    
    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light">
        <!-- Header + Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard</h2>
            <input type="text" class="form-control w-auto" placeholder="Search...">
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Orders</h6>
                        <h3>{{$orderCount}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Revenue</h6>
                        <h3>Rs 250,000</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Categories</h6>
                        <h3>{{ $categoryCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Cart Records</h6>
                        <h3>{{ $cartCount }}</h3>
                    </div>
                </div>
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
