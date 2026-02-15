<x-app-layout>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <div class="container ">
        <h1 class="d-flex justify-content-center m-3" style="font-size: 40px">Stiched & Unstitched Form</h1>

        <form action="{{ route('category_form.store') }}" enctype="multipart/form-data" method="POST"
            class="p-4 bg-white shadow rounded">
            @csrf
            <!-- Product Title -->
            <div class="mb-3">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" name="product_name" class="form-control  @error('product_name') is-invalid @enderror"
                    value="{{ old('product_name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Product Price -->
            <div class="mb-3">
                <label class="form-label fw-bold">Price (Rs)</label>
                <input type="text" name="price"
                    class="form-control text-danger fw-bold  @error('price') is-invalid @enderror"
                    value="{{ old('price') }}" required>
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Old Price (optional)</label>
                <input type="text" name="old_price"
                    class="form-control text-muted  @error('old_price') is-invalid @enderror"
                    value="{{ old('old_price') }}">
                @error('old_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Product Description -->
            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>

                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                    required>{{ old('description') }}</textarea>

                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <!-- Product Options -->
            <div class="mb-4">

                <!-- Size Dropdown -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Size</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input @error('size') is-invalid @enderror" type="checkbox"
                                name="size[]" value="Small" id="sizeSmall" {{ in_array('Small', old('size', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sizeSmall">Small</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input @error('size') is-invalid @enderror" type="checkbox"
                                name="size[]" value="Medium" id="sizeMedium" {{ in_array('Medium', old('size', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sizeMedium">Medium</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input @error('size') is-invalid @enderror" type="checkbox"
                                name="size[]" value="Large" id="sizeLarge" {{ in_array('Large', old('size', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sizeLarge">Large</label>
                        </div>
                    </div>

                    @error('size')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Type / Style Dropdown -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Type / Style</label>

                    <div class="form-check">
                        <input class="form-check-input @error('type') is-invalid @enderror" type="checkbox"
                            name="type[]" value="Stitched" id="typeStitched" {{ in_array('Stitched', old('type', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="typeStitched">Stitched</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input @error('type') is-invalid @enderror" type="checkbox"
                            name="type[]" value="Unstitched" id="typeUnstitched" {{ in_array('Unstitched', old('type', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="typeUnstitched">Unstitched</label>
                    </div>

                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Quantity -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantity</label>
                    <input type="number" name="quantity" value="1" min="1"
                        class="form-control  @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                        required>
                </div>
                @error('quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Additional Details -->
            <div class="mb-4 border-top border-secondary pt-3">

                <div class="mb-3">
                    <label class="form-label fw-bold">Category</label>
                    <input type="text" name="category" class="form-control" value="Ladies Clothing"
                        value="{{ old('category') }}" required>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Availability</label>
                    <select name="availability" class="form-select" required>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                    @error('availability')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">SKU</label>
                    <input type="text" name="sku" class="form-control  @error('sku') is-invalid @enderror"
                        value="AN-LC-102" value="{{ old('sku') }}" required>
                    @error('sku')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <h5 class="fw-bold mt-3 mb-2">Additional Details</h5>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fabric</label>
                    <input type="text" name="fabric" class="form-control  @error('fabric') is-invalid @enderror"
                        value="{{ old('fabric') }}" placeholder="optional">
                    @error('fabric')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Style</label>
                    <input type="text" name="style_detail"
                        class="form-control  @error('style_detail') is-invalid @enderror"
                        value="{{ old('style_detail') }}" placeholder="optional">
                    @error('style_detail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Care</label>
                    <input type="text" name="care" class="form-control  @error('care') is-invalid @enderror"
                        value="{{ old('care') }}" placeholder="optional">
                    @error('care')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Color</label>
                    <input type="text" name="color" class="form-control  @error('color') is-invalid @enderror"
                        value="{{ old('color') }}" placeholder="optional">
                    @error('color')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Product Images</label>
                    <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror"
                        multiple>
                    @error('images')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



            </div>

            <!-- Submit Button -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">Save Product</button>
                <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
            </div>

        </form>


    </div>
</x-app-layout>


    {{-- Two Cards --}}

    <!-- SECTION 1: Text left | Card right -->
    <section class="feature-section" style="  overflow-x: hidden; ">
        <div class="container mt-5">
            <div class="row align-items-center">

                <!-- TEXT -->
                <div class="col-lg-6 animate-card left">
                    <div class="text-center text-lg-start ">
                        <h1>High Quality Pieces</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ullam!</p>
                    </div>
                    <a href="/shop" class=" btn btn-danger first-card-btn">
                        <span class="">Shop Now</span>
                    </a>
                </div>

                <!-- CARD -->
                <div class="col-lg-6 d-flex justify-content-center c-1 animate-card">
                    <div class="card-box">
                        <img src="{{ asset('image/n11.jpg') }}" alt="Suit 1">
                        <a href="/shop" class=" btn btn-danger card-btn-1 ">
                            <span class="btn-text">Shop</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 2: Card left | Text right -->
    <section class="feature-section" style="  overflow-x: hidden; ">
        <div class="container mt-5">
            <div class="row align-items-center">

                <!-- CARD -->
                <div class="col-lg-6 d-flex justify-content-center c-1 animate-card left">
                    <div class="card-box">
                        <img src="{{ asset('image/n9.webp') }}" alt="Suit 2">
                        <a href="/shop" class=" btn btn-danger card-btn-1">
                            <span class="btn-text">Shop</span>
                        </a>
                    </div>
                </div>
                {{-- <div class="col-lg-6 d-flex justify-content-center c-1 animate-card">
                    <div class="card-box">
                        <img src="{{ asset('image/n11.jpg') }}" alt="Suit 1">
                        <a href="/shop" class=" btn btn-danger card-btn-1">
                            <span class="btn-text">Shop</span>
                        </a>
                    </div>
                </div> --}}

                <!-- TEXT -->
                <div class="col-lg-6 animate-card">
                    <div class="text-center text-lg-start second-card-text">
                        <h1>Elegant Traditional Wear</h1>
                        <p>Premium fabric with timeless designs for every occasion.</p>
                    </div>
                    <a href="/shop" class=" btn btn-danger second-card-btn">
                        <span class="">Shop Now</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
