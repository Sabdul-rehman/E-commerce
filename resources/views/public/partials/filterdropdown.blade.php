 <select id="shop-sort" class="form-select catalog-filter-select">
                    <option selected value="">Filter By</option>
                    <option value="low">Price: Low to High</option>
                    <option value="high">Price: High to Low</option>
                    <option value="new">Newest</option>
                </select>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

 {{-- ajax for filtering --}}
<script>
    function filterProducts(){
        const sort = $('#shop-sort').val();
        const path = window.location.pathname.toLowerCase();
        let type = '';

        if (path.includes('/stiched')) {
            type = 'Stitched';
        } else if (path.includes('/unstiched')) {
            type = 'Unstitched';
        } else if (path.includes('/embroidery')) {
            type = 'Embroidery';
        }

        $.ajax({
            url: "{{ route('shop.filter') }}",
            type: "GET",
            data: { sort, type },
            success: function(response){
                $('#shop-product-container').html(response);
            }
            
        })
    }
     $('#shop-sort').on('change', function () {
        filterProducts();
    });
</script>

{{-- filter dropdown --}}

