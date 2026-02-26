<x-app-layout>
    <div class="d-flex" style="min-height:100vh;">
        @include('public.partials.sidebar')

        <div class="flex-grow-1 p-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Removed Orders History</h3>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm border-0">
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
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $index => $order)
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'dispatched' => 'info',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                        'removed' => 'secondary',
                                    ];
                                @endphp
                                <tr id="order-row-{{ $order->id }}">
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td class="fw-semibold">{{ $order->order_number }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_phone }}</td>
                                    <td>{{ $order->shipping_city }}</td>
                                    <td>{{ $order->items_count }}</td>
                                    <td class="fw-bold text-success">Rs {{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <form action="{{ route('admin.orders.restore', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger js-permanent-delete"
                                                data-order-id="{{ $order->id }}"
                                                data-order-number="{{ $order->order_number }}"
                                                data-delete-url="{{ route('admin.orders.forceDelete', $order->id) }}">
                                                Delete Permanently
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">No removed orders found.</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('table tbody');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!tableBody || !csrfToken) return;

        tableBody.addEventListener('click', async function (event) {
            const button = event.target.closest('.js-permanent-delete');
            if (!button) return;

            const orderId = button.dataset.orderId;
            const orderNumber = button.dataset.orderNumber || ('#' + orderId);
            const deleteUrl = button.dataset.deleteUrl;

            const confirmation = await Swal.fire({
                title: 'Delete permanently?',
                html: `Order <strong>${orderNumber}</strong> will be deleted forever.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete permanently',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            });

            if (!confirmation.isConfirmed) return;

            button.disabled = true;

            try {
                const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Could not delete order.');
                }

                document.getElementById(`order-row-${orderId}`)?.remove();

                if (!tableBody.querySelector('tr')) {
                    tableBody.innerHTML = '<tr><td colspan="10" class="text-center py-4 text-muted">No removed orders found.</td></tr>';
                }

                await Swal.fire({
                    title: 'Deleted',
                    text: data.message || 'Order permanently deleted.',
                    icon: 'success',
                    timer: 1600,
                    showConfirmButton: false,
                });
            } catch (error) {
                button.disabled = false;
                Swal.fire({
                    title: 'Delete failed',
                    text: error.message || 'Something went wrong.',
                    icon: 'error',
                });
            }
        });
    });
</script>
