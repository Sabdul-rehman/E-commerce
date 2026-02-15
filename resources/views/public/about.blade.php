@include('public.partials.navbar')
<!-- About Us Page -->
<div class="about-page py-5" >
    <div class="container"style=" overflow-x: hidden; ">

        <!-- Header -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">About Afifa’s Nadia’s</h2>
            <p class="text-muted">
                Where elegance meets everyday fashion
            </p>
        </div>

        <!-- About Content -->
        <div class="row align-items-center g-5">

            <!-- Image -->
            <div class="col-lg-6" >
                <img src="{{ asset('image/aboutus2.jpg') }}  " 
                     class="img-fluid rounded shadow-sm " 
                     alt="Afifa's Nadia's Fashion"  >
            </div>

            <!-- Text -->
            <div class="col-lg-6">
                <h4 class="mb-3">Who We Are</h4>
                <p>
                    <strong>Afifa’s Nadia’s</strong> is a modern ladies clothing brand
                    dedicated to offering stylish, elegant, and comfortable fashion
                    for women of all ages. We specialize in both
                    <strong>stitched and unstitched</strong> collections that blend
                    traditional aesthetics with contemporary trends.
                </p>

                <p>
                    Our designs are carefully curated to reflect grace, quality,
                    and affordability. Whether you are dressing for everyday wear,
                    festive occasions, or formal gatherings, Afifa’s Nadia’s ensures
                    you always look confident and refined.
                </p>
            </div>
        </div>

        <!-- Mission / Vision -->
        <div class="row mt-5 g-4">

            <div class="col-md-6">
                <div class="about-box">
                    <h5>Our Mission</h5>
                    <p>
                        To provide premium-quality stitched and unstitched ladies wear
                        that empowers women to express their individuality through fashion,
                        without compromising on comfort or affordability.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="about-box">
                    <h5>Our Vision</h5>
                    <p>
                        To become a trusted and recognized fashion destination for women,
                        known for elegant designs, consistent quality, and exceptional
                        customer experience.
                    </p>
                </div>
            </div>

        </div>

        <!-- Why Choose Us -->
        <div class="mt-5">
            <h4 class="text-center mb-4">Why Choose Afifa’s Nadia’s</h4>

            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="feature-box">
                        <i class="bi bi-award"></i>
                        <h6>Premium Quality</h6>
                        <p>Carefully selected fabrics and detailed stitching.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <i class="bi bi-scissors"></i>
                        <h6>Stitched & Unstitched</h6>
                        <p>Options for every style and preference.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <i class="bi bi-truck"></i>
                        <h6>Reliable Delivery</h6>
                        <p>Safe and timely delivery across Pakistan.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <i class="bi bi-heart"></i>
                        <h6>Customer First</h6>
                        <p>We value trust, satisfaction, and long-term relationships.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('public.partials.footer')
