<x-app-layout>
    <div class="container-fluid py-4">
        <h2 class="mb-4 text-center" style="font-size: 40px; font-weight:bold; text-decoration:underline;">
            Categories
        </h2>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Availability</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        @php
                            $images = json_decode($product->image, true) ?? [];
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>Rs {{ $product->price }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->type }}</td>
                            <td>{{ $product->availability }}</td>
                            <td>
                                @if (!empty($images))
                                    <img src="{{ asset('image/categories_image/' . $images[0]) }}" alt="" width="60" class="rounded">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $product->Cid }}">
                                        View
                                    </button>
                                    <a href="{{ route('category_form.edit', $product->Cid) }}" class="btn btn-warning btn-sm">Update</a>
                                    <form action="{{ route('category_form.destroy', $product->Cid) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($products as $product)
        @php
            $images = json_decode($product->image, true) ?? [];
        @endphp
        <div class="modal fade" id="viewModal{{ $product->Cid }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $product->Cid }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel{{ $product->Cid }}">
                            {{ $product->product_name }} Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if (!empty($images))
                                    <img src="{{ asset('image/categories_image/' . $images[0]) }}" class="img-fluid rounded" alt="{{ $product->product_name }}">
                                @else
                                    <p>No Image</p>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Price:</strong> Rs {{ $product->price }}</li>
                                    <li class="list-group-item"><strong>Old Price:</strong> Rs {{ $product->old_price ?? 'N/A' }}</li>
                                    <li class="list-group-item"><strong>Description:</strong> {{ $product->description }}</li>
                                    <li class="list-group-item"><strong>Size:</strong> {{ $product->size }}</li>
                                    <li class="list-group-item"><strong>Type:</strong> {{ $product->type }}</li>
                                    <li class="list-group-item"><strong>Quantity:</strong> {{ $product->quantity }}</li>
                                    <li class="list-group-item"><strong>Category:</strong> {{ $product->category }}</li>
                                    <li class="list-group-item"><strong>Availability:</strong> {{ $product->availability }}</li>
                                    <li class="list-group-item"><strong>SKU:</strong> {{ $product->sku }}</li>
                                    <li class="list-group-item"><strong>Fabric:</strong> {{ $product->fabric ?? 'N/A' }}</li>
                                    <li class="list-group-item"><strong>Style Detail:</strong> {{ $product->style_detail ?? 'N/A' }}</li>
                                    <li class="list-group-item"><strong>Care:</strong> {{ $product->care ?? 'N/A' }}</li>
                                    <li class="list-group-item"><strong>Color:</strong> {{ $product->color ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>

<script>
document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Are you sure?',
            text: "This category will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
