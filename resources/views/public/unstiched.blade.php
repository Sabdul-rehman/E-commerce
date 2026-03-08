@include('public.partials.navbar')



<div class="container-fluid px-5">

    <!-- Page Header -->
    <div class="page-header">
        <h1>Unstitched Collection</h1>
        <p class="text-muted">Explore our latest <b>Unstitched designs</b></p>
    </div>

    <!-- Filters & Search -->

    <div id="catalogTools" class="catalog-toolbar mb-4">
        <div class="catalog-search-wrap">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search products...">
                <button class="btn btn-dark" type="button">Search</button>
            </div>
        </div>

        <div class="catalog-filter-wrap">
            <button type="button" class="btn btn-outline-dark catalog-search-toggle"
                data-search-toggle="#catalogTools" aria-label="Open search" aria-expanded="false">
                <i class="bi bi-search"></i>
            </button>

            @include('public.partials.filterdropdown')
        </div>
    </div>

    <!-- Product Cards Grid -->
    <div class="row g-2" id="shop-product-container">
        @include('public.partials.cards_unstiched')
    </div>
</div>
<div class="pagination-wrapper d-flex justify-content-center mt-5">
    {{ $products->links() }}
</div>
<br>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.querySelector('[data-search-toggle]');
        if (!toggleBtn) return;

        const tools = document.querySelector(toggleBtn.getAttribute('data-search-toggle'));
        if (!tools) return;

        toggleBtn.addEventListener('click', function () {
            const isOpen = tools.classList.toggle('is-open');
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    });
</script>
@include('public.partials.footer');
