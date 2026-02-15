<x-app-layout>
    <style>
        .form-light-red {
            background: linear-gradient(150deg, #ffeaea 0%, #290b0b 100%);
            color: #000;
        }
    </style>
    @if($errors->any())
        <div class="alert alert-danger m-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <nav class="col-md-3 bg-dark text-light p-3" style="min-height: 100vh;">
                <div class="text-center mb-4">
                    <h4>Admin Panel</h4>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-light" href="#">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseOrders" role="button">
                            Orders
                        </a>
                        <div class="collapse ps-3" id="collapseOrders">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link text-light" href="#">All Orders</a></li>
                                <li class="nav-item"><a class="nav-link text-light" href="#">Pending</a></li>
                                <li class="nav-item"><a class="nav-link text-light" href="#">Shipped</a></li>
                                <li class="nav-item"><a class="nav-link text-light" href="#">Completed</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseProducts" role="button">
                            Products
                        </a>
                        <div class="collapse ps-3" id="collapseProducts">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link text-light" href="#">Add Product</a></li>
                                <li class="nav-item"><a class="nav-link text-light" href="#">Manage Products</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseCategories"
                            role="button">
                            Categories
                        </a>
                        <div class="collapse ps-3" id="collapseCategories">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link text-light"
                                        href="{{ route('stichedForm') }}">Stitched&Unstitched</a></li>
                                <li class="nav-item"><a class="nav-link text-light"
                                        href="{{ route('homePageForm') }}">Home page</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Banners</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Users</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Settings</a></li>
                </ul>
            </nav>

            {{-- Main Content --}}
            <div class="col-md-9 background_color">
                <h1 class="d-flex justify-content-center m-3" style="font-size: 40px">Stiched & Unstitched Form</h1>

                <form action="{{ route('category_form.store') }}" enctype="multipart/form-data" method="POST"
                    class="p-4  shadow rounded form-light-red">
                    @csrf

                    <div class="row">
                        {{-- Left Column --}}
                        <div class="col-md-6">
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" name="product_name"
                                    class="form-control @error('product_name') is-invalid @enderror"
                                    value="{{ old('product_name') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price (Rs)</label>
                                <input type="text" name="price"
                                    class="form-control text-danger fw-bold @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" required>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Old Price -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Old Price (optional)</label>
                                <input type="text" name="old_price"
                                    class="form-control text-muted @error('old_price') is-invalid @enderror"
                                    value="{{ old('old_price') }}">
                                @error('old_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description"
                                    class="form-control @error('description') is-invalid @enderror" rows="4"
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- home page categories --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Type / Style</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="homepage_choice[]" value="Featured Product"
                                        id="Featured Product" {{ in_array('Featured Product', old('homepage_choice', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Featured Product">Featured Product</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="homepage_choice[]" value="Bestsellers of the Month"
                                        id="Bestsellers of the Month" {{ in_array('Bestsellers of the Month', old('homepage_choice', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Bestsellers of the Month">Bestsellers of the Month</label>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="col-md-6">
                            <div class="row">
                                <!-- Size -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Size</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="Small"
                                            id="sizeSmall" {{ in_array('Small', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeSmall">Small</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="Medium"
                                            id="sizeMedium" {{ in_array('Medium', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeMedium">Medium</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="Large"
                                            id="sizeLarge" {{ in_array('Large', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeLarge">Large</label>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6 " style="margin-top: 33px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XL"
                                            id="sizeXL" {{ in_array('XL', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeXL">XL</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XXL"
                                            id="sizeXXL" {{ in_array('XXL', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeXXL">XXL</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XXXL"
                                            id="sizeXXXL" {{ in_array('XXXL', old('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sizeXXXL">XXXL</label>
                                    </div>

                                </div>
                            </div>



                            <!-- Type -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Type / Style</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type[]" value="Stitched"
                                        id="typeStitched" {{ in_array('Stitched', old('type', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="typeStitched">Stitched</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type[]" value="Unstitched"
                                        id="typeUnstitched" {{ in_array('Unstitched', old('type', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="typeUnstitched">Unstitched</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type[]" value="Embroidery"
                                        id="typeEmbroidery" {{ in_array('Embroidery', old('type', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="typeEmbroidery">Embroidery</label>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control"
                                    value="{{ old('quantity') }}" required>
                            </div>

                            <!-- Category & Availability -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" name="category" class="form-control" value="Ladies Clothing"
                                    value="{{ old('category') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Availability</label>
                                <select name="availability" class="form-select" required>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>

                            <!-- SKU -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">SKU</label>
                                <input type="text" name="sku" class="form-control"
                                    value="AN-LC-{{ old('sku') ? preg_replace('/^AN-LC-/', '', old('sku')) : '' }}"
                                    required>
                            </div>

                        </div>
                    </div>

                    <!-- Additional Details Full Width -->
                    <div class="mb-4 border-top border-secondary pt-3">
                        <h5 class="fw-bold mt-3 mb-2">Additional Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fabric</label>
                                    <input type="text" name="fabric" class="form-control" value="{{ old('fabric') }}"
                                        placeholder="optional">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Style</label>
                                    <input type="text" name="style_detail" class="form-control"
                                        value="{{ old('style_detail') }}" placeholder="optional">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Care</label>
                                    <input type="text" name="care" class="form-control" value="{{ old('care') }}"
                                        placeholder="optional">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Color</label>
                                    <input type="text" name="color" class="form-control" value="{{ old('color') }}"
                                        placeholder="optional">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Product Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Product</button>
                        <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>