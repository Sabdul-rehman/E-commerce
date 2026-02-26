<x-app-layout>
    @php
        $sizes = json_decode($product->size, true) ?? [];
        $types = json_decode($product->type, true) ?? [];
        $homepageChoices = json_decode($product->homepage_choice, true) ?? [];
        $images = json_decode($product->image, true) ?? [];
    @endphp

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Update Product</h3>
            <a href="{{ route('su_display') }}" class="btn btn-outline-secondary">Back</a>
        </div>

        <div id="ajaxErrorBox" class="alert alert-danger d-none"></div>

        <form id="updateProductForm" action="{{ route('category_form.update', $product->Cid) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Old Price</label>
                    <input type="number" step="0.01" class="form-control" name="old_price" value="{{ $product->old_price }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required>{{ $product->description }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label d-block">Size</label>
                    @foreach (['Small','Medium','Large','XL','XXL','XXXL'] as $sizeOption)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="{{ $sizeOption }}" id="size{{ $sizeOption }}" {{ in_array($sizeOption, $sizes) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size{{ $sizeOption }}">{{ $sizeOption }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <label class="form-label d-block">Type</label>
                    @foreach (['Stitched','Unstitched','Embroidery'] as $typeOption)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" value="{{ $typeOption }}" id="type{{ $typeOption }}" {{ in_array($typeOption, $types) ? 'checked' : '' }}>
                            <label class="form-check-label" for="type{{ $typeOption }}">{{ $typeOption }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <label class="form-label d-block">Homepage Choice</label>
                    @foreach (['Featured Product','Bestsellers of the Month'] as $homeOption)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="homepage_choice[]" value="{{ $homeOption }}" id="home{{ \Illuminate\Support\Str::slug($homeOption) }}" {{ in_array($homeOption, $homepageChoices) ? 'checked' : '' }}>
                            <label class="form-check-label" for="home{{ \Illuminate\Support\Str::slug($homeOption) }}">{{ $homeOption }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <label class="form-label">Quantity</label>
                    <input type="number" min="0" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="{{ $product->category }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Availability</label>
                    <select name="availability" class="form-select" required>
                        <option value="In Stock" {{ $product->availability === 'In Stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="Out of Stock" {{ $product->availability === 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Replace Images (optional)</label>
                    <input type="file" class="form-control" name="images[]" multiple>
                    <small class="text-muted">Agar image select nahi karoge to purani image hi rahegi.</small>
                </div>

                @if (!empty($images))
                    <div class="col-12">
                        <label class="form-label d-block">Current Image</label>
                        <img src="{{ asset('image/categories_image/' . $images[0]) }}" alt="{{ $product->product_name }}" class="img-fluid rounded" style="max-height: 180px;">
                    </div>
                @endif

                <div class="col-md-3">
                    <label class="form-label">Fabric</label>
                    <input type="text" class="form-control" name="fabric" value="{{ $product->fabric }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Style Detail</label>
                    <input type="text" class="form-control" name="style_detail" value="{{ $product->style_detail }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Care</label>
                    <input type="text" class="form-control" name="care" value="{{ $product->care }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" value="{{ $product->color }}">
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary" id="updateBtn">Update Product</button>
                <a href="{{ route('su_display') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
document.getElementById('updateProductForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const submitBtn = document.getElementById('updateBtn');
    const errorBox = document.getElementById('ajaxErrorBox');
    const formData = new FormData(form);

    errorBox.classList.add('d-none');
    errorBox.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            if (response.status === 422 && data.errors) {
                const list = Object.values(data.errors).flat().map(msg => `<li>${msg}</li>`).join('');
                errorBox.innerHTML = `<ul class="mb-0">${list}</ul>`;
            } else {
                errorBox.textContent = data.message || 'Update failed.';
            }
            errorBox.classList.remove('d-none');
            return;
        }

        window.location.href = data.redirect || "{{ route('su_display') }}";
    } catch (error) {
        errorBox.textContent = 'Network error. Please try again.';
        errorBox.classList.remove('d-none');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Update Product';
    }
});
</script>
